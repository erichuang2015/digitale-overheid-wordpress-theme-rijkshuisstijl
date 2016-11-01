<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - single-dossierx1.php
 * ----------------------------------------------------------------------------------
 * Taxonomie-pagina voor tip-thema's
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.31
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

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

    
function rhswp_write_filtered_content() {
  
  global $wp_query;



  $args = array(
    'post_type'       => 'post',
    'post_status'     => 'publish',
    'paged'           => $paged,
    'posts_per_page'  => get_option('posts_per_page'),
  );  

  
  $title = '';
  
  if ( $wp_query->query['berichten'] ) {
  
    $dossierslug  = esc_html( $wp_query->query['name'] );
    $selector     = esc_html( $wp_query->query[RHSWP_DOSSIERPOSTCONTEXT] );
    
    if ( $selector == RHSWP_DOSSIERDOCUMENTCONTEXT ) {
      // select documents
      $args = array(
        'post_type'       => RHSWP_CPT_DOCUMENT,
        'post_status'     => 'publish',
        'paged'           => $paged,
        'posts_per_page'  => get_option('posts_per_page'),
      
        'meta_query' => array(
          array(
              'key'     => RHSWP_DOSSIER_SEMITAX . '_post_radio',
              'value'   => $dossierslug,
              'compare' => 'like'
          )
        ));
        
        $obj = get_post_type_object( RHSWP_CPT_DOCUMENT );
        $title = $obj->labels->name;              
        
    }
    elseif ( $selector == RHSWP_DOSSIEREVENTCONTEXT ) {
      // select event
      $args = array(
        'post_type'       => RHSWP_CPT_EVENT,
        'post_status'     => 'publish',
        'paged'           => $paged,
        'posts_per_page'  => get_option('posts_per_page'),
      
        'meta_query' => array(
          array(
              'key'     => RHSWP_DOSSIER_SEMITAX . '_post_radio',
              'value'   => $dossierslug,
              'compare' => 'like'
          )
        ));      

        $obj = get_post_type_object( RHSWP_CPT_EVENT );
        $title = $obj->labels->name;              

    }
    else {

      $my_category = get_term_by( 'slug', $selector, 'category' );
    
      if ( $my_category ) { 
        
        $title = $my_category->name;
        
        $args = array(
          'post_type'       => 'post',
          'post_status'     => 'publish',
          'paged'           => $paged,
          'posts_per_page'  => get_option('posts_per_page'),
        
          'meta_query' => array(
            array(
                'key'     => RHSWP_DOSSIER_SEMITAX . '_post_radio',
                'value'   => $dossierslug,
                'compare' => 'like'
            )
          ),
          'tax_query' => array(
            array(
              'taxonomy'  => 'category',
              'field'     => 'slug',
              'terms'     => $selector,
            )
          ));
          
      }
    }  
  }

  $wp_query = new WP_Query( $args );
  
  if( $wp_query->have_posts() ) {
  
    if ( $title ) {
      echo '<h2>' . $title . '</h2>';
    }

    echo '<ul>';

    while( $wp_query->have_posts() ): 
      $wp_query->the_post(); 
      global $post;

      echo '<li><a href="' . get_the_permalink  () . '">' . get_the_title() . '</a></li>';

    endwhile;

    echo '</ul>';

    genesis_posts_nav();
    
  }
  // RESET THE QUERY
  wp_reset_query();
        
    
}