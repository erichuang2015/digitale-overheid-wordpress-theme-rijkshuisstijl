<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_dossiersingleactueel.php
 * ----------------------------------------------------------------------------------
 * Toont de berichtten van een dossier
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.13
 * @desc.   Pagina-templates herzien 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 01 - (dossiers) berichtenpagina (evt. met filter)

add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingleactueel', 15 );

genesis();

function rhswp_get_page_dossiersingleactueel() {
  global $post;
  
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );

  if ( function_exists( 'get_field' ) ) {
      $filter    = get_field('wil_je_filteren_op_categorie_op_deze_pagina', $post->ID );
      $filters   = get_field('kies_de_categorie_waarop_je_wilt_filteren', $post->ID );
  }

  // gewoon filter, zonder dossier
  $args = array(
    'posts_per_page'  => -1,
    'post_type' => 'post',
  );

  $message          = 'Alle berichten';
  $currentterm      = '';
  $currenttermname  = '';

  
  if ($terms && ! is_wp_error( $terms ) ) { 
  
    $term             = array_pop($terms);
    $currentterm      = $term->term_id;
    $currenttermname  = $term->name;

    if ( $currentterm ) {
      // filter op dossier
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
    }
    
  }


    if ( $filter !== 'ja' ) {
    }
    else {
      
      if ( $filters ) {
    
        $slugs = array();
        if ( $currenttermname ) {
          $message = 'Berichten in het dossier "' . $currenttermname .'"';
        }
        
        foreach( $filters as $filter ): 
          
          $terminfo = get_term_by( 'id', $filter, 'category' );
          $message .= ' en categorie "' . $terminfo->name . '"';

          $slugs[] = $terminfo->slug;
    
        endforeach;

        if ( $currentterm ) {
        
          $args = array(
              'posts_per_page'  => -1,
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
        else {
          $args = array(
              'posts_per_page'  => -1,
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy'  => 'category',
                        'field'     => 'slug',
                        'terms'     => $slugs,
                    )
                )
            );
        }
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


