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
 * @version 0.1.13
 * @desc.   Pagina-templates herzien 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 01 - (dossiers) overzichtspagina voor een dossier 

//* Remove standard post content output
//remove_action( 'genesis_post_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingle', 15 );

genesis();

function rhswp_get_page_dossiersingle() {
  echo '<h2>Meer</h2>';  
  echo '<p>Hieronder allerlei relevante elementen (rhswp_get_page_dossiersingle)</p>';  
}
