<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - functions.php
 * ----------------------------------------------------------------------------------
 * Zonder functions geen functionaliteit, he?
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.31
 * @desc.   New custom post type for dossiers
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


  
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rhswp_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


  add_action( 'cmb2_admin_init', 'rhswp_register_dossier_actueel_page_metabox' );

  /**
   * Hook in and add a metabox that only appears on the 'About' page
   */
function rhswp_register_dossier_actueel_page_metabox() {


	/**
	 * Metabox to be displayed on a single page ID
	 */

    
    $cmb_dossier_actueel_page = new_cmb2_box( 
      array(
        'id'            => RHSWP_DOSSIER_SEMITAX . 'metabox_page',
        'title'         => __( 'Dossiers', 'wp-rijkshuisstijl' ),
        'object_types'  => array( 'page' ), // Post type
        'context'       => 'side', //  'normal', 'advanced', or 'side'
        'priority'      => 'high',
        'show_names'    => true,
        'closed'        => false,
      )
    );
    
   	$cmb_dossier_actueel_page->add_field( array(
  		'name'        => __( 'Aanwezige dossiers', 'wp-rijkshuisstijl' ),
  		'id'          => RHSWP_DOSSIER_SEMITAX . '_page_radio',
  		'type'        => 'radio',
      'options_cb'  => 'get_dossierx_options',
  	) );

  
    $cmb_dossier_actueel_post = new_cmb2_box( array(
      'id'            => RHSWP_DOSSIER_SEMITAX . 'metabox_post',
      'title'         => __( 'Dossiers', 'wp-rijkshuisstijl' ),
      'object_types'  => array( 'post', RHSWP_CPT_DOCUMENT, RHSWP_CPT_EVENT ), // Post type
      'context'       => 'side', //  'normal', 'advanced', or 'side'
      'priority'      => 'high',
      'show_names'    => true,
      'closed'        => false,
    ));
  
   	$cmb_dossier_actueel_post->add_field( array(
  		'name'        => __( 'Aanwezige dossiers', 'wp-rijkshuisstijl' ),
  		'id'          => RHSWP_DOSSIER_SEMITAX . '_post_radio',
  		'type'        => 'multicheck',
      'options_cb'  => 'get_dossierx_options',
  	) );
      	
  
  // Callback function
  function get_dossierx_options( $field ) {
    
    $args = array(
      'posts_per_page'   => -1,
      'orderby'          => 'name',
      'order'            => 'ASC',
      'post_type'        => RHSWP_CPT_DOSSIER,
      'post_status'      => 'publish',
      'suppress_filters' => true 
    );
    
    $posts_array = get_posts( $args );
    
    $thereturn = array();
    
    foreach ( $posts_array as $post ) : 
      setup_postdata( $post ); 
      $thereturn[$post->post_name] = get_the_title( $post->ID );
    endforeach; 
    
    return $thereturn;
    
  }

}


    //Return true if page template is 'page-template' or id is 30.
function rhswp_check_page_templates() {
  
  $post_id = 0;
  
  // If we're showing it based on ID, get the current ID
  if ( isset( $_GET['post'] ) ) {
    $post_id = $_GET['post'];
  }
  elseif ( isset( $_POST['post_ID'] ) ) {
    $post_id = $_POST['post_ID'];
  }
  
  if ( ! $post_id ) {
    return false;
  }        
  
  $page_template = get_page_template_slug( $post_id );
  $page_template = ! empty( $page_template ) ? substr( $page_template, 0, -4 ) : '';
  
  
  if ( $page_template === 'page_dossiersingle' ) {
    return true;
  }
  elseif ( $page_template === 'page_dossiersingleactueel' ) {
    return true;
  }
  else {
    return false;
  }
}

/**
 * Gets a number of terms and displays them as options
 * @param  CMB2_Field $field 
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_term_options( $field ) {
    $args = $field->args( 'get_terms_args' );
    $args = is_array( $args ) ? $args : array();

    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

    $taxonomy = $args['taxonomy'];

    $terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
        ? get_terms( $args )
        : get_terms( $taxonomy, $args );

    // Initate an empty array
    $term_options = array();
    if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            $term_options[ $term->term_id ] = $term->name;
        }
    }

    return $term_options;
}
