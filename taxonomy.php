<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - taxonomy.php
 * ----------------------------------------------------------------------------------
 * Taxonomie-pagina voor tip-thema's
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.0 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */



//Removes Title and Description on CPT Archive
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

//Removes Title and Description on Blog Archive
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

//Removes Title and Description on Date Archive
remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );

//Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//Removes Title and Description on Author Archive
//remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );

//Removes Title and Description on Blog Template Page
//remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );



add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );
add_action( 'genesis_before_loop', 'start_flex', 16 );
add_action( 'genesis_after_loop', 'end_flex', 16 );

function start_flex() {
    echo '<div class="flex">';
}

function end_flex() {
    echo '</div>';
}

genesis();
    