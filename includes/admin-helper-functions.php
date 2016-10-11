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
 * @version 0.1.14
 * @desc.   CSS styling voor RHS 
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

