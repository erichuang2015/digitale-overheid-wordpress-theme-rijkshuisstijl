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
 * @version 0.7.10
 * @desc.   CSS: list item arrow, flex on .home, search form in header
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 04 - (dossiers) overzicht alle dossiers (met uitgelichte dossiers)

add_action( 'genesis_entry_content', 'rhswp_show_all_dossiers', 15 );

genesis();

function rhswp_show_all_dossiers() {
  global $post;



  $grootte    = get_field('uitgelichte_dossiers', $post->ID );

  if ( $grootte ) {
    $terms = get_terms( RHSWP_CT_DOSSIER, array(
      'hide_empty' => false,
      'include' => $grootte
    ) );
  }
  else {
    $terms = get_terms( RHSWP_CT_DOSSIER, array(
      'hide_empty' => false,
    ) );
  }

  if ($terms && ! is_wp_error( $terms ) ) { 

    echo '<div class="block">';

    foreach ( $terms as $term ) {

      $excerpt    = '';
      $classattr  = 'dossieroverzicht';
      if ( $term->description ) {
        $excerpt  =  $term->description;
      }
      
      $href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
      
      printf( '<article %s>', $classattr );
      printf( '<a href="%s"><h3>%s</h3><p>%s</p></a>', $href, $term->name, $excerpt );
      echo '</article>';
      
    
    }


    echo '</div>';

    wp_reset_postdata();
  
  }
}


