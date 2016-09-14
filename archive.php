<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - archive-fiche.php
 * ----------------------------------------------------------------------------------
 * Toont de aanwezige fiches
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.0 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

 


add_action( 'genesis_before_loop', 'rhswp_fiche_archive_before_loop' );
add_action( 'genesis_after_loop', 'rhswp_fiche_archive_after_loop', 1 );

// post navigation verplaatsen tot buiten de flex-ruimte
add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

function rhswp_fiche_archive_before_loop() {
//    echo '<h2>' . __( "Fiches", 'wp-rijkshuisstijl' ) . '</h2>';
	echo '<div class="flex">';
}
	
function rhswp_fiche_archive_after_loop() {
	echo '</div>';
}

	
genesis();
