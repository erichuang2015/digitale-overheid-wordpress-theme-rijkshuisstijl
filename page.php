<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page.php
// * ----------------------------------------------------------------------------------
// * Toont alle dossiers
// * ----------------------------------------------------------------------------------
// * 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 0.11.12
// * @desc.   Contactformulier: later in de loop gezet, net iets voor socmed-icoontjes.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: standaardpagina


if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}


//========================================================================================================

genesis();



