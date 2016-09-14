<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - search.php
 * ----------------------------------------------------------------------------------
 * Zoekresultaatpagina
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.0 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


add_action( 'genesis_before_loop', 'start_flex', 16 );
add_action( 'genesis_after_loop', 'end_flex', 16 );

function start_flex() {
  echo '<div class="flex">';
}

function end_flex() {
  echo '</div>';
}

genesis();
    