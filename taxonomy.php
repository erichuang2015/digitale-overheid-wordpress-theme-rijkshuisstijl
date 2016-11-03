<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - taxonomy.php
 * ----------------------------------------------------------------------------------
 * Taxonomie-pagina voor tip-thema's
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.13
 * @desc.   Improved  dossier-helper-functions. Only direct descendants in menu shown.
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

//* Remove the entry meta in the entry footer
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

genesis();
    