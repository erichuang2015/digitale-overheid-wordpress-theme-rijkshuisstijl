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
 * @version 0.1.12
 * @desc.   Dossieroverzicht herzien, documentdownload toegevoegd, read-more gewijzigd, breadcrumb gewijzigd 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: Dossiers: berichtenpagina (evt. met filter)

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingleactueel', 15 );

genesis();

function rhswp_get_page_dossiersingleactueel() {
  global $post;
  
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );
  
  if ($terms && ! is_wp_error( $terms ) ) { 
    
    
    $term = array_pop($terms);
    $currentterm = $term->term_id;

    if ( function_exists( 'get_field' ) ) {
        $filter    = get_field('wil_je_filteren_op_categorie_op_deze_pagina', $post->ID );
        $filters   = get_field('kies_de_categorie_waarop_je_wilt_filteren', $post->ID );
    }


$args = array(
        'post_type' => 'post',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => RHSWP_CT_DOSSIER,
                'field' => 'term_id',
                'terms' => $currentterm
            )
        )
    );
        


    $message = 'Berichten in het dossier "' . $term->name .'"';


    if ( $filter !== 'ja' ) {
    }
    else {
      if ( $filters ) {
    
        $slugs = array();
        
        foreach( $filters as $filter ): 
          
          $terminfo = get_term_by( 'id', $filter, 'category' );
          $message .= ' en categorie "' . $terminfo->name . '"';

          $slugs[] = $terminfo->slug;
    
        endforeach;



$args = array(
        'post_type' => 'post',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => RHSWP_CT_DOSSIER,
                'field' => 'term_id',
                'terms' => $currentterm
            ),
            array(
                'taxonomy'  => 'category',
                'field'     => 'slug',
                'terms'     => $slugs,
            )
        )
    );
        

      }
    }


    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) {
      echo '<p>' . $message . '.</p>';  

    	while ( $the_query->have_posts() ) {
    		$the_query->the_post();
        ?>

        <article>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php the_excerpt() ?>
          <?php the_category( ', ' ) ?>
          <?php echo get_the_term_list( $post->ID, RHSWP_CT_DOSSIER, 'Dossiers: ', ', ' )  ?>
        </article>
      <?php
      }      
      wp_reset_postdata();
      
      
    }
    else {
      echo _x( "Geen berichten gevonden onder '" . $term->name . "'", 'Op actueelpagina voor een dossier', 'wp-rijkshuisstijl' );
    }
  }
}


