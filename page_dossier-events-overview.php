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
 * @version 0.6.28
 * @desc.   Check in dossier if menu item is parent of child page. Error message if no content found in page templates with filter function.
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//* Template Name: 02 - (dossiers) events voor een dossier 

add_action( 'genesis_entry_content', 'rhswp_get_documents_for_dossier', 15 );

genesis();

function rhswp_get_documents_for_dossier() {
  global $post;

  
  $terms = get_the_terms( $post->ID , RHSWP_CT_DOSSIER );

  if ($terms && ! is_wp_error( $terms ) ) { 
    
    $term = array_pop($terms);
    
    $args = array(
      'posts_per_page'  => -1,
      'post_type' => RHSWP_CPT_EVENT,
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
        echo '<p>';
        echo sprintf( _x( 'We zochten naar %s, maar konden helaas niets vinden.', 'foutboodschap als er geen content gevonden is', 'wp-rijkshuisstijl' ), $message );
        echo '</p>';
      }
    }
}


