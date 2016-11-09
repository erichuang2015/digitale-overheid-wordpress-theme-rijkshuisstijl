<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - search-helper-functions.php
 * ----------------------------------------------------------------------------------
 * functies voor zoekfunctionaliteit
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.1
 * @desc.   Search functions - search via SearchWP
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//========================================================================================================

function searchwp_term_highlight_auto_excerpt( $excerpt ) {
	global $post;
	
	if ( ! is_search() ) {
		return $excerpt;
	}
	// prevent recursion
	remove_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );
	
	$global_excerpt = searchwp_term_highlight_get_the_excerpt_global( $post->ID, null, get_search_query() );

	add_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );

	return 'ik ben gefilterd, heur! ' . $global_excerpt;

}

//add_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );

//========================================================================================================

function my_maybe_include_term_archive( $include, $engine, $terms ) {
  // only have term archives included for supplemental search engine with name 'supplemental'
  return ( $engine == 'supplemental' ) ? true : false;
}

add_filter( 'searchwp_term_archive_enabled', 'my_maybe_include_term_archive', 10, 3 );

//========================================================================================================

