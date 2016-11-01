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
 * @version 0.6.31
 * @desc.   New custom post type for dossiers
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


  //========================================================================================================
  acf_add_local_field_group(array (
  	'key' => 'group_58175e7d500bd',
  	'title' => 'Items in het menu (dossierx)',
  	'fields' => array (
  		array (
  			'key' => 'field_5817763865d43',
  			'label'   => __( 'Detailpagina', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_5817759dcdbe3',
  			'label'   => __( "Toon tab voor 'detailpagina'", 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_overzicht',
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
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_NEE_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_58177601b97ae',
  			'label'   => __( 'Label voor \'Inhoud\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_overzicht_label',
  			'type' => 'text',
  			'instructions' => 'Standaard is dit \'Inhoud\'. Je kunt dit label hier wijzigen.',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_5817759dcdbe3',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Inhoud',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => 20,
  		),
  		array (
  			'key' => 'field_581775e5b97ad',
  			'label'   => __( 'Pagina bij \'overzicht\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_overzicht_pagina',
  			'type' => 'relationship',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_5817759dcdbe3',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
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
  			),
  			'elements' => '',
  			'min' => 1,
  			'max' => 1,
  			'return_format' => 'object',
  		),
  		array (
  			'key' => 'field_58177a0ccc955',
  			'label'   => __( 'Actueel', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_581772bec2184',
  			'label'   => __( 'Toon tab voor \'actueel\'?', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_actueel',
  			'type' => 'radio',
  			'instructions' => 'Wil je dat er een tab getoond wordt met alle nieuwsberichten die aan dit dossier gekoppeld zijn?',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_JA_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_5817737cb25a7',
  			'label'   => __( 'Label voor \'actueel\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_actueel_label',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_581772bec2184',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Actueel',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array (
  			'key' => 'field_581774db71342',
  			'label'   => __( 'Categorie voor actueel', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_actueel_category',
  			'type' => 'taxonomy',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_581772bec2184',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
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
  		array (
  			'key' => 'field_58177b14c7219',
  			'label'   => __( 'Achtergrond', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_58177c13e596d',
  			'label'   => __( 'Toon tab voor \'achtergrondartikelen\'?', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_achtergrondartikelen',
  			'type' => 'radio',
  			'instructions' => 'Wil je dat er een tab getoond wordt met alle nieuwsberichten die aan dit dossier gekoppeld zijn?',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_NEE_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_58177f580a315',
  			'label'   => __( 'Label voor \'achtergrondartikelen\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_achtergrondartikelen_label',
  			'type' => 'text',
  			'instructions' => 'Standaard is dit \'Achtergrondartikelen\'. Dit label kun je hier wijzigen.',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c13e596d',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Achtergrondartikelen',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array (
  			'key' => 'field_58177f5d0a316',
  			'label'   => __( 'Categorie voor achtergrondartikelen', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_achtergrondartikelen_category',
  			'type' => 'taxonomy',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c13e596d',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
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
  		array (
  			'key' => 'field_58177ba843e7f',
  			'label'   => __( 'Documenten', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_58177c37e596e',
  			'label'   => __( 'Toon tab voor \'documenten\'?', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_documenten',
  			'type' => 'radio',
  			'instructions' => 'Wil je dat er een tab getoond wordt met alle documenten die aan dit dossier gekoppeld zijn?',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_NEE_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_581780a8ff03a',
  			'label'   => __( 'Label voor \'documenten\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_documenten_label',
  			'type' => 'text',
  			'instructions' => 'Standaard is dit \'Documenten\'. Je kunt dit label hier wijzigen.',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c37e596e',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Documenten',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => 20,
  		),
  		array (
  			'key' => 'field_58177bb843e80',
  			'label'   => __( 'Evenementen', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_58177c71e5970',
  			'label'   => __( 'Toon tab voor \'evenementen\'?', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_evenementen',
  			'type' => 'radio',
  			'instructions' => 'Wil je dat er een tab getoond wordt met alle evenementen die aan dit dossier gekoppeld zijn?',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_NEE_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_58177dc59541a',
  			'label'   => __( 'Label voor \'evenementen\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_evenementen_label',
  			'type' => 'text',
  			'instructions' => 'Standaard is dit \'Evenementen\'. Je kunt dit label hier wijzigen.',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c71e5970',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Evenementen',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => 20,
  		),
  		array (
  			'key' => 'field_58177bc743e81',
  			'label'   => __( 'Vraag en antwoord', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_58177c54e596f',
  			'label'   => __( 'Toon tab voor \'vraag en antwoord\'?', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_vraagenantwoord',
  			'type' => 'radio',
  			'instructions' => 'Wil je dat er een tab getoond wordt met link naar de overzichtspagina van alle vraag-en-antwoord-pagina\'s bij dit dossier?',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_NEE_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_58177e5d946e3',
  			'label'   => __( 'Label voor vraag-en-antwoord', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_vraagenantwoord_label',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c54e596f',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Vraag en antwoord',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array (
  			'key' => 'field_58178109ff03b',
  			'label'   => __( 'Pagina bij vraag-en-antwoord', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_vraagenantwoord_pagina',
  			'type' => 'relationship',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c54e596f',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
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
  			),
  			'elements' => '',
  			'min' => 1,
  			'max' => 1,
  			'return_format' => 'object',
  		),
  		array (
  			'key' => 'field_58177bd643e82',
  			'label'   => __( 'Planning', 'wp-rijkshuisstijl' ),
  			'name' => '',
  			'type' => 'tab',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'placement' => 'top',
  			'endpoint' => 0,
  		),
  		array (
  			'key' => 'field_58177c96daafe',
  			'label'   => __( 'Toon tab voor \'planning\'?', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_planning',
  			'type' => 'radio',
  			'instructions' => 'Wil je dat er een tab getoond wordt met link naar de planningspagina die hoort bij dit dossier?',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				BOOL_JA_VAL => BOOL_JA_LABEL,
  				BOOL_NEE_VAL => BOOL_NEE_LABEL,
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => BOOL_NEE_VAL,
  			'layout' => 'horizontal',
  			'return_format' => 'value',
  		),
  		array (
  			'key' => 'field_5817818105fcf',
  			'label'   => __( 'Label voor planning', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_planning_label',
  			'type' => 'text',
  			'instructions' => 'Standaard is dit \'Planning\'. Je kunt dit label hier wijzigen.',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c96daafe',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => 'Planning',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  		),
  		array (
  			'key' => 'field_58177dc395419',
  			'label'   => __( 'Pagina bij \'Planning\'', 'wp-rijkshuisstijl' ),
  			'name' => 'dossierx_toon_planning_pagina',
  			'type' => 'relationship',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_58177c96daafe',
  						'operator' => '==',
  						'value' => BOOL_JA_VAL,
  					),
  				),
  			),
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
  			),
  			'elements' => '',
  			'min' => 1,
  			'max' => 1,
  			'return_format' => 'object',
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => RHSWP_CPT_DOSSIER,
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'field',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => 'Omschrijving toon in groeplijst',
  ));
  

  //========================================================================================================
add_action( 'init', 'cptui_register_my_cpts_dossierx' );

function cptui_register_my_cpts_dossierx() {

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
		"label"                 => __( 'Dossiers', 'wp-rijkshuisstijl' ),
		"labels"                => $labels,
		"description"           => "",
		"public"                => true,
		"publicly_queryable"    => true,
		"show_ui"               => true,
		"show_in_rest"          => false,
		"rest_base"             => "",
		"has_archive"           => true,
		"show_in_menu"          => true,
		"exclude_from_search"   => false,
		"capability_type"       => "post",
		"map_meta_cap"          => true,
		"hierarchical"          => false,
		"rewrite"               => array( "slug" => RHSWP_CPT_DOSSIER, "with_front" => true ),
		"query_var"             => true,
		"supports"              => array( "title", "editor", "thumbnail", "excerpt", RHSWP_CPT_DOSSIER ),					
  );
		
	register_post_type( RHSWP_CPT_DOSSIER, $args );

// End of cptui_register_my_cpts_dossierx()
}
  

