<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_dossiersoverview.php
 * ----------------------------------------------------------------------------------
 * Toont alle dossiers
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.6 
 * @desc.   Dossierpagina's toegevoegd
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: Dossiers: overzicht van alle dossiers 

//* Remove standard post content output
//remove_action( 'genesis_post_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersoverview', 15 );

genesis();

function rhswp_get_page_dossiersoverview() {
  echo '<h1>Dossiers: overzicht van alle dossiers (rhswp_get_page_dossiersoverview)</h1>';  
  
}
