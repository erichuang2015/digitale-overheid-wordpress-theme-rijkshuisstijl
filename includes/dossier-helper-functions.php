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
 * @version 0.3.2
 * @desc.   Dossier check revised - bugfixes 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

//========================================================================================================

function rhswp_dossier_title_checker( ) {

  global $post;
  global $wp_query;
  
  $currentID = 0;
  
  if ( is_posts_page() ) {
    return;
  }
  
  if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {
      
  
    $subpaginas               = '';
    $shownalready             = '';
    $dossier_overzichtpagina  = '';
  
    $args = array(
      'markerforclickableactivepage' => '',
      'currentpageid' => '',
      'preferedtitle' => '',
      'maxlength'     => 50,
    );


    // checken of dit een post is en is_single() en of in de URL de juiste dossier-contetxt is meegegeven.
    
    $posttype = get_post_type();
    $loop     = rhswp_get_context_info();


    if ( 'single' == $loop ) {
      if ( get_query_var( RHSWP_DOSSIERPOSTCONTEXT ) ) {
        $url = get_query_var( RHSWP_DOSSIERPOSTCONTEXT );
        $contextpageID = url_to_postid( $url );
        
  //      dodebug('Er is een context: '  . $url . '<br>CurrentID is: '  . $currentID . '<br>contextpageID is: '  . $contextpageID );
  
        $terms        = get_the_terms( $contextpageID , RHSWP_CT_DOSSIER );
  
        $args['markerforclickableactivepage'] = $contextpageID;
  
        if ($terms && ! is_wp_error( $terms ) ) { 
          $term             = array_pop($terms);
        }
  
      }
    }
    elseif ( 'category' == $loop ) {
      return;
      
    }
    elseif ( 'tax' == $loop ) {

      $currentID    = get_queried_object()->term_id;
      $term         = get_term( $currentID, RHSWP_CT_DOSSIER );

    }
    else {

      $currentID    = $post->ID;
      $terms        = get_the_terms( $currentID , RHSWP_CT_DOSSIER );
      $parentID     = wp_get_post_parent_id( $post->ID );
      $parent       = get_post( $parentID );

      if ($terms && ! is_wp_error( $terms ) ) { 
        $term             = array_pop($terms);
      }
      
      if ( is_single() && 'post' == $posttype ) {
        dodebug('ja, is single en post');
      }
    }    



    // dossiercontext tonen als
    // er een taxonomie bekend is en het geen archief is
    if ( $term && ( 'archive' !== $loop ) ) { 
      $overzichtspagina = '';
  
      echo '<div class="dossier-overview"><div class="wrap">'; 
      
      if ( function_exists( 'get_field' ) ) {

        $dossier_overzichtpagina  = get_field('dossier_overzichtpagina', $term );
        $menu_voor_dossier        = get_field('menu_pages', $term );
        
        $titletag_start           = '<p class="entry-title">';
        $titletag_end             = '</p>';

        if ( $dossier_overzichtpagina ) {

          // check of we deze pagina wel of niet nu al moeten tonen
          $tonen  = get_field('toon_overzichtspagina_in_het_menu', $term );

          $parentID = $dossier_overzichtpagina->ID;

          if ( $tonen !== 'nee' ) {
            // we mogen de overzichtspagina tonen

            $shownalready = $dossier_overzichtpagina->ID;
            $parentID     = $dossier_overzichtpagina->ID;


            if ( is_tax() ) {
              $args['currentpageid'] = $term->term_id;
            }
            else {
//              $args['currentpageid'] = $parentID;
            }            
            $subpaginas .= rhswp_dossier_get_pagelink( $dossier_overzichtpagina, $args );

          }
          
        }
        
        if ( is_tax() ) {
          // dit is de pagina met informatie over het dossier

          $args['currentpageid'] = $term->term_id;

          $overzichtspagina = '<li class="current"><span>' .  _x( 'Overzicht', 'Standaardlabel voor het menu in de dossiers', 'wp-rijkshuisstijl' ) . '</span></li>';

        }        
        else {
          // dit is een andere pagina, 

          $overzichtspagina = '<li><a href="' . get_term_link( $term ) . '">' . _x( 'Overzicht', 'Standaardlabel voor het menu in de dossiers', 'wp-rijkshuisstijl' ) . '</a></li>';

        }
        

        echo $titletag_start . $term->name  . $titletag_end; 

        
        if ( $menu_voor_dossier ) {

          foreach( $menu_voor_dossier as $menuitem ): 
            if ( ( $parentID !== $menuitem->ID ) && ( $shownalready !== $menuitem->ID ) )  {
              $subpaginas .= rhswp_dossier_get_pagelink( $menuitem, $args );
            }
          endforeach; 
            
        }
        else {
          
          if ( $parentID ) {

            dodebug('geen menu bekend, maar parent ID: ' . $parentID);

            $args = array( 
              'child_of'  => $parentID, 
              'parent '   => $parentID,
              'hierarchical' => 1,
              'sort_column' => 'menu_order', 
              'sort_order' => 'asc'
            );
            $pages = get_pages($args); 
            
            if ( $pages ) {
              foreach ( $pages as $page ) {
                if ( ( $parentID !== $page->ID ) && ( $shownalready !== $page->ID ) )  {
                  $subpaginas .= rhswp_dossier_get_pagelink( $page, $args );
                }
              }
            }
          }
          else {
            dodebug('geen menu bekend en ook geen parent ID');
          }
        }
      }
  
      
      if ( $overzichtspagina || $subpaginas ) {
        echo '<nav class="collapsible"><ul>' . $overzichtspagina  .  $subpaginas;    
        echo '</ul></nav>';    
      }
  
      echo '</div>';
      echo '</div>';
    }
  }
  else {
  }
}

//========================================================================================================

function rhswp_dossier_get_pagelink( $theobject, $args ) {

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
    return '<li class="current"><span>' . $maxposttitle . '</span></li>';
  }
  elseif ( $args['markerforclickableactivepage'] == $theobjectid ) {
    return '<li class="current"><a href="' . get_permalink( $theobjectid ) . '">' . $maxposttitle . '</a></li>';
  }
  else {
    return '<li><a href="' . get_permalink( $theobjectid ) . '">' . $maxposttitle . '</a></li>';
  }  

}

//========================================================================================================