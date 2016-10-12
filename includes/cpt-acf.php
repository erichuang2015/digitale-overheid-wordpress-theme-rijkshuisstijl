<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - cpt-acf.php
 * -------------------------------------------------------------------------------------------------------
 * Definities van:
 *  - custom taxonomies: CTAX_thema / CTAX_contentsoort 
 *  - Advanced Custom Fields voor diverse plekken
 * -------------------------------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.15
 * @desc.   SVG images, Kleurcheck, CSS RHS, widgets, code-opschoning 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */




//========================================================================================================

add_action( 'init', 'rhswp_register_my_taxes' );

function rhswp_register_my_taxes() {
	$labels = array(
		"name" => __( 'Dossiers', 'wp-rijkshuisstijl' ),
		"singular_name" => __( 'Dossier', 'wp-rijkshuisstijl' ),
		);

	$labels = array(
		"name"                  => __( 'Dossiers', 'wp-rijkshuisstijl' ),
		"singular_name"         => __( 'Dossier', 'wp-rijkshuisstijl' ),
		"menu_name"             => __( 'Dossiers', 'wp-rijkshuisstijl' ),
		"all_items"             => __( 'Alle dossiers', 'wp-rijkshuisstijl' ),
		"add_new"               => __( 'Nieuw dossier toevoegen', 'wp-rijkshuisstijl' ),
		"add_new_item"          => __( 'Voeg nieuw dossier toe', 'wp-rijkshuisstijl' ),
		"edit_item"             => __( 'Bewerk dossier', 'wp-rijkshuisstijl' ),
		"new_item"              => __( 'Nieuw dossier', 'wp-rijkshuisstijl' ),
		"view_item"             => __( 'Bekijk dossier', 'wp-rijkshuisstijl' ),
		"search_items"          => __( 'Zoek dossier', 'wp-rijkshuisstijl' ),
		"not_found"             => __( 'Geen dossiers gevonden', 'wp-rijkshuisstijl' ),
		"not_found_in_trash"    => __( 'Geen dossiers gevonden in de prullenbak', 'wp-rijkshuisstijl' ),
		"featured_image"        => __( 'Uitgelichte afbeelding', 'wp-rijkshuisstijl' ),
		"archives"              => __( 'Overzichten', 'wp-rijkshuisstijl' ),
		"uploaded_to_this_item" => __( 'Bijbehorende bestanden', 'wp-rijkshuisstijl' ),
		);



	$args = array(
		"label"               => __( 'Dossiers', 'wp-rijkshuisstijl' ),
		"labels"              => $labels,
		"public"              => true,
		"hierarchical"        => true,
		"label"               => __( 'Dossiers', 'wp-rijkshuisstijl' ),
		"show_ui"             => true,
		"show_in_menu"        => true,
		"show_in_nav_menus"   => true,
		"query_var"           => true,
		"rewrite"             => array( 'slug' => RHSWP_CT_DOSSIER, 'with_front' => true, ),
		"show_admin_column"   => false,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"show_in_quick_edit"  => false,
	);
	register_taxonomy( RHSWP_CT_DOSSIER, array( "post", "page", "links", 'event', "document" ), $args );

  add_action( 'admin_menu', 'myprefix_remove_meta_box');
  
  function myprefix_remove_meta_box(){
     remove_meta_box( RHSWP_CT_DOSSIER . 'div', array( 'page' ), 'normal');
  }
  

}


//========================================================================================================

add_action( 'init', 'rhswp_register_custom_post_types' );

/* 
* Register custom post types
*/  

function rhswp_register_custom_post_types() {
  
  /* 
  * Documenten
  */  
  
	$labels = array(
		"name"                  => __( 'Documenten', 'wp-rijkshuisstijl' ),
		"singular_name"         => __( 'Document', 'wp-rijkshuisstijl' ),
		"menu_name"             => __( 'Documenten', 'wp-rijkshuisstijl' ),
		"all_items"             => __( 'Alle documenten', 'wp-rijkshuisstijl' ),
		"add_new"               => __( 'Nieuw document toevoegen', 'wp-rijkshuisstijl' ),
		"add_new_item"          => __( 'Voeg nieuw document toe', 'wp-rijkshuisstijl' ),
		"edit_item"             => __( 'Bewerk document', 'wp-rijkshuisstijl' ),
		"new_item"              => __( 'Nieuw document', 'wp-rijkshuisstijl' ),
		"view_item"             => __( 'Bekijk document', 'wp-rijkshuisstijl' ),
		"search_items"          => __( 'Zoek document', 'wp-rijkshuisstijl' ),
		"not_found"             => __( 'Geen documenten gevonden', 'wp-rijkshuisstijl' ),
		"not_found_in_trash"    => __( 'Geen documenten gevonden in de prullenbak', 'wp-rijkshuisstijl' ),
		"featured_image"        => __( 'Uitgelichte afbeelding', 'wp-rijkshuisstijl' ),
		"archives"              => __( 'Overzichten', 'wp-rijkshuisstijl' ),
		"uploaded_to_this_item" => __( 'Bijbehorende bestanden', 'wp-rijkshuisstijl' ),
		);

	$args = array(
		"label"               => __( 'Documenten', 'wp-rijkshuisstijl' ),
		"labels"              => $labels,
		"description"         => "",
		"public"              => true,
		"publicly_queryable"  => true,
		"show_ui"             => true,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"has_archive"         => true,
		"show_in_menu"        => true,
		"exclude_from_search" => false,
		"capability_type"     => "post",
		"map_meta_cap"        => true,
		"hierarchical"        => false,
		"rewrite"             => array( "slug" => RHSWP_CPT_DOCUMENT, "with_front" => true ),
		"query_var"           => true,
		"supports"            => array( "title", "editor", "thumbnail", "excerpt" ),		
		"taxonomies"          => array( "dossiers" ),
			);
	register_post_type( RHSWP_CPT_DOCUMENT, $args );


  /* 
  * Relevante links
  */  

	$labels = array(
		"name"                  => "Relevante links",
		"singular_name"         => "Relevante link",
		"menu_name"             => "Relevante links",
		"all_items"             => "Alle relevante links",
		"add_new"               => "Nieuwe toevoegen",
		"add_new_item"          => "Nieuw relevante link toevoegen",
		"edit"                  => "Bewerken?",
		"edit_item"             => "Bewerk relevante link",
		"new_item"              => "Nieuw relevante link",
		"view"                  => "Toon",
		"view_item"             => "Bekijk relevante link",
		"search_items"          => "Zoek relevante link",
		"not_found"             => "Niet gevonden",
		"not_found_in_trash"    => "Geen relevante links gevonden in de prullenbak",
		"parent"                => "Hoofd",
		);

	$args = array(
		"labels"                => $labels,
		"description"           => "",
		"public"                => true,
		"show_ui"               => true,
		"show_in_rest"          => true,
		"has_archive"           => true,
		"show_in_menu"          => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => RHSWP_LINK_CPT, "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "excerpt", "revisions", "thumbnail" ),				
	);
	register_post_type( RHSWP_LINK_CPT, $args );



// End of rhswp_register_custom_post_types()
}


//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array (
  	'key' => 'group_57e8f17964532',
  	'title' => 'Document',
  	'fields' => array (
  		array (
  			'key' => 'field_57e8f1821cab5',
  			'label' => 'Bijbehorend document',
  			'name' => 'rhswp_document_upload',
  			'type' => 'file',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'return_format' => 'array',
  			'library' => 'all',
  			'min_size' => '',
  			'max_size' => '',
  			'mime_types' => '',
  		),
  		array (
  			'key' => 'field_57faa99195748',
  			'label' => 'Bestandstype',
  			'name' => 'rhswp_document_filetype',
  			'type' => 'text',
  			'instructions' => 'Denk aan: PDF, Word-document, tekstbestand',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array (
  			'key' => 'field_57faa9a013f5f',
  			'label' => 'Document-grootte',
  			'name' => 'rhswp_document_filesize',
  			'type' => 'text',
  			'instructions' => 'bijvoorbeeld: 372KB, of: 2MB',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => RHSWP_CPT_DOCUMENT,
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));

  //========================================================================================================
  // dit is de oude code, dus die bewaar ik voor nu, maar gebruik deze niet.
  if ( 22 == 33 ) {
    
    acf_add_local_field_group(array (
    	'key' => 'group_57dfd27420525',
    	'title' => 'Voor taxonomie: selecteer menu en overzichtpagina',
    	'fields' => array (
    		array (
    			'key' => 'field_57e411ac51413',
    			'label' => 'Overzichtpagina?',
    			'name' => 'dossier_overzichtpagina',
    			'type' => 'post_object',
    			'instructions' => 'Welke pagina is de overzichtspagina die hoort bij dit dossier?',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    		array (
    			'key' => 'field_57e4122051414',
    			'label' => 'Menu voor dossier',
    			'name' => 'menu_voor_dossier',
    			'type' => 'repeater',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'collapsed' => '',
    			'min' => '',
    			'max' => '',
    			'layout' => 'table',
    			'button_label' => 'Nieuw item toevoegen aan het menu',
    			'sub_fields' => array (
    				array (
    					'key' => 'field_57e4124751415',
    					'label' => 'Pagina',
    					'name' => 'dossier_menu_pagina',
    					'type' => 'post_object',
    					'instructions' => '',
    					'required' => 0,
    					'conditional_logic' => 0,
    					'wrapper' => array (
    						'width' => '',
    						'class' => '',
    						'id' => '',
    					),
    					'post_type' => array (
    					),
    					'taxonomy' => array (
    					),
    					'allow_null' => 0,
    					'multiple' => 0,
    					'return_format' => 'object',
    					'ui' => 1,
    				),
    			),
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => RHSWP_CT_DOSSIER,
    			),
    		),
    		array (
    			array (
    				'param' => 'user_form',
    				'operator' => '==',
    				'value' => 'edit',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
  }
  else {
    
    acf_add_local_field_group(array (
    	'key' => 'group_57f90d0a441e4',
    	'title' => 'Dossier-informatie',
    	'fields' => array (
    		array (
    			'key' => 'field_57f90d20c2fdf',
    			'label' => 'Overzichtpagina',
    			'name' => 'dossier_overzichtpagina',
    			'type' => 'post_object',
    			'instructions' => 'Welke pagina is de overzichtspagina die hoort bij dit dossier?',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    		array (
    			'key' => 'field_57fa70f9fe7a3',
    			'label' => 'Toon overzichtspagina in het menu?',
    			'name' => 'toon_overzichtspagina_in_het_menu',
    			'type' => 'radio',
    			'instructions' => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'choices' => array (
    				'ja' => 'Toon wel',
    				'nee' => 'Toon niet',
    			),
    			'allow_null' => 0,
    			'other_choice' => 0,
    			'save_other_choice' => 0,
    			'default_value' => 'ja',
    			'layout' => 'vertical',
    			'return_format' => 'value',
    		),
    		array (
    			'key' => 'field_57f90f281dcfb',
    			'label' => 'Andere pagina\'s in het menu',
    			'name' => 'menu_pages',
    			'type' => 'relationship',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'filters' => array (
    				0 => 'search',
    				1 => 'taxonomy',
    			),
    			'elements' => '',
    			'min' => '',
    			'max' => '',
    			'return_format' => 'object',
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => 'dossiers',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
  }


  acf_add_local_field_group(array (
  	'key' => 'group_57fa9232d034a',
  	'title' => 'Actueelpagina voor een dossier',
  	'fields' => array (
  		array (
  			'key' => 'field_57fa92400aa5c',
  			'label' => 'Wil je filteren op categorie op deze pagina?',
  			'name' => 'wil_je_filteren_op_categorie_op_deze_pagina',
  			'type' => 'radio',
  			'instructions' => 'Als je niet filtert worden alle berichten getoond die aan dit dossier gekoppeld zijn. Als je wilt filteren, kun je kiezen voor een categorie. Dan worden dus alleen die berichten getoond die:
  - zowel aan dit dossier gekoppeld zijn 
  - als aan de door jou gekozen categorie',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				'nee' => 'Nee',
  				'ja' => 'Ja',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => 'nee',
  			'layout' => 'vertical',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_57fa933133d61',
  			'label' => 'Kies de categorie waarop je wilt filteren',
  			'name' => 'kies_de_categorie_waarop_je_wilt_filteren',
  			'type' => 'taxonomy',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_57fa92400aa5c',
  						'operator' => '==',
  						'value' => 'ja',
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'taxonomy' => 'category',
  			'field_type' => 'checkbox',
  			'allow_null' => 0,
  			'add_term' => 1,
  			'save_terms' => 0,
  			'load_terms' => 0,
  			'return_format' => 'id',
  			'multiple' => 0,
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'page_template',
  				'operator' => '==',
  				'value' => 'page_dossiersingleactueel.php',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  	'local' => 'php',
  ));




  acf_add_local_field_group(array (
  	'key' => 'group_57e4e9cdb7b83',
  	'title' => 'Layout-opties voor banner-widget',
  	'fields' => array (
  		array (
  			'key' => 'field_57e4e9d8216a4',
  			'label' => 'Randkleur',
  			'name' => 'rhswp_widget_randkleur',
  			'type' => 'color_picker',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '#000000',
  		),
  		array (
  			'key' => 'field_57e4ea1a06fbd',
  			'label' => 'Achtergrondkleur',
  			'name' => 'rhswp_widget_achtergrondkleur',
  			'type' => 'color_picker',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '#ffffff',
  		),
  		array (
  			'key' => 'field_57e4ea5206fbe',
  			'label' => 'Tekstkleur',
  			'name' => 'rhswp_widget_tekstkleur',
  			'type' => 'color_picker',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '#000000',
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'widget',
  				'operator' => '==',
  				'value' => 'rhswp_banner_widget',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));


endif;

//========================================================================================================

// options page 
if( function_exists('acf_add_options_page') ):

	$args = array(
		'slug' => 'instellingen',
		'title' => __( 'Theme-instellingen', 'wp-rijkshuisstijl' ),
		'parent' => 'themes.php'
	); 
	
		acf_add_options_page($args);

endif;

//========================================================================================================

if( function_exists('register_field_group') ):

    //====================================================================================================
    // sokmetknoppen voor twitter, linkedin, het satanische facebook
    // 
    register_field_group(array (
      'key' => 'group_54e6101992f1e',
      'title' => 'Deelknoppen: aan of uit?',
      'fields' => array (
        array (
          'key' => 'field_54e610433e1d0',
          'label' => 'Social-media-dingetjes',
          'name' => 'socialmedia_icoontjes',
          'prefix' => '',
          'type' => 'radio',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            SOC_MED_YES => 'Toon socialmedia-icoontjes',
            SOC_MED_NO => 'Verberg socialmedia-icoontjes',
          ),
          'other_choice' => 0,
          'save_other_choice' => 0,
          'default_value' => SOC_MED_YES,
          'layout' => 'vertical',
        ),

      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'post',
          ),
        ),
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
          ),
        ),
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'event',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'artmustgrow',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
    ));


  
  acf_add_local_field_group(array (
  	'key' => 'group_57dbb4a2b1368',
  	'title' => 'Alternatieve paginatitel',
  	'fields' => array (
  		array (
  			'key' => 'field_57dbb4bb70f6f',
  			'label' => 'Alternatieve paginatitel gebruiken?',
  			'name' => 'alternatieve_paginatitel_gebruiken',
  			'type' => 'radio',
  			'instructions' => 'De paginatitel wordt standaard gebruikt voor ondermeer verwijzingen in menu\'s en in de &lt;title&gt;. Het kan zijn dat je voor de duidelijkheid een andere tekst wilt tonen in de &lt;h1&gt;. Als je hier \'JA\' kiest, kun je een alternatieve paginatitel invoeren.',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				'Nee' => 'nee',
  				'Ja' => 'ja',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => 'nee',
  			'layout' => 'horizontal',
  		),
  		array (
  			'key' => 'field_57dbb54b70f70',
  			'label' => 'Alternatieve paginatitel',
  			'name' => 'alternatieve_paginatitel',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_57dbb4bb70f6f',
  						'operator' => '==',
  						'value' => 'Ja',
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  			'readonly' => 0,
  			'disabled' => 0,
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'page',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));
  

endif;



//========================================================================================================



//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
    	'key' => 'group_57f50ce2004e6',
    	'title' => 'Dossieroverzicht: selecteer uitgelichte dossiers',
    	'fields' => array (
    		array (
    			'key' => 'field_57f50cf4234e6',
    			'label' => 'Uitgelichte dossiers',
    			'name' => 'uitgelichte_dossiers',
    			'type' => 'taxonomy',
    			'instructions' => 'De dossiers die je hier kiest worden bovenaan de pagina getoond met speciale layout.',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'taxonomy' => 'dossiers',
    			'field_type' => 'checkbox',
    			'allow_null' => 0,
    			'add_term' => 1,
    			'save_terms' => 0,
    			'load_terms' => 0,
    			'return_format' => 'id',
    			'multiple' => 0,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'page_template',
    				'operator' => '==',
    				'value' => 'page_showalldossiers.php',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
    
    acf_add_local_field_group(array (
    	'key' => 'group_57f5099923f1b',
    	'title' => 'Theme-instellingen',
    	'fields' => array (
    		array (
    			'key' => 'field_57f509b68989b',
    			'label' => 'Dossier-overzichtspagina',
    			'name' => 'dossier_overzichtspagina',
    			'type' => 'post_object',
    			'instructions' => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'post_type' => array (
    				0 => 'page',
    			),
    			'taxonomy' => array (
    			),
    			'allow_null' => 0,
    			'multiple' => 0,
    			'return_format' => 'object',
    			'ui' => 1,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'options_page',
    				'operator' => '==',
    				'value' => 'instellingen',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
    

    
    // advanced custom fields
    
    acf_add_local_field_group(array (
    	'key' => 'group_572227c314a62',
    	'title' => 'Extra info voor relevante link',
    	'fields' => array (
    		array (
    			'key' => 'field_572227cb69fc1',
    			'label' => 'URL voor relevante link',
    			'name' => 'url_voor_relevante_link',
    			'type' => 'url',
    			'instructions' => '',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    		),
    		array (
    			'key' => 'field_572227e269fc2',
    			'label' => 'Linktekst',
    			'name' => 'linktekst_voor_relevante_link',
    			'type' => 'text',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    			'prepend' => '',
    			'append' => '',
    			'maxlength' => '',
    			'readonly' => 0,
    			'disabled' => 0,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => RHSWP_LINK_CPT,
    			),
    		),
    	),    	'menu_order' => 0,
    	'position' => 'acf_after_title',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));


endif;

//========================================================================================================
