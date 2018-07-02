<?php

/**
// * Rijkshuisstijl (Digitale Overheid) - page_digibeter-home.php
// * ----------------------------------------------------------------------------------
// * Landingspagina voor het onderdeel met de NL Digibeter agenda
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.1.3
// * @desc.   Hero-image obv. featured image. Pagina-template voor Digibeter landingspagina.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// *
 */


//* Template Name: digibeter - landingspagina

//========================================================================================================

remove_action( 'genesis_after_header', 'rhswp_check_caroussel_or_featured_img', 24 );

//* Remove standard header
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_before_content_sidebar_wrap', 'rhswp_digibeter_extra_content', 14 );

add_action( 'genesis_before_content_sidebar_wrap', 'genesis_entry_header_markup_open', 8 );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_post_title', 10 );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_entry_header_markup_close', 12 );

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

genesis();

//========================================================================================================

function rhswp_digibeter_extra_content() {

  if ( get_field( 'digibeter_content_intro', get_the_ID() ) ) {
    // voorkomen dat pagina's met dit template ook een carroussel laten zien
    // deze pagina heeft dus als template 'page_digibeter-home.php' en heeft iets in digibeter_content_intro
    echo get_field( 'digibeter_content_intro', get_the_ID() );

  }

}
