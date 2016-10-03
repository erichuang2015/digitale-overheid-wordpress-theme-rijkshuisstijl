<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_sitemap.php
 * ----------------------------------------------------------------------------------
 * Toont de sitemap. Deze sitemap komt bijna overeen met de sitemap die
 * getoond wordt op de 404-pagina
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.4 
 * @desc.   Widgets toegevoegd, widgetruimtes opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */

/*
Template Name: Input Submition Page
*/

get_header(); ?>
	<div class="form-signin">
		<h2>Input Title</h2>

		<div class="control-group">
			<input type="text" required="required" name="title" class="input-block-level" placeholder="Input Title">
			<button class="btn btn-large" id="next">Next</button>
		</div>
	</div>

<?php get_footer();