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
 * @version 0.8.1
 * @desc.   Sitemap uitgebreid (filtersitemap=nee), 'article-visual' als nieuw beeldformaat toegevoegd. CSS wijzigingen voor list-items. Revisie van dossier-menu. 
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//* Template Name: 03 - (dossiers) documenten voor een dossier 

//========================================================================================================

add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_content', 'rhswp_write_extra_contentblokken', 16 );
}

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//========================================================================================================

genesis();

//========================================================================================================

function rhswp_get_documents_for_dossier() {
  
  global $post;
  global $wp_query;

  $message          = 'Alle documenten';
  $terms            = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );
  $currentpage      = get_permalink();
  $currentsite      = get_site_url();
  $paged            = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  if ($terms && ! is_wp_error( $terms ) ) { 

    
    $term = array_pop($terms);


    $message = sprintf( __( 'documenten in het dossier %s', 'wp-rijkshuisstijl' ), $term->name );
    
    $args = array(
      'post_type'       => RHSWP_CPT_DOCUMENT,
      'paged'           => $paged,
      'posts_per_page'  => get_option('posts_per_page'),
      'tax_query'       => array(
        'relation'      => 'AND',
        array(
          'taxonomy'    => RHSWP_CT_DOSSIER,
          'field'       => 'term_id',
          'terms'       => $term->term_id
        )
      )
    );

        
    $wp_query = new WP_Query( $args );
    
    if( $wp_query->have_posts() ) {

          while( $wp_query->have_posts() ): 
            $wp_query->the_post(); 
            global $post;
  
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
  
          <section>
            <h2><a href="<?php echo $theurl ?>"><?php the_title(); ?></a></h2>
            <?php 
              the_excerpt();
              
                if ( WP_DEBUG && SHOW_CSS_DEBUG ) {
                  dodebug('Check category & dossier:');
                  the_category( ', ' ); 
                  dodebug(get_the_term_list( $post->ID, RHSWP_CT_DOSSIER, 'Dossiers: ', ', ' ) );  
                }
            ?>            
          </section>

        <?php

    		endwhile;
    		
        genesis_posts_nav();

        wp_reset_query();        
        
        
      }
      else {
        echo '<p>';
        echo sprintf( _x( 'We zochten naar %s, maar konden niets vinden.', 'foutboodschap als er geen content gevonden is', 'wp-rijkshuisstijl' ), $message );
        echo '</p>';
      }
    }
}
