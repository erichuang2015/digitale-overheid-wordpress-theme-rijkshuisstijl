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
 * @version 0.7.6
 * @desc.   Fixed text for 2nd menu item in dossiers
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

$tellertje = 0;

//========================================================================================================

function rhswp_dossier_title_checker( ) {

  global $post;
  global $wp_query;
  global $tellertje;
  
  
  $currentID = 0;
  
  if ( is_posts_page() || is_search() ) {
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
    $term     = '';
    $tellertje = 1;


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
    elseif ( 'tag' == $loop ) {
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
      $dossierinhoudpagina = '';

      $args['theterm'] = $term->term_id;
  
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
            // we mogen de inhoudspagina tonen

            $shownalready = $dossier_overzichtpagina->ID;
            $parentID     = $dossier_overzichtpagina->ID;


            if ( is_tax() ) {
              $args['currentpageid'] = $term->term_id;
            }
            else {
//              $args['currentpageid'] = $parentID;
            }            

            $args['preferedtitle'] = _x( 'Inhoud', 'Standaardlabel voor het 2de item in het dossiermenu', 'wp-rijkshuisstijl' );
            $subpaginas .= rhswp_dossier_get_pagelink( $dossier_overzichtpagina, $args );

          }
          
        }

        // reset the page title
        $args['preferedtitle'] = '';
        
        if ( is_tax() ) {
          // dit is de pagina met informatie over het dossier

          $args['currentpageid'] = $term->term_id;

          $dossierinhoudpagina = '<li class="selected"><span>' .  _x( 'Overzicht', 'Standaardlabel voor het menu in de dossiers', 'wp-rijkshuisstijl' ) . '</span></li>';

        }        
        else {
          // dit is een andere pagina, 
          $args['currentpageid'] = get_the_id();

          $dossierinhoudpagina = '<li><a href="' . get_term_link( $term ) . '">' . _x( 'Overzicht', 'Standaardlabel voor het menu in de dossiers', 'wp-rijkshuisstijl' ) . '</a></li>';

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

            echo '<p style="border: 1px solid black; padding: .2em .5em;"><strong>Er is nog geen menu ingevoerd voor dit dossier.</strong><br>Dit menu toont nu de directe pagina\'s onder "<a href="' . get_permalink( $parentID ) . '">' . get_the_title( $parentID ) . '</a>"</p>';
            dodebug( 'PaginaID: ' . $parentID );

//            $args['currentpageid'] = $term->term_id;

            $argspages = array( 
              'child_of'  => $parentID, 
              'parent'   => $parentID,
              'hierarchical' => 1,
              'sort_column' => 'menu_order', 
              'sort_order' => 'asc'
            );
            $pages = get_pages($argspages); 
            
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
  
      
      if ( $dossierinhoudpagina || $subpaginas ) {
        if ( $tellertje > 1 ) {
          echo '<p class="screen-reader-text">';
          echo sprintf( __( 'Dit dossier bevat %s items.', 'wp-rijkshuisstijl' ), $tellertje );
          echo '</p>';
        }

        echo '<nav class="collapsible"><ul class="tabs">' . $dossierinhoudpagina  .  $subpaginas;    
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

  global $tellertje;
  
  $tellertje++;
  $childpages = [];

  if ( $args['currentpageid'] ) {
    $pagerequestedbyuser = $args['currentpageid'];
  }
  else {
    $pagerequestedbyuser = get_the_id();
  }

  // use alternative title? 
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
  

  if ( strlen( $maxposttitle ) > $maxlength ) {
    $maxposttitle = substr( $maxposttitle, 0, $maxlength) . ' (...)';
  }

  $current_menuitem_id = isset( $theobject->ID  ) ? $theobject->ID : 0;

  $pagetemplateslug = basename( get_page_template_slug( $current_menuitem_id ) );

  $selectposttype = '';
  $checkpostcount = false;
  $addlink        = false;

  if ( 'page_dossiersingleactueel.php' == $pagetemplateslug ) {
    $selectposttype = 'post';
    $checkpostcount = true;
  }    
  elseif ( 'page_dossier-document-overview.php' == $pagetemplateslug ) {
    $selectposttype = RHSWP_CPT_DOCUMENT;
    $checkpostcount = true;
  }    
  elseif ( 'page_dossier-events-overview.php' == $pagetemplateslug ) {
    $selectposttype = RHSWP_CPT_EVENT;
    $checkpostcount = true;
  }    
  elseif ( 'page_show-child-pages.php' == $pagetemplateslug ) {
    $selectposttype = 'pagina-met-onderliggende-paginas';
    $checkpostcount = true;
  }    
  else {
    $selectposttype = '';
    $checkpostcount = false;
    $addlink        = true;    
  }


  if ( $checkpostcount && $selectposttype ) {
    
    if ( $selectposttype == 'pagina-met-onderliggende-paginas' ) {

      $args = array( 
        'child_of'      => $current_menuitem_id, 
        'parent'        => $current_menuitem_id,
        'hierarchical'  => 0,
        'sort_column'   => 'menu_order', 
        'sort_order'    => 'asc'
      );
      $mypages = get_pages( $args );

      if ( count( $mypages ) > 0 ) {
        $addlink = true;

        // we have child pages. Save this for checking if we are displaying any of its parents
        foreach( $mypages as $childpage ): 
          $childpages[] = $childpage->ID;
        endforeach;
        
        
      }

    }
    else {

      if ( function_exists( 'get_field' ) ) {
          $filter    = get_field('wil_je_filteren_op_categorie_op_deze_pagina', $current_menuitem_id );
          $filters   = get_field('kies_de_categorie_waarop_je_wilt_filteren', $current_menuitem_id );
      }
  
  
      $argsquery = array(
        'post_type' => $selectposttype,
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => RHSWP_CT_DOSSIER,
            'field' => 'term_id',
            'terms' => $args['theterm']
          )
        )
      );
    
    
  
      if ( $filter !== 'ja' ) {
        // no filtering, no other arguments needed
      }
      else {
        // yes! Do filtering
  
        if ( $filters ) {
        
          $slugs = array();
          
          foreach( $filters as $filter ): 
            $terminfo = get_term_by( 'id', $filter, 'category' );
            $slugs[] = $terminfo->slug;
          endforeach;
  
          $argsquery = array(
              'post_type' => $selectposttype,
              'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy'  => RHSWP_CT_DOSSIER,
                  'field'     => 'term_id',
                  'terms'     => $args['theterm']
                ),
                array(
                  'taxonomy'  => 'category',
                  'field'     => 'slug',
                  'terms'     => $slugs,
                )
              )
            );

        }
      }

      $wp_query = new WP_Query( $argsquery );
    
      if( $wp_query->have_posts() ) {
        if ( $wp_query->post_count > 0 ) {
          $addlink = true;
        }
      }
    }
  }
  else {
    // no $checkpostcount, no special page templates
  }


  $parentID     = wp_get_post_parent_id( $current_menuitem_id );


  if ( $pagerequestedbyuser == $current_menuitem_id ) {
    // the user asked for this particular page / post
    return '<li class="selected"><span>' . $maxposttitle . '</span></li>';
  }
  else {
    // this is not the currently active page

    if ( $addlink ) {
      // so we should show the link
      
      if ( $args['markerforclickableactivepage'] == $current_menuitem_id ) {
        // this is requested page itself
        return '<li class="selected"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $maxposttitle . '</a></li>';
      }
      elseif ( in_array( $pagerequestedbyuser, $childpages ) ) {
        // this is a child of the current menu item
        return '<li class="selected"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $maxposttitle . '</a></li>';
      }
      else {
        // this menu item should be clickable
        return '<li><a href="' . get_permalink( $current_menuitem_id ) . '">' . $maxposttitle . '</a></li>';
      }  
    }
  }

}

//========================================================================================================
