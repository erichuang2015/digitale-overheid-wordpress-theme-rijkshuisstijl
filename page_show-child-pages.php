<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_show-child-pages.php
 * ----------------------------------------------------------------------------------
 * Toont alle dossiers
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.4.1
 * @desc.   Theme-check, carrousel en extra pagina-layout 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 11 - toon onderliggende pagina's

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersoverview', 15 );

genesis();

function rhswp_get_page_dossiersoverview() {

  global $post;
  
  $args = array( 
        'child_of' => $post->ID, 
        'parent' => $post->ID,
        'hierarchical' => 0,
        'sort_column' => 'menu_order', 
        'sort_order' => 'asc'
  );
  $mypages = get_pages( $args );
  
  foreach( $mypages as $post ) {
  
    echo '<section>';
    echo '<header><h2 class="entry-title"><a href="';
    the_permalink();
    echo '">';
    the_title();
    echo '</a></h2></header>';
    echo '<div>';
  
    if (  has_excerpt( $post->ID ) ) {
      $text = get_the_excerpt( $post->ID );
    } 
    else {
      $text = get_words( get_post_field('post_content', $post->ID ), 35);   
    } 
    if ( !$text ) {
      $text = _x( 'Eh, dit is een pagina zonder tekst', 'Standaardtekst als pagina geen tekst heeft.', 'wp-rijkshuisstijl' );
    }
    echo $text;
    echo rhswp_get_read_more_link( get_permalink() );
    echo '</div>';
    echo '</section>';

  }  
}