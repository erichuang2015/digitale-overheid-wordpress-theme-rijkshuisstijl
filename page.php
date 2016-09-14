<?php

/**
 * wp-rijkshuisstijl - page.php
 * ----------------------------------------------------------------------------------
 * toont normale pagina's en heeft speciale functionaliteit voor de homepage
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.1 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

 
//* Template Name: RHS2 - content-pagina 


remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

if ( is_home() || is_front_page() ) {

//  remove_action( 'genesis_loop', 'genesis_do_loop' );
 
//	add_action( 'genesis_loop', 'rhswp_home_write_title', 11 );

    // widget ruimte
//	add_action( 'genesis_loop', 'rhswp_widget_homepage', 12 );

//	add_action( 'genesis_loop', 'ibo_home_filter', 15 );

}

function rhswp_home_write_title() {
  echo '<header><h1 class="page-title">' . get_the_title() . '</h1></header>';
}

genesis();

