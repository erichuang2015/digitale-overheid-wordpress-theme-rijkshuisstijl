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
 * @version 0.7.13
 * @desc.   Contentblok-checker op diverse pagina's
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 01 - (dossiers) berichtenpagina (evt. met filter)


add_action( 'genesis_entry_content', 'rhswp_get_page_dossiersingleactueel', 15 );

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_footer', 'rhswp_write_extra_contentblokken');
}


genesis();


function rhswp_get_page_dossiersingleactueel() {

    global $post;
    global $wp_query;
    
    $terms            = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );
    $currentpageid    = $post->ID;
    $currentpageslug  = $post->post_name;
    $currentpage      = get_permalink();
    $currentsite      = get_site_url();
    $paged            = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  
    if ( function_exists( 'get_field' ) ) {
        $filter    = get_field('wil_je_filteren_op_categorie_op_deze_pagina', $post->ID );
        $filters   = get_field('kies_de_categorie_waarop_je_wilt_filteren', $post->ID );
    }
  
    // gewoon filter, zonder dossier
    $args = array(
      'post_type'       => 'post',
      'paged'           => $paged,
      'posts_per_page'  => get_option('posts_per_page'),
    );
  
    $message          = 'Alle berichten';
    $currentterm      = '';
    $currenttermname  = '';
    $currenttermslug  = '';
  
    
    if ($terms && ! is_wp_error( $terms ) ) { 
    
      $term             = array_pop($terms);
      $currentterm      = $term->term_id;
      $currenttermname  = $term->name;
      $currenttermslug  = $term->slug; 
  
      if ( $currentterm ) {
        // filter op dossier
        $args = array(
          'post_type'       => 'post',
          'paged'           => $paged,
          'posts_per_page'  => get_option('posts_per_page'),
          'tax_query'       => array(
            'relation' => 'AND',
            array(
              'taxonomy' => RHSWP_CT_DOSSIER,
              'field' => 'term_id',
              'terms' => $currentterm
            )
          )
        );
      
        $message = sprintf( __( 'berichten in het dossier %s', 'wp-rijkshuisstijl' ), $currenttermname );
      }
      
    }
  
  
      if ( $filter !== 'ja' ) {
      }
      else {
        
        if ( $filters ) {
      
          $slugs = array();
          
          foreach( $filters as $filter ): 
            
            $terminfo = get_term_by( 'id', $filter, 'category' );
            $message .= ' gecombineerd met de categorie "' . $terminfo->name . '"';
  
            $slugs[] = $terminfo->slug;
      
          endforeach;
  
          if ( $currentterm ) {
          
            $args = array(
                'post_type'       => 'post',
                'paged'           => $paged,
                'posts_per_page'  => get_option('posts_per_page'),
                'tax_query'       => array(
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
              'post_type'       => 'post',
              'paged'           => $paged,
              'posts_per_page'  => get_option('posts_per_page'),
              'tax_query'       => array(
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
    
    $wp_query = new WP_Query( $args );
    
    if( $wp_query->have_posts() ) {
  
      	while ( $wp_query->have_posts() ) {
      		$wp_query->the_post();

          if ( $currentsite && $currentpage ) {
            
            $postpermalink  = get_the_permalink();
            $postpermalink  = str_replace( $currentsite, '', $postpermalink);
            $postpermalink  = '/' . $post->post_name;

            $crumb          = str_replace( $currentsite, '', $currentpage);
            
            $theurl         = $currentsite . $crumb  . RHSWP_DOSSIERPOSTCONTEXT . $postpermalink;
          
          }
          else {
            $theurl         = get_the_permalink();
          }
      		
          ?>
  
          <section>
            <h2><a href="<?php echo $theurl ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt() ?>
          </section>

        <?php
        }      

        genesis_posts_nav();

        wp_reset_query();        

        
        
      }
      else {
        echo '<p>';
        echo sprintf( _x( 'We zochten naar %s, maar konden helaas niets vinden.', 'foutboodschap als er geen content gevonden is', 'wp-rijkshuisstijl' ), $message );
        echo '</p>';
      }
}


