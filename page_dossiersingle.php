<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_dossiersingle.php
 * ----------------------------------------------------------------------------------
 * Toont de index-pagina van een dossier
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.6 
 * @desc.   Dossierpagina's toegevoegd
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: Dossiers: overzichtspagina voor een dossier 

//* Remove standard post content output
//remove_action( 'genesis_post_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingle', 15 );

genesis();

function rhswp_get_page_dossiersingle() {
  echo '<h1>overzichtspagina voor een dossier (rhswp_get_page_dossiersingle)</h1>';  
  
}
