<?php

///**
// * Rijkshuisstijl (Digitale Overheid) - page_dossiersingleactueel.php
// * ----------------------------------------------------------------------------------
// * Toont de berichtten van een dossier
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.2.7
// * @desc.   Voor dossiers: automatische links toegevoegd voor berichten, events, documenten. Plus: search form in breadcrumb.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// */



//* Template Name: 01 - (dossiers) berichtenpagina (evt. met filter)

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingleactueel', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 16 );
}

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

genesis();

