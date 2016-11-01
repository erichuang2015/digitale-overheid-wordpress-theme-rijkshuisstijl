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
 * @version 0.6.11
 * @desc.   Various small code and CSS bugfixes - widget, archive-loop
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

 


add_action( 'genesis_before_loop', 'rhswp_archive_before_loop' );
add_action( 'genesis_after_loop', 'rhswp_archive_after_loop', 1 );

// post navigation verplaatsen tot buiten de flex-ruimte
add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );


/** Code for custom loop */
function rhswp_archive_custom_loop() {
    // code for a completely custom loop
global $post;
            if ( have_posts() ) {

              echo '<div class="block">';
              
              $postcounter = 0;

              while (have_posts()) : the_post();
                $postcounter++;

                $permalink  = get_permalink();
                $excerpt    = wp_strip_all_tags( get_the_excerpt( $post ) );
                $postdate   = get_the_date( );
                $doimage    = false;
                $classattr = genesis_attr( 'entry' );


                
                if ( $postcounter < 3 ) {
                  $doimage    = true;
                } 
                else {
                  $classattr = str_replace( 'has-post-thumbnail', '', $classattr );
                }

                printf( '<article %s>', $classattr );

                
                if ( $doimage ) {
//                  printf( '<div class="article-container"><div class="article-visual"><a href="%s" tabindex="-1">%s</a></div>', get_permalink(), get_the_post_thumbnail( $post->ID, 'featured-post-widget' ) );
                  printf( '<div class="article-container"><div class="article-visual">%s</div>', get_the_post_thumbnail( $post->ID, 'featured-post-widget' ) );
                  printf( '<div class="article-excerpt"><a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a></div></div>', get_permalink(), get_the_title(), $excerpt, $postdate );
                }
                else {
                  printf( '<a href="%s"><h3>%s</h3><p>%s</p><p class="meta">%s</p></a>', get_permalink(), get_the_title(), $excerpt, $postdate );
                }

                
                echo '</article>';
                do_action( 'genesis_after_entry' );

              endwhile;

              echo '</div>';

            }


}
 
/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rhswp_archive_custom_loop' );


function rhswp_archive_before_loop() {
	echo '<div class="flex">';
}
	
function rhswp_archive_after_loop() {
	echo '</div>';
}

	
genesis();
