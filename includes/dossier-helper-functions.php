<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - dossier-helper-functions.php
 * ----------------------------------------------------------------------------------
 * functies voor de header boven content in een dossier
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.31
 * @desc.   New custom post type for dossiers
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

$tellertje = 0;

//========================================================================================================

function rhswp_dossier_checkmenuitem( $key = '', $currentpage = '', $slug = '', $theurl = '' ) {

  global $post;
  global $tellertje;
  

  $returnstring = '';
  $label = '';

  if ( $key == 'Overzicht' ) {
    $tellertje++;
    $label = $key;
  }
  else {
    $theurl = '';
  }

  if ( function_exists( 'get_field' ) ) {
    if ( BOOL_JA_VAL == get_field( $key ) ) {
    

      $pagina   = get_field( $key . '_pagina' );
      $category = get_field( $key . '_category' );
      $label    = get_field( $key . '_label' );
      
      if ( $pagina ) {
        $tellertje++;
        $theurl         = get_permalink( $pagina[0]->ID );
      }
      elseif ( $category[0] ) {
        $tellertje++;

        $categories = get_category( $category[0], ARRAY_A );

        if ( ! empty( $categories ) ) {
          $theurl         = get_permalink( )  . RHSWP_DOSSIERPOSTCONTEXT . '/' . $categories['slug'] . '/';
        }
      }
      else {
        
        if ( RHSWP_CPT_EVENT == $slug ) {
          $tellertje++;
          $theurl         = get_permalink( )  . RHSWP_DOSSIEREVENTCONTEXT . '/';
        }
        elseif ( RHSWP_CPT_DOCUMENT == $slug ) {
          $tellertje++;
          $theurl         = get_permalink( )  . RHSWP_DOSSIERDOCUMENTCONTEXT . '/';
        }
      }
    }
  }

  if ( $currentpage == $theurl ) {
    $returnstring = '<li class="selected"><span>' . $label . '</span></li>';
  }
  else {
//    $returnstring = '<li><a href="' . $theurl . '">' . $label . ' (<br>' . $currentpage .'<br>' . $theurl . '<br>)</a></li>';
    $returnstring = '<li><a href="' . $theurl . '">' . $label . '</a></li>';
  }

      
  
  return $returnstring;
}

//========================================================================================================

function rhswp_dossier_title_checker( ) {

  global $post;
  global $wp_query;
  global $tellertje;
  


  
  $currentID = 0;
  
  if ( is_posts_page() ) {
    return;
  }

  $posttype                 = get_post_type();
  $loop                     = rhswp_get_context_info();
  $term                     = '';
  $dossierinhoudpagina      = '';
  $subpaginas               = '';

  
  if ( RHSWP_CPT_DOSSIER == get_post_type() ) {

    if ( 'single' == $loop ) {

      
      //Returns the animal with the slug 'cat'
      $postinfo = get_page_by_path( $wp_query->query['name'], OBJECT, RHSWP_CPT_DOSSIER );
      
      if ( $postinfo ) {
        echo '<div class="dossier-overview"><div class="wrap">'; 

        echo '<h1>' . $postinfo->post_title . '</h1>'; 

  
  //$dossierinhoudpagina
  
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  
        $currentpage  = $protocol . $_SERVER["HTTP_HOST"] . strtok($_SERVER["REQUEST_URI"],'?');
  
        $dossierinhoudpagina = rhswp_dossier_checkmenuitem( __( 'Overzicht', 'wp-rijkshuisstijl' ), $currentpage, '', get_permalink( $postinfo->ID ) );

        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_overzicht', $currentpage);
        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_actueel', $currentpage);
        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_achtergrondartikelen', $currentpage);
        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_documenten', $currentpage, RHSWP_CPT_DOCUMENT );
        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_evenementen', $currentpage, RHSWP_CPT_EVENT );
        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_vraagenantwoord', $currentpage);
        $subpaginas  .= rhswp_dossier_checkmenuitem('dossierx_toon_planning', $currentpage);
        
        if ( $dossierinhoudpagina || $subpaginas ) {
  
          if ( $tellertje > 1 ) {
            echo '<p class="xxscreen-reader-text">';
            echo sprintf( __( 'Dit dossier bevat %s items.', 'wp-rijkshuisstijl' ), $tellertje );
            echo '</p>';
          }
  
          echo '<nav class="collapsible"><ul class="tabs">' . $dossierinhoudpagina  .  $subpaginas;    
//          echo '<nav class="collapsible"><ul class="tabs">' . $dossierinhoudpagina  ;    
          echo '</ul></nav>';    
        }
  
        echo '</div>';
        echo '</div>';

      }
    }
  }
}

//========================================================================================================

function rhswp_dossier_get_pagelink( $theobject, $args ) {

  global $tellertje;
  
  $tellertje++;

  if ( $args['currentpageid'] ) {
    $currentpageid = $args['currentpageid'];
  }
  else {
    $currentpageid = get_the_id();
  }

  if ( $args['preferedtitle'] ) {
    $maxposttitle = $args['preferedtitle'];
  }
  else {
    $maxposttitle = $theobject->post_title;
  }

  if ( $args['maxlength'] ) {
    $maxlength = $args['maxlength'];
  }
  else {
    $maxlength = 50;
  }
  
//  dovardump($args);

  if ( strlen( $maxposttitle ) > $maxlength ) {
    $maxposttitle = substr( $maxposttitle, 0, $maxlength) . ' (...)';
  }

  $theobjectid = isset( $theobject->ID  ) ? $theobject->ID : 0;


  if ( $currentpageid == $theobjectid ) {
    return '<li class="selected"><span>' . $maxposttitle . '</span></li>';
  }
  elseif ( $args['markerforclickableactivepage'] == $theobjectid ) {
    return '<li class="selected"><a href="' . get_permalink( $theobjectid ) . '">' . $maxposttitle . '</a></li>';
  }
  else {
    return '<li><a href="' . get_permalink( $theobjectid ) . '">' . $maxposttitle . '</a></li>';
  }  

}

//========================================================================================================