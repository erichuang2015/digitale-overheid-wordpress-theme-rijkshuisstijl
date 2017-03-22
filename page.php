<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page.php
 * ----------------------------------------------------------------------------------
 * Toont alle dossiers
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.14
 * @desc.   Contentblock kan dossiers tonen. Extra check op taxonomy contentblock toegevoegd.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: standaardpagina


if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}

//========================================================================================================

genesis();



