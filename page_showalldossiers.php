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
 * @version 0.1.12
 * @desc.   Dossieroverzicht herzien, documentdownload toegevoegd, read-more gewijzigd, breadcrumb gewijzigd 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: Show all dossiers 

add_action( 'genesis_entry_content', 'rhswp_show_all_dossiers', 15 );

genesis();

function rhswp_show_all_dossiers() {
  global $post;

    
  
  $terms = get_terms( RHSWP_CT_DOSSIER, array(
    'hide_empty' => false,
  ) );

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


