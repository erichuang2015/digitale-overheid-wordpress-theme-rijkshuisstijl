<?php

/**
// wp-rijkshuisstijl - home.php
// ----------------------------------------------------------------------------------
// speciale functionaliteit voor de homepage
// ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.2.2
// * @desc.   Removed the menu bar.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
// 
 */

//* Template Name: 20 - home-pagina 

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_after_header', 'genesis_do_nav',                         14 );


remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

if ( is_home() || is_front_page() ) {

  // dossiers (onderwerpen) + widget ruimte
  add_action( 'genesis_loop', 'rhswp_home_onderwerpen_dossiers', 12 );

  // nieuws
  add_action( 'genesis_loop', 'rhswp_write_extra_contentblokken', 14 );

}

//========================================================================================================

function rhswp_home_onderwerpen_dossiers() {

  $maxnr = 4;
  $rowcounter = 0;
  $breedte = 'vollebreedte';
  
  if ( is_active_sidebar( RHSWP_HOME_WIDGET_AREA ) ) {

    $maxnr = 3;
    $breedte = 'driekwart';

  }

  echo '<section class="onderwerpen">';
  echo '<div class="wrap">';
    
  if( have_rows( 'home_onderwerpen_dossiers' ) ) {

    echo '<div class="' . $breedte . '">';
    echo '<div class="row">';

    while( have_rows( 'home_onderwerpen_dossiers') ): the_row(); 
    
      $rowcounter++;

      $url_extern   = get_sub_field('kies_een_onderwerp');
      $acfid        = RHSWP_CT_DOSSIER . '_' . $url_extern->term_id;
      $kortebeschr  = get_field( 'dossier_korte_beschrijving_voor_dossieroverzicht', $acfid );
      $description  = $url_extern->description;

      if ( 'standaardbeschrijving' != get_sub_field( 'welke_beschrijving' ) ) {
        $description = get_sub_field( 'andere_beschrijving' );
      }
      elseif ( $kortebeschr ) {
        $description = $kortebeschr;
      }

// to do

//WOEHOE!! Waar isme dinges?      
      

      $name = 'naam';
      $url  = '';
      if ( $url_extern ) {
        $name = $url_extern->name;
        $url  = get_term_link( $url_extern->term_id );
      }
    
      echo '<a href="' . $url . '" class="linkblock"><h3>' .  $name . '</h3><p>' .  wp_strip_all_tags( $description ) . '</p></a>';

      if ( $rowcounter >= $maxnr ) {
        echo '</div>';
        echo '<div class="row">';
        $rowcounter = 0;
      }


    endwhile; 

    echo '</div>';
    echo '</div>';


  }
  if ( is_active_sidebar( RHSWP_HOME_WIDGET_AREA ) ) {

    dynamic_sidebar( RHSWP_HOME_WIDGET_AREA );

  }

  echo '</section>';
      
}

//========================================================================================================

genesis();

