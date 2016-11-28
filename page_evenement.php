<?php 

/**
 * Gebruiker Centraal page_evenement.php
 * ----------------------------------------------------------------------------------
 * Pagina voor het tonen van een event. Deze combineert template files met custom code
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.13
 * @desc.   Contentblok-checker op diverse pagina's
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */
 

//* Display author box on single posts
add_filter( 'get_the_author_genesis_author_box_single', '__return_false' );


if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );
}


 
dodebug(__FILE__, 'page_evenement'); 

//* Template Name: GC Agenda - pagina met een enkel event  

//* Remove standard header
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove the entry footer markup (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// deze pagina zou moeten worden gebruikt voor een single event.
// in dit theme wordt de weergave van een evenement afgehandeld door bestanden in de folder
// /gebruiker-centraal/plugins/events-manager/

// meer specifiek: de opbouw van een single event komt uit 
// <themes>/gebruiker-centraal/plugins/events-manager/formats/single_event_format.php
// met wat hulpfuncties in functions.php, die aangeroepen worden in 
// <themes>/gebruiker-centraal/plugins/events-manager/templates/event-single.php
// deze variabelen worden later door die functies van een waarde voorzien.
// ofzoiets.

//========================================================================================================
// schema attribute for event
add_filter( 'genesis_attr_entry', 'page_evenement_change_schema_attribute' );

function page_evenement_change_schema_attribute( $attributes ) {
 
 $attributes['itemtype'] = 'http://schema.org/Event';
 return $attributes;

}

//========================================================================================================

// schema attribute for event
add_filter( 'genesis_attr_entry-content', 'page_evenement_change_content_attribute' );
//add_filter( 'genesis_attr_entry', 'page_evenement_change_content_attribute' );

function page_evenement_change_content_attribute( $attributes ) {
 
 $attributes['itemprop'] = '';

 return $attributes;
 
}

//========================================================================================================


$EM_gc_wbvb_single_event_availability  =   '';
$EM_gc_wbvb_single_event_aanmeldingen  =   '';
$EM_gc_wbvb_single_event_organizor     =   '';
$EM_gc_wbvb_single_event_programma     =   '';
$EM_gc_wbvb_single_event_links         =   '';


genesis();
