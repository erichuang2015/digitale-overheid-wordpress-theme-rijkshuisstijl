<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_dossier-document-overview.php
 * ----------------------------------------------------------------------------------
 * Toont de nieuws-pagina van een dossier
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.12
 * @desc.   Dossieroverzicht herzien, documentdownload toegevoegd, read-more gewijzigd, breadcrumb gewijzigd 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: Dossiers: documenten voor een dossier 

add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

genesis();

function rhswp_get_documents_for_dossier() {
  global $post;

  
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );

  if ($terms && ! is_wp_error( $terms ) ) { 
    
    $term = array_pop($terms);
    
    $args = array(
      array(
        'posts_per_page'  => -1,
        'post_type' => RHSWP_CPT_DOCUMENT,
        'tax_query' => array(
          array(
            'taxonomy' => RHSWP_CT_DOSSIER,
            'field' => 'term_id',
            'terms' => $term->term_id,
          )
        )
      )
    );

$args = array(
        'posts_per_page'  => -1,
        'post_type' => RHSWP_CPT_DOCUMENT,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => RHSWP_CT_DOSSIER,
                'field' => 'term_id',
                'terms' => $term->term_id
            )
        )
    );
        

    
    $posts_array = get_posts( $args ); 
      if ( $posts_array ) {
        echo '<p>Documenten in het dossier "' . $term->name .'"</p>';  
    
    
        foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
          <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt() ?>
          </article>
        <?php
        endforeach; 
        
        wp_reset_postdata();
        
        
      }
      else {
        echo _x( "Geen documenten gevonden onder '" . $term->name . "'", 'Op actueelpagina voor een dossier', 'wp-rijkshuisstijl' );
      }
    }
}


