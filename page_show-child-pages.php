<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_show-child-pages.php
 * ----------------------------------------------------------------------------------
 * Toont onderliggende pagina's
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.8.1
 * @desc.   Sitemap uitgebreid (filtersitemap=nee), 'article-visual' als nieuw beeldformaat toegevoegd. CSS wijzigingen voor list-items. Revisie van dossier-menu. 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 11 - toon onderliggende pagina's

add_action( 'genesis_entry_content', 'rhswp_get_page_childpages', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}


//========================================================================================================

genesis();

function rhswp_get_page_childpages() {

  global $post;
  $currentpostID    = $post->ID;
  $pagetemplateslug = basename( get_page_template_slug( $currentpostID ) );
  
  $args = array( 
        'child_of'      => $currentpostID, 
        'parent'        => $currentpostID,
        'hierarchical'  => 0,
        'sort_column'   => 'menu_order', 
        'sort_order'    => 'asc'
  );
  $mypages = get_pages( $args );

  
  foreach( $mypages as $post ) {

    $image      = get_the_post_thumbnail( $post->ID, 'featured-post-widget' );
    $classattr  = '';
  
    if (  has_excerpt( $post->ID ) ) {
      $text = get_the_excerpt( $post->ID );
    } 
    else {
      $thecontent = wp_strip_all_tags( get_post_field('post_content', $post->ID ) );
      $text = get_words( $thecontent, get_option( 'excerpt_length' ) );   
    } 
    if ( !$text ) {
      $text = _x( 'Eh, dit is een pagina zonder tekst', 'Standaardtekst als pagina geen tekst heeft.', 'wp-rijkshuisstijl' );
    }

    printf( '<article %s>', $classattr );
    if ( $image ) {
      printf( '<div class="article-container"><div class="article-visual">%s</div>', $image );
      printf( '<div class="article-excerpt"><a href="%s"><h2>%s</h2><p>%s</p></a></div></div>', get_permalink(), get_the_title(), $text );
    }
    else {
      printf( '<a href="%s"><h2>%s</h2><p>%s</p></a>', get_permalink(), get_the_title(), $text );
    }

  }
    
}
