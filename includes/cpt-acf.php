<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - cpt-acf.php
 * -------------------------------------------------------------------------------------------------------
 * Definities van:
 *  - custom post type voor fiche
 *  - custom taxonomies: CTAX_thema / CTAX_contentsoort 
 *  - Advanced Custom Fields voor diverse plekken
 * -------------------------------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.7 
 * @desc.   Functionaliteit voor groeperen van dossiers toegevoegd. Eerste opzet RHS-styling
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */




//========================================================================================================

add_action( 'init', 'rhswp_register_my_taxes' );

function rhswp_register_my_taxes() {
	$labels = array(
		"name" => __( 'Dossiers', '' ),
		"singular_name" => __( 'Dossier', '' ),
		);

	$args = array(
		"label" => __( 'Dossiers', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Dossiers",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => RHSWP_CT_DOSSIER, 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( RHSWP_CT_DOSSIER, array( "post", "page", "links" ), $args );

}

if( function_exists('acf_add_local_field_group') ):

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
// Custom Post Type for 'fiches'

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name"                  => "Fiches",
		"singular_name"         => "Fiche",
		"menu_name"             => "Fiches",
		"all_items"             => "Alle fiches",
		"add_new"               => "Nieuwe toevoegen",
		"add_new_item"          => "Nieuw fiche toevoegen",
		"edit"                  => "Bewerken?",
		"edit_item"             => "Bewerk fiche",
		"new_item"              => "Nieuw fiche",
		"view"                  => "Toon",
		"view_item"             => "Bekijk fiche",
		"search_items"          => "Zoek fiche",
		"not_found"             => "Niet gevonden",
		"not_found_in_trash"    => "Geen fiches gevonden in de prullenbak",
		"parent"                => "Hoofd",
		);

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
		"rewrite"               => array( "slug" => RHS_LINK_CPT, "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "excerpt", "revisions", "thumbnail" ),				
	);
	register_post_type( RHS_LINK_CPT, $args );


// End of cptui_register_my_cpts()
}


//========================================================================================================

add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {

/*
	$labels = array(
		"name"                          => "Thema's",
		"label"                         => "Thema's",
		"menu_name"                     => "Thema's",
		"all_items"                     => "Alle thema's",
		"edit_item"                     => "Bewerk thema",
		"view_item"                     => "Bekijk thema",
		"add_new_item"                  => "Voeg nieuw thema toe",
		"parent_item"                   => "Hoofd-thema",
		"parent_item_colon"             => "Hoofd-thema:",
		"search_items"                  => "Zoek thema",
		"popular_items"                 => "Meest gebruikte thema's",
		"separate_items_with_commas"    => "Scheiden met komma's",
		"add_or_remove_items"           => "Toevoegen of verwijderen van thema's",
		"choose_from_most_used"         => "Kies uit de meest gebruikte",
		"not_found"                     => "Geen thema's gevonden",
		);

	$args = array(
		"labels"                        => $labels,
		"hierarchical"                  => true,
		"label"                         => "thema's",
		"show_ui"                       => true,
		"query_var"                     => true,
		"rewrite"                       => array( 
		                                        'slug'          => 'onderwerpen', 
		                                        'with_front'    => true, 
		                                        'hierarchical'  => true ),
		"show_admin_column"             => true,
	);
	register_taxonomy( CTAX_thema, array( "fiche" ), $args );
*/

	$labels = array(
		"name"                          => "Contentsoorten",
		"label"                         => "Contentsoorten",
		"menu_name"                     => "Contentsoorten",
		"all_items"                     => "Alle contentsoorten",
		"edit_item"                     => "Bewerk contentsoort",
		"view_item"                     => "Bekijk contentsoort",
		"update_item"                   => "Bewerk contentsoort",
		"add_new_item"                  => "Voeg nieuwe contentsoort toe",
		);

	$args = array(
		"labels"                        => $labels,
		"hierarchical"                  => true,
		"label"                         => "Contentsoorten",
		"show_ui"                       => true,
		"query_var"                     => true,
		"rewrite"                       => array( 
		                                        'slug'          => 'contentsoort', 
		                                        'with_front'    => true ),
		"show_admin_column"             => true,
	);
	register_taxonomy( CTAX_contentsoort, array( "fiche" ), $args );

	$labels = array(
		"name"                          => "Overheid",
		"label"                         => "Overheid",
		"menu_name"                     => "Overheid",
		"all_items"                     => "Alle overheden",
		"edit_item"                     => "Bewerk overheid",
		"view_item"                     => "Bekijk overheid",
		"update_item"                   => "Bewerk overheid",
		"add_new_item"                  => "Nieuwe toevoegen",
		"new_item_name"                 => "Nieuwe overheid",
		"parent_item"                   => "Hoofd-laag",
		"parent_item_colon"             => "Hoofd-laag",
		"search_items"                  => "Zoeken:",
		"popular_items"                 => "Meest gebruikte:",
		);

	$labels = array(
		"name"                          => "Eigenaren",
		"label"                         => "Eigenaren",
		);

// End cptui_register_my_taxes()
}


//========================================================================================================

if( function_exists('acf_add_local_field_group') ):
    
    // advanced custom fields

/*
    acf_add_local_field_group(array (
    	'key' => 'group_570264250d77d',
    	'title' => "Formattering van thema's",
    	'fields' => array (
    		array (
    			'key' => 'field_57026432c2649',
    			'label' => 'Kleur',
    			'name' => 'thema_kleur',
    			'type' => 'radio',
    			'instructions' => 'Welke achtergrondkleur moet dit thema krijgen op de homepage?',
    			'required' => 1,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'choices' => array (
    				'oranje' => 'oranje',
    				'rood' => 'rood',
    			),
    			'other_choice' => 0,
    			'save_other_choice' => 0,
    			'default_value' => 'oranje',
    			'layout' => 'vertical',
    		),
    		array (
    			'key' => 'field_57026476c264a',
    			'label' => 'Titel met opmaak',
    			'name' => 'thema_titel_met_opmaak',
    			'type' => 'textarea',
    			'instructions' => 'Zet woorden die je <strong>vet</strong> wilt hebben tussen &lt;strong&gt; tags. <br />Voorbeeld: <br />
    Help &lt;strong&gt;Een incident!&lt;/strong&gt;<br />
    
    Je kunt &lt;br /&gt; voor regelafbreking gebruiken, maar dit zal een onvoorspelbare opmaak opleveren op diverse schermbreedtes.',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'default_value' => '',
    			'placeholder' => '',
    			'maxlength' => 200,
    			'rows' => '',
    			'new_lines' => '',
    			'readonly' => 0,
    			'disabled' => 0,
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'taxonomy',
    				'operator' => '==',
    				'value' => CTAX_thema,
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
*/
    
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
    				'value' => RHS_LINK_CPT,
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
