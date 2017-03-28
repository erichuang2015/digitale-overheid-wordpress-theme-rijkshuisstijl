<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_showalldossiers.php
 * ----------------------------------------------------------------------------------
 * Toont alle dossiers
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.8.18
 * @desc.   Opmaak voor dossier overzicht aangepast
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: 04 - (dossiers) overzicht alle dossiers (met uitgelichte dossiers)

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

$wrapper_title  = '';
$checker        = '';


add_action( 'genesis_entry_content', 'rhswp_show_all_dossiers', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 12 );

  $wrapper_title  = 'Overige dossiers';
  $checker        = 'joe!';

}

genesis();

function rhswp_show_all_dossiers() {
  global $post;


  $title          = '';
  $dossierfilter  = '';
  $grootte        = '';

  if ( function_exists( 'get_field' ) ) {
	  $title          = get_field('dossier_overzicht_filter_title', $post->ID );
	  $dossierfilter  = get_field('dossier_overzicht_filter', $post->ID );
	  $grootte        = get_field('uitgelichte_dossiers', $post->ID );
  }

// 1 toon alles
// 2 toon alles en uitgelichte dossiers
// 3 toon alleen uitgelichte dossiers

  $args = array(
    'taxonomy'              => RHSWP_CT_DOSSIER,
    'hide_empty'            => false,
    'orderby'               => 'name',
    'order'                 => 'ASC',
    'ignore_custom_sort'    => TRUE,
    'echo'                  => 0,
    'title_li'              => ''
  );
  
	echo '<div class="topicSearchWrapper"><form tabindex="-1" id="rhswp-searchform" class="search-form" itemprop="potentialAction" itemscope="" itemtype="http://schema.org/SearchAction" method="get" action="/" role="search"><meta itemprop="target" content="/?s={s}"><label class="search-form-label screen-reader-text" for="searchform-58da65bb69ca2">Zoek een onderwerp</label><input itemprop="query-input" type="search" name="s" id="searchform-58da65bb69ca2" placeholder="Zoek een onderwerp"><input type="submit" value="Zoek"></form></div>';  
	  
	
  if ( ( $grootte ) &&  ( ( 'dossier_overzicht_filter_plus' == $dossierfilter ) || ( 'dossier_overzicht_filter_only_filter' == $dossierfilter ) ) ) {

	  if ( 'dossier_overzicht_filter_plus' == $dossierfilter ) {

	    $args_filter = array(
	      'taxonomy'              => RHSWP_CT_DOSSIER,
	      'hide_empty'            => false,
	      'include'               => $grootte,
	      'orderby'               => 'name',
	      'order'                 => 'ASC',
	      'ignore_custom_sort'    => TRUE,
	      'echo'                  => 0,
	      'title_li'              => ''
	    );

		  $terms = get_terms( RHSWP_CT_DOSSIER, $args_filter );
		
		  if ($terms && ! is_wp_error( $terms ) ) { 
		
	      echo '<div class="block no-top dossier_overzicht_popular ' . $dossierfilter . '">';
	      echo '<h2>' . $title . '</h2>';
	      echo '<ul class="links">';
	  
	      foreach ( $terms as $term ) {
	  
	        $excerpt    = '';
	        $classattr  = 'class="dossieroverzicht"';
	        $href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );
	        
	        printf( '<li><a href="%s">%s</a>', $href, $term->name );
	
	      }
	
	      echo '</ul>';
	      echo '</div>';
		    
		  }
		  
	  }
	  elseif ( 'dossier_overzicht_filter_only_filter' == $dossierfilter ) {
	    $args = array(
	      'taxonomy'              => RHSWP_CT_DOSSIER,
	      'hide_empty'            => false,
	      'include'               => $grootte,
	      'orderby'               => 'name',
	      'order'                 => 'ASC',
	      'ignore_custom_sort'    => TRUE,
	      'echo'                  => 0,
	      'title_li'              => ''
	    );
	  }
  }

  $terms = get_terms( RHSWP_CT_DOSSIER, $args );

	if ($terms && ! is_wp_error( $terms ) ) { 
		
    echo '<div class="block no-top ' . $dossierfilter . '">';

	  if ( 'dossier_overzicht_filter_as_list' == $dossierfilter ) {
			echo '<ul class="links">';
	  }
		
		foreach ( $terms as $term ) {

			$href       = get_term_link( $term->term_id, RHSWP_CT_DOSSIER );

			if ( 'dossier_overzicht_filter_as_list' == $dossierfilter ) {
				printf( '<li><a href="%s">%s</a></li>', $href, $term->name );
			}
			else {
			
				$excerpt    	= '';
				$classattr  	= 'class="dossieroverzicht"';
				$kortebeschr	= get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', RHSWP_CT_DOSSIER . '_' . $term->term_id );
				
				if ( $kortebeschr ) {
					$excerpt  =  wp_strip_all_tags( $kortebeschr );
				}        
				elseif ( $term->description ) {
					$excerpt  =  wp_strip_all_tags( $term->description );
					$excerptarr = explode( '.', $excerpt );
					$excerpt = $excerptarr[0] . '.';
				}
				
				
				printf( '<article %s>', $classattr );
				printf( '<a href="%s"><h2>%s</h2><p>%s</p></a>', $href, $term->name, $excerpt );
				echo '</article>';
			
			}			
			
		}
		
	  if ( 'dossier_overzicht_filter_as_list' == $dossierfilter ) {
			echo '</ul>';
	  }

		echo '</div>';
		
		wp_reset_postdata();
		

	}
}


