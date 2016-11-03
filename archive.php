<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - archive.php
 * ----------------------------------------------------------------------------------
 * Toont de aanwezige content
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.13
 * @desc.   Improved  dossier-helper-functions. Only direct descendants in menu shown.
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

 

// post navigation verplaatsen tot buiten de flex-ruimte
add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );

/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );

	
genesis();
