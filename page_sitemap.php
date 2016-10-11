<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_sitemap.php
 * ----------------------------------------------------------------------------------
 * Toont de sitemap. Deze sitemap komt bijna overeen met de sitemap die
 * getoond wordt op de 404-pagina
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.13
 * @desc.   Pagina-templates herzien 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 10 - sitemap-pagina

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_sitemap', 15 );

genesis();
