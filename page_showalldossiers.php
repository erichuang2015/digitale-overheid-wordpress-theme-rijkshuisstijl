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
 * @version 0.6.13
 * @desc.   Improved  dossier-helper-functions. Only direct descendants in menu shown.
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

    foreach ( $terms as $term ) {

      echo '<article class="dossieroverzicht">';  
      echo '<h2 class="entry-title"><a href="' . get_term_link( $term->term_id, RHSWP_CT_DOSSIER ) . '">' . $term->name .'</a></h2>';  
      if ( $term->description ) {
        echo '<p>' . $term->description .'</p>';  
      }
      echo '</article>';  
    
    }

    wp_reset_postdata();
  
  }
}


