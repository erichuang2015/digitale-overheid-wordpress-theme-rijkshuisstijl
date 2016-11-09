<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - XXXXsearch.php
 * ----------------------------------------------------------------------------------
 * Zoekresultaatpagina
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.1
 * @desc.   Search functions - search via SearchWP
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

// add description
add_action( 'genesis_before_loop', 'rhswp_add_search_description', 15 );



/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );


genesis();

function rhswp_add_search_description() {

$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis' ) . ' &#x02026;' );
  
  echo '<h1>XXXXsearch.php / Zoekresultaten voor "' . $search_text . '"</h1>';
  
  get_search_form();
  
}