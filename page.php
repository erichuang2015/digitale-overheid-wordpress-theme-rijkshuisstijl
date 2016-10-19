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
 * @version 0.4.1
 * @desc.   Theme-check, carrousel en extra pagina-layout 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: standaardpagina

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_footer', 'rhswp_write_extra_contentblokken');
}
genesis();



