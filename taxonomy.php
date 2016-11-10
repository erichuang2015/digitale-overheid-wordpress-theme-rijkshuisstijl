<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - taxonomy.php
 * ----------------------------------------------------------------------------------
 * Taxonomie-pagina voor tip-thema's
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.3
 * @desc.   Content-blokken herzien
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

if ( rhswp_extra_contentblokken_checker() ) {

  // replace default loop with extra blocks
  remove_action( 'genesis_loop', 'genesis_do_loop' );
  add_action( 'genesis_before_loop', 'rhswp_write_extra_contentblokken', 16 );
  
}
else {
  add_action( 'genesis_before_loop', 'rhswp_write_contentblok_waarschuwing', 16 );
}

genesis();
    

function rhswp_write_contentblok_waarschuwing() {
  echo '<p>' . __( 'Hier staat alle content voor dit dossier.', 'wp-rijkshuisstijl' ) . '</p>';

  $user = wp_get_current_user();
  if ( in_array( 'manage_categories', (array) $user->allcaps ) ) {
    //The user has the "author" role

    $queried_object = get_queried_object();
    $edit_link = esc_url( get_edit_term_link( $queried_object->term_id ) );    
    
    echo '</p><div style="border: 1px solid black; padding: 1em;"><h2>' . __( 'Noot voor de redactie', 'wp-rijkshuisstijl' ) . 
    '</h2><p>' . __( 'Dit is een ongefilterde weergaven van alle content, aflopend gesoorteerd op de laatste toevoegingsdatum. Het verdient aanbeveling om hiervoor contentblokken te gebruiken. Deze worden getoond in plaats van deze lijst.', 'wp-rijkshuisstijl' ) . '.</a>';
    echo '<br><a href="' . $edit_link . '">' . __( 'Voeg contentblokken toe om deze pagina te structureren', 'wp-rijkshuisstijl' ) . '.</a>';
    echo '<br><em>' . __( 'Deze tekst wordt alleen getoond aan redacteuren die taxonomieën mogen wijzigen.', 'wp-rijkshuisstijl' ) . '</em></div>';
    

  }  


//  dovardump($user);
  
}    