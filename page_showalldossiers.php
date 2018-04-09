<?php


// Rijkshuisstijl (Digitale Overheid) - page_showalldossiers.php
// ----------------------------------------------------------------------------------
// Toont alle dossiers
// ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 0.11.8
// * @desc.   Onderwerppagina: keuzemogelijkheid voor onderwerpen.
// * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/


//* Template Name: 04 - (dossiers, oude styling) overzicht dossiers met beschrijving

$wrapper_title  = '';
$checker        = '';

$wrapper_start  = '<div class="block no-top">';
$wrapper_end    = '</div>';

//========================================================================================================

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_entry_content', 'rhswp_show_all_dossiers', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 12 );

  $wrapper_title  = 'Overige dossiers';
  $checker        = 'joe!';

}

genesis();

//========================================================================================================

function rhswp_show_all_dossiers() {
  global $post;
  global $wrapper_start;
  global $wrapper_end;


  $dossierfilter    = '';
  $featonderwerpen  = '';

  if ( function_exists( 'get_field' ) ) {

	  $dossierfilter    = get_field('dossier_overzicht_filter', $post->ID );
	  if ( 'dossier_overzicht_filter_selected' == $dossierfilter ) {
		  $featonderwerpen  = get_field('uitgelichte_dossiers', $post->ID );
	  }
	  
  }


  $args_filter = array(
    'taxonomy'              => RHSWP_CT_DOSSIER,
    'hide_empty'            => false,
    'orderby'               => 'name',
    'order'                 => 'ASC',
    'ignore_custom_sort'    => TRUE,
    'echo'                  => 0,
    'title_li'              => ''
  );

  
  if ( ( $featonderwerpen ) && ( 'dossier_overzicht_filter_selected' == $dossierfilter ) ) {

		// extra filter voor de onderwerpen
    $args_filter['include'] = $featonderwerpen;
	  
  }

  $terms = get_terms( RHSWP_CT_DOSSIER, $args_filter );

  if ($terms && ! is_wp_error( $terms ) ) { 

    echo $wrapper_start;


      echo '<div class="block no-top">';
  
      foreach ( $terms as $term ) {
  
        $excerpt    = '';
        $classattr  = 'class="dossieroverzicht"';
        if ( $term->description ) {
          $excerpt  =  wp_strip_all_tags( $term->description );
        }
        
        $href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
        
        printf( '<article %s>', $classattr );
        printf( '<a href="%s"><h2>%s</h2><p>%s</p></a>', $href, $term->name, $excerpt );
        echo '</article>';

      }

      echo '</div>';
    
    wp_reset_postdata();

    echo $wrapper_end;
  }
}

//========================================================================================================

