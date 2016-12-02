<?php

/**
 * Rijkshuisstijl (Digitale Overheid) - page_dossier-events-overview.php
 * ----------------------------------------------------------------------------------
 * Toont de events voor dit dossier
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.7.21
 * @desc.   Modernizr via CDN, paginalayouts gewijzigd, CSS bugs
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 02 - (dossiers) events voor een dossier 

add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

// Remove the standard pagination, so we don't get two sets
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

if ( rhswp_extra_contentblokken_checker() ) {
  add_action( 'genesis_entry_footer', 'rhswp_write_extra_contentblokken');
}


genesis();

function rhswp_get_documents_for_dossier() {
  global $post;

  $currentpage      = get_permalink();
  $currentsite      = get_site_url();
  $paged            = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );

  if ($terms && ! is_wp_error( $terms ) ) { 
    
    $term = array_pop($terms);
    
    $args = array(
      'paged'           => $paged,
      'posts_per_page'  => get_option('posts_per_page'),
      'post_type'       => RHSWP_CPT_EVENT,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => RHSWP_CT_DOSSIER,
          'field' => 'term_id',
          'terms' => $term->term_id
        )
      )
    );

    $message = sprintf( __( 'evenementen in het dossier %s', 'wp-rijkshuisstijl' ), $term->name );
        
    
    $posts_array = get_posts( $args ); 
      if ( $posts_array ) {
        echo '<p>Events in het dossier "' . $term->name .'"</p>';  
    
    
        foreach ( $posts_array as $post ) : setup_postdata( $post ); 

          if ( $currentsite && $currentpage ) {
            
            $postpermalink  = get_the_permalink();
            $postpermalink  = str_replace( $currentsite, '', $postpermalink);
            $postpermalink  = '/' . $post->post_name;

            $crumb          = str_replace( $currentsite, '', $currentpage);
            
            $theurl         = $currentsite . $crumb  . RHSWP_DOSSIEREVENTCONTEXT . $postpermalink;
          
          }
          else {
            $theurl         = get_the_permalink();
          }
      		


        
        ?>
          <article>
            <h2><a href="<?php echo $theurl; ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt() ?>
          </article>
        <?php
        endforeach; 
        
        wp_reset_postdata();

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


