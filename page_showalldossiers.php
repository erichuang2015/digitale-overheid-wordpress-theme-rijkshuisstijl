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
 * @version 0.1.11
 * @desc.   Overzichtspagina voor dossiers toegevoegd, plus optie om deze in broodkruimelpad op te nemen 
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

      echo '<div class="dossieroverzicht" style="border: 1px solid #adadad; padding: 1em; background: #e0e0e0;">';  
      echo '<h2 class="entry-title"><a href="' . get_term_link( $term->term_id, RHSWP_CT_DOSSIER ) . '">' . $term->name .'</a></h2>';  
      echo '<p>' . $term->description .'</p>';  
      echo '</div>';  
    
    }

    wp_reset_postdata();
  
  }
}


