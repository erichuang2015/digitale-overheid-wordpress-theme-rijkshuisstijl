<?php

/**
 * wp-rijkshuisstijl - 404 pagina
 * ----------------------------------------------------------------------------------
 * voor als je niet weet waar je bent. Als je jezelf zoekt, of als je
 * gewoon in z'n algemeenheid de site probeert stuk te maken.
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.0 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_loop', 'genesis_404' );

add_action( 'genesis_loop', 'rhswp_404' );

genesis();

