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
 * @version 0.3.2
 * @desc.   Dossier check revised - bugfixes 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 03 - (dossiers) documenten voor een dossier 

add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

genesis();

function rhswp_get_documents_for_dossier() {
  global $post;

  
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );
  $currentpage      = get_permalink();
  $currentsite      = get_site_url();

  if ($terms && ! is_wp_error( $terms ) ) { 
    
    $term = array_pop($terms);
    
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
    
    
        foreach ( $posts_array as $post ) : setup_postdata( $post ); 

          if ( $currentsite && $currentpage ) {
            
            $postpermalink  = get_the_permalink();
            $postpermalink  = str_replace( $currentsite, '', $postpermalink);
            $postpermalink  = '/' . $post->post_name;

            $crumb          = str_replace( $currentsite, '', $currentpage);
            
            $theurl         = $currentsite . $crumb  . RHSWP_DOSSIERDOCUMENTCONTEXT . $postpermalink;

          }
          else {
            $theurl         = get_the_permalink();
          }
      		
        
          ?>
  
          <article>
            <h2><a href="<?php echo $theurl ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt() ?>
            <?php the_category( ', ' ) ?>
            <?php echo get_the_term_list( $post->ID, RHSWP_CT_DOSSIER, 'Dossiers: ', ', ' )  ?>
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


