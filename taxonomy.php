<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - taxonomy.php
 * ----------------------------------------------------------------------------------
 * Taxonomie-pagina voor tip-thema's
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.4.2
 * @desc.   Theme-check, carrousel en extra pagina-layout - bugfixes
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */



//Removes Title and Description on CPT Archive
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

//Removes Title and Description on Blog Archive
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

//Removes Title and Description on Date Archive
remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );

//Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );

if ( rhswp_extra_contentblokken_checker() ) {

  // replace default loop with extra blocks
  remove_action( 'genesis_loop', 'genesis_do_loop' );
  add_action( 'genesis_before_loop', 'rhswp_write_extra_contentblokken', 16 );
  
}

genesis();
    