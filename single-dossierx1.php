<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - single-dossierx1.php
 * ----------------------------------------------------------------------------------
 * Taxonomie-pagina voor tip-thema's
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.17
 * @desc.   New custom post type for dossiers
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

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );

// add extra content blocks
add_action( 'genesis_after_loop', 'rhswp_write_extra_contentblokken', 10 );

// add extra content blocks
add_action( 'genesis_after_loop', 'rhswp_write_filtered_content', 10 );

genesis();
    
function rhswp_write_filtered_content() {


$prefix = 'rhswp_dossierlinks_';	 



$slugs = array( 'nieuws' );

$dossiernummer = array( 761, 760 );


$dossierslug  = 'nou-dit-dan';
$categoryslug = 'nieuws';

    $args = array(
      'post_type' => 'post',
      'post_status'     => 'publish',
      'posts_per_page'  => -1,

      'meta_query' => array(
        array(
            'key'     => $prefix . '_post_radio',
            'value'   => $dossierslug,
            'compare' => 'like'
        )
      ),
      
      'tax_query' => array(
        array(
          'taxonomy'  => 'category',
          'field'     => 'slug',
          'terms'     => $categoryslug,
        )
      )
    );

    $sidebarposts = new WP_query();
    $sidebarposts->query($args);
    if ( $sidebarposts->have_posts() ) {

      echo '<ul>';
  
      $postcounter = 0;
  
      while ($sidebarposts->have_posts()) : $sidebarposts->the_post();
      
        echo '<li>' . get_the_title() . '</li>';

      endwhile;

      echo '</ul>';
      
    }
    // RESET THE QUERY
    wp_reset_query();
    
//query_posts($args); while (have_posts()) : the_post(); 

//get_query_var( RHSWP_DOSSIERPOSTCONTEXT );
  
}