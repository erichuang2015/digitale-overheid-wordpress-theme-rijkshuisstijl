<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_dossiersingleactueel.php
 * ----------------------------------------------------------------------------------
 * Toont de nieuws-pagina van een dossier
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.7 
 * @desc.   Functionaliteit voor groeperen van dossiers toegevoegd. Eerste opzet RHS-styling
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: Dossiers: nieuwspagina voor een dossier 

//* Remove standard post content output
//remove_action( 'genesis_post_content', 'genesis_do_post_content' );
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingleactueel', 15 );

genesis();

function rhswp_get_page_dossiersingleactueel() {
  global $post;

    
//  $test = get_post_meta( $post->ID, RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TAG_FIELD, true );

  // Echo the metadata
//  echo "Geselecteerde tag: \"" . $test . "\" / " . RHSWP_PREFIX_TAG_CAT . RHSWP_CMB2_TAG_FIELD . ' on ID: ' .  get_the_ID() . ' / ' . $post->ID . '<br>';  
  
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );

  if ($terms && ! is_wp_error( $terms ) ) { 

    $term = array_pop($terms);
    
//    echo '<h2>' . __( 'Actueel', 'Titel op de actueelpagina bij een dossier', 'wp-rijkshuisstijl' ) . '</h2>';  
    echo '<p>Berichten in het dossier "' . $term->name .'"</p>';  

$posts_array = get_posts(
    array(
        'posts_per_page' => -1,
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => RHSWP_CT_DOSSIER,
                'field' => 'term_id',
                'terms' => $term->term_id,
            )
        )
    )
);  
echo '<ul>';
foreach ( $posts_array as $post ) : setup_postdata( $post ); 
?>
	<li>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</li>
<?php
endforeach; 
wp_reset_postdata();
  
echo '</ul>';
  
  }
  
}


