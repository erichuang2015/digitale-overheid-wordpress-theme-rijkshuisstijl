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
 * @version 0.8.17
 * @desc.   Opmaak voor dossier overzicht aangepast
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

$tellertje = 0;

//========================================================================================================

function rhswp_dossier_title_checker( ) {

  global $post;
  global $wp_query;
  global $tellertje;

  if ( ! is_object( $post ) ) {
    // bail early if no post object available (s.a. 404)
    return;
  }
  
  $currentID = 0;
  
  if ( is_posts_page() || is_search() ) {
    return;
  }
  
  if ( taxonomy_exists( RHSWP_CT_DOSSIER ) ) {

  
    $subpaginas               = '';
    $shownalready             = '';
    $dossier_overzichtpagina  = '';
  
    $args = array(
      'dossier_overzichtpagina' => '',
      'menu_voor_dossier' => '',
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

        $itemsinmenu   = [];

        if ( $dossier_overzichtpagina ) {
            $itemsinmenu[] = $dossier_overzichtpagina->ID;
        }

        if ( $menu_voor_dossier ) {

          foreach( $menu_voor_dossier as $menuitem ): 
            $itemsinmenu[] = $menuitem->ID;
          endforeach; 
          
          $args['menu_voor_dossier'] = $itemsinmenu;

        }

        $titletag_start           = '<p class="taxonomy-title">';
        $titletag_end             = '</p>';

        if ( $dossier_overzichtpagina ) {
          // de overzichtspagina is bekend

          // check of we deze pagina wel of niet nu al moeten tonen
          $tonen  = get_field('toon_overzichtspagina_in_het_menu', $term );

          $parentID     = $dossier_overzichtpagina->ID;

          if ( $tonen !== 'nee' ) {
            // we mogen de inhoudspagina tonen

            $shownalready = $dossier_overzichtpagina->ID;
            $parentID     = $dossier_overzichtpagina->ID;
            $args['dossier_overzichtpagina'] = $dossier_overzichtpagina->ID;

            if ( is_tax() ) {
              $args['currentpageid'] = $term->term_id;
            }
            else {
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

        $value = get_term_meta( $term->term_id, 'headline', true );
        
        // Use term name if empty
        if( empty( $value ) ) {
        	$term = get_term_by( 'term_taxonomy_id', $term->term_id );
        	$value = $term->name;
        }
        else {
          $value = $term->name . ' - ' . $value;
        }

        if ( is_tax() ) {
          $titletag_start           = '<h1 class="taxonomy-title">';
          $titletag_end             = '</h1>';
        }        
        $zetaxonomyname = $value;

        echo $titletag_start . $zetaxonomyname  . $titletag_end; 

        
        if ( $menu_voor_dossier ) {

          foreach( $menu_voor_dossier as $menuitem ): 

            if ( ( $parentID !== $menuitem->ID ) && ( $shownalready !== $menuitem->ID ) )  {
              $subpaginas .= rhswp_dossier_get_pagelink( $menuitem, $args );
            }
          endforeach; 
            
        }
        else {

          dodebug('er is geen menu ingevoerd...');
          
          if ( $parentID ) {

            $user = wp_get_current_user();
            if ( in_array( 'manage_categories', (array) $user->allcaps ) ) {
              echo '<p style="padding: .2em .5em; background: red; color: white;"><strong>Er is nog geen menu ingevoerd voor dit dossier.</strong><br>Dit menu toont nu de directe pagina\'s onder de pagina "<a href="' . get_permalink( $parentID ) . '" style="color: white;">' . get_the_title( $parentID ) . '</a>"</p>';
            }  

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
  $childpages   = [];

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

  // IS GEPUBLICEERD?
  $poststatus = get_post_status( $current_menuitem_id );

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
  else {
    $selectposttype = '';
    $checkpostcount = false;
    $addlink        = true;    
  }

  if ( $poststatus != 'publish' ) {
    $addlink        = false;    
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


  // haal de ancestors op voor de huidige pagina
  $ancestors = get_post_ancestors( $pagerequestedbyuser );


  // check of the parent niet al ergens in het menu voorkomt  
  $postparent =  wp_get_post_parent_id( $pagerequestedbyuser );

  $komtvoorinderestvanmenu_en_isnietdehuidigepagina = false;

  if ( isset( $args['menu_voor_dossier'] ) ) {

    if ( in_array( $pagerequestedbyuser, $args['menu_voor_dossier'] )  ) {
      // de gevraagde pagina komt voor in het menu

      if ( in_array( $postparent, $args['menu_voor_dossier'] )  ) {
        $komtvoorinderestvanmenu_en_isnietdehuidigepagina = true;
      }
      
    }
    
  }


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

      elseif ( in_array( $current_menuitem_id, $ancestors ) && ( $args['dossier_overzichtpagina'] !=  $current_menuitem_id ) ) {
        // user requested a page that is a child of the current menu item
        return '<li class="selected"><a href="' . get_permalink( $current_menuitem_id ) . '">' . $maxposttitle . '</a></li>';
      }

      elseif ( wp_get_post_parent_id( $pagerequestedbyuser ) ==  $current_menuitem_id && ( ! $komtvoorinderestvanmenu_en_isnietdehuidigepagina ) ) {
        // this is the direct parent of the requested page
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
