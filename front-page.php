<?php

/**
 * wp-rijkshuisstijl - home.php
 * ----------------------------------------------------------------------------------
 * speciale functionaliteit voor de homepage
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.14
 * @desc.   Contentblock kan dossiers tonen. Extra check op taxonomy contentblock toegevoegd.
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

 
//* Template Name: 20 - home-pagina 

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_footer', 'rhswp_write_extra_contentblokken');
}

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

if ( is_home() || is_front_page() ) {

  // widget ruimte
  add_action( 'genesis_loop', 'rhswp_widget_homepage', 12 );
  
}

function rhswp_home_write_title() {
  echo '<header><h1 class="page-title">' . get_the_title() . '</h1></header>';
}

//========================================================================================================

genesis();

