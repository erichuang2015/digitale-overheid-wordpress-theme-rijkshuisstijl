<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_showalldossiers.php
 * ----------------------------------------------------------------------------------
 * Toont alle dossiers
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.13
 * @desc.   Contentblok-checker op diverse pagina's
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 04 - (dossiers) overzicht alle dossiers (met uitgelichte dossiers)

//* Force full-width-content layout
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

$wrapper_title  = '';
$checker        = '';

$wrapper_start  = '<div class="block">JJAJAJAJAJAJAJA';
$wrapper_end    = '</div>';


add_action( 'genesis_entry_content', 'rhswp_show_all_dossiers', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 12 );

  $wrapper_title  = 'Overige dossiers';
  $checker        = 'joe!';

}



genesis();

function rhswp_show_all_dossiers() {
  global $post;

  $title          = get_field('dossier_overzicht_filter_title', $post->ID );
  $dossierfilter  = get_field('dossier_overzicht_filter', $post->ID );
  $grootte        = get_field('uitgelichte_dossiers', $post->ID );


  if ( ( $grootte ) &&  ( 'dossier_overzicht_filter_ongefilterd' != $dossierfilter ) ) {
    $args = array(
      'taxonomy'              => RHSWP_CT_DOSSIER,
      'hide_empty'            => false,
      'include'               => $grootte,
      'orderby'               => 'name',
      'order'                 => 'ASC',
      'ignore_custom_sort'    => TRUE,
      'echo'                  => 0,
      'title_li'              => ''
    );
  }
  else {
    $args = array(
      'taxonomy'              => RHSWP_CT_DOSSIER,
      'hide_empty'            => false,
      'orderby'               => 'name',
      'order'                 => 'ASC',
      'ignore_custom_sort'    => TRUE,
      'echo'                  => 0,
      'title_li'              => ''
    );
  }

//  $terms = wp_list_categories( $args );

  $terms = get_terms( RHSWP_CT_DOSSIER, $args );

  if ($terms && ! is_wp_error( $terms ) ) { 

    echo $wrapper_start;
    
//    if ( $wrapper_start  && $wrapper_title && $wrapper_end ) {
//      echo $wrapper_start;
//      echo '<h2>' . $wrapper_title . '</h2>';
//    }    

//    if ( 'dossier_overzicht_filter_ongefilterd' != $dossierfilter ) {

      echo '<div class="block">';

//      if ( $title ) {
//        echo '<h2>' . $title . '</h2>';
//      }

//      echo '<div class="dossieroverzicht">';
//      echo '<ul>';
//      echo $terms;
//      echo '</ul>';
//      echo '</div>';

  
      foreach ( $terms as $term ) {
  
        $excerpt    = '';
        $classattr  = 'class="dossieroverzicht"';
        if ( $term->description ) {
          $excerpt  =  $term->description;
        }
        
        $href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
        
        printf( '<article %s>', $classattr );
        printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', $href, $term->name, $excerpt );
        echo '</article>';

      }

      echo '</div>';
      
//    }
//    else {

//      echo '<div class="block">';
//      echo '<ul>';
//      echo $terms;
//      echo '</ul>';
//      echo '</div>';

  
//      foreach ( $terms as $term ) {
  
//        $excerpt    = '';
//        $classattr  = 'class="dossieroverzicht"';
//        if ( $term->description ) {
//          $excerpt  =  $term->description;
//        }
//        
//        $href//       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
//        
//        printf( '<article %s>', $classattr );
//        printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', $href, $term->name, $excerpt );
//        echo '</article>';
//        
//      
//      }
  
  
//      echo '</div>';


//      echo '<div class="dossieroverzicht">';
//      echo '<ul>';
//      echo $terms;
//      echo '</ul>';
//      echo '</div>';

//      echo '<ul>';
//      foreach ( $terms as $term ) {
//          echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
//      }
//      echo '</ul>';
      
//    }
    
    wp_reset_postdata();

    echo $wrapper_end;
  }
}


