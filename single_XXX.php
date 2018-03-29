<?php

// Rijkshuisstijl (Digitale Overheid) - single.php
// ----------------------------------------------------------------------------------
// Toont een bericht
// ----------------------------------------------------------------------------------
// 
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 0.11.7
// * @desc.   Extra opties voor contactformulier voor reacties.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl


//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 14 );

add_action( 'genesis_entry_content', 'rhswp_contactreactie_write_form', 11 );

//========================================================================================================

genesis();

//========================================================================================================

