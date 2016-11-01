<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - admin-helper-functions.php
 * ----------------------------------------------------------------------------------
 * functies bewerkingen aan de admin-kant
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.6.31
 * @desc.   New custom post type for dossiers
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//========================================================================================================
// columns for dossiers taxonomy
add_filter("manage_edit-dossiers_columns", 'admin_dossiers_columns'); 
 
function admin_dossiers_columns($theme_columns) {
    $new_columns = array(
        'cb'                        => '<input type="checkbox" />',
        'name'                      => __('Dossiernaam', 'wp-rijkshuisstijl' ),
        'description'               => __('Beschrijving', 'wp-rijkshuisstijl' ),
//        'posts'                     => __('Aantal posts', 'wp-rijkshuisstijl' ),
    );
    return $new_columns;
}
 


// Add to admin_init function   
add_filter("manage_dossiers_custom_column", 'admin_manage_theme_columns_dossiers', 10, 3);

function admin_manage_theme_columns_dossiers($out, $column_name, $theme_id) {

    global $post;
    global $column;
    
    switch ( $column_name ){


        default:
            break;
    }
    if ("ID" == $column) echo $post->ID;
    elseif ("title" == $column) echo "title : " . $post->post_content;

    
}

//========================================================================================================

function dodebug( $string, $tag = 'p' ) {
  if ( WP_DEBUG ) {
    echo '<' . $tag . ' class="debugstring"> ' . $string . '</' . $tag . '>';
  }
}

//========================================================================================================

function dodebug2($file = '', $extra = '') {
  if ( ( WP_DEBUG ) && ( 22 == 22 ) ){
    $break = Explode('/', $file);
    $pfile = $break[count($break) - 1]; 
  
    echo '<hr><span class="debugmessage" title="' . $file . '">' . $pfile;
    if ( $extra ) {
        echo ' - ' . $extra;
    }
    echo '</span>';
  }
}

//========================================================================================================

function dovardump($data) {
    echo '<hr><pre>';
    print_r($data);
    echo '</pre><hr>';
}        


//========================================================================================================

function rhswp_admin_display_wpquery_in_context() {


  global $wp_query;

  $meta = get_post_meta( get_the_ID(), RHSWP_DOSSIER_SEMITAX . '_post_radio', true);

  if ( $meta ) {
    dodebug('post meta:');
    dovardump( $meta );
  }

  dovardump($wp_query->query['berichten']);
//  dovardump($wp_query);

  
  dodebug('wp_query->query:');
  dovardump($wp_query->query);
  
}    

//========================================================================================================

function admin_append_editor_styles() {
    add_editor_style(RHSWP_THEMEFOLDER . '/css/editor-styles.css');
}
add_action( 'init', 'admin_append_editor_styles' );

//========================================================================================================

function rhswp_admin_debug_css() {
  if ( SHOW_CSS_DEBUG && WP_DEBUG ) {
    wp_enqueue_style( 'debug-css', RHSWP_THEMEFOLDER . '/css/debug-css.css', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'header-counter-css', RHSWP_THEMEFOLDER . '/css/header.css', array(), CHILD_THEME_VERSION );
  }
}
if ( WP_DEBUG ) {
    add_action( 'wp_enqueue_scripts', 'rhswp_admin_debug_css' );
}

//========================================================================================================

if ( SHOW_CSS_DEBUG ) {
  //* Add role to header
  add_filter('genesis_attr_site-header', 'rhswp_add_attribute_role_banner');
  
  function rhswp_add_attribute_role_banner($attributes) {
  	$attributes['role'] .= 'banner';
  	return $attributes;
  }

  //* Add role to footer
  add_filter('genesis_attr_site-footer', 'rhswp_add_attribute_role_contentinfo');
  
  function rhswp_add_attribute_role_contentinfo($attributes) {
    $attributes['role'] .= 'contentinfo';
    return $attributes;
  }
}

//========================================================================================================

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
  .cmb2-wrap .cmb-row {
    margin: 0 !important;
    border-bottom-style: none  !important;
    padding-top: 0 !important;
  }
  .cmb2-text-url,
  .cmb2-text-url input.cmb2-text-medium{
    width: 100% !important;
  }
  </style>';
}

//========================================================================================================

function is_posts_page() {
	return ( is_home() && 'page' == get_option( 'show_on_front' ) );
}

//========================================================================================================



