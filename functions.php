<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - functions.php
 * ----------------------------------------------------------------------------------
 * Zonder functions geen functionaliteit, he?
 * ----------------------------------------------------------------------------------
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.1 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */



//========================================================================================================
    
    
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );


//========================================================================================================
// constanten
//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Rijkshuisstijl (Digitale Overheid)' );
define( 'CHILD_THEME_URL', 'http://wbvb.nl/themes/wp-rijkshuisstijl' );
define( 'CHILD_THEME_VERSION', "0.1.1" );
define( 'CHILD_THEME_VERSION_DESCRIPTION', "Eerste opzet theme, code licht opgeschoond" );

define( 'WP_REVENGE', true );


$siteURL =  get_stylesheet_directory_uri();
$siteURL =  preg_replace('|https://|i', '//', $siteURL );
$siteURL =  preg_replace('|http://|i', '//', $siteURL );

define( 'RHSWP__THEMEFOLDER', $siteURL );

$sharedfolder = get_stylesheet_directory();
$sharedfolder = preg_replace('|genesis|i','wp-rijkshuisstijl',$sharedfolder);


define( 'RHS_FOLDER', $sharedfolder );
define( 'RHS_LINK_CPT', 'links' );
define( 'CTAX_contentsoort', 'contentsoort' );
define( 'CTAX_thema', 'onderwerpen' );

define( 'RHSWP_HOME_WIDGET_AREA', 'home-widget-area' );


//========================================================================================================

// Include for javascript check
include_once( $sharedfolder . '/includes/nojs.php' );

// Include for CMB2 extra fields
include_once( $sharedfolder . '/includes/example-cmb2.php' );



// does our beloved visitor allow for JavaScript?
$genesis_js_no_js = new Genesis_Js_No_Js;
$genesis_js_no_js->run();

//========================================================================================================

//* Display author box on single posts
add_filter( 'get_the_author_genesis_author_box_single', '__return_false' );

//* Add the author box on archive pages
add_filter( 'get_the_author_genesis_author_box_archive', '__return_false' );

//========================================================================================================

// Include for ACF custom fields and custom post types
include_once( $sharedfolder . '/includes/cpt-acf.php' );

//========================================================================================================

//* voor de widgets
require_once( RHS_FOLDER . '/includes/widget-home.php' );

//========================================================================================================

add_theme_support( 'post-thumbnails' );

//========================================================================================================


//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

// Geen footer
remove_action( 'genesis_footer', 'genesis_do_footer' );


//========================================================================================================

// prepare for translation
load_child_theme_textdomain('wp-rijkshuisstijl', RHS_FOLDER . '/languages' );

//========================================================================================================

// Remove .wrap from menu-primary or other element by omitting them from the array below
// add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-secondary', 'footer-widgets', 'footer' ) );

//========================================================================================================

//* Do NOT include the opening php tag shown above. Copy the code shown below.

add_filter( 'wp_nav_menu_items', 'rhswp_append_search_box_to_menu', 10, 2 );
/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string   $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */
function rhswp_append_search_box_to_menu( $menu, $args ) {

	//* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
	if ( 'primary' !== $args->theme_location )
		return $menu;

	//* Uncomment this block to add a search form to the navigation menu

	ob_start();
	get_search_form();
	$search = ob_get_clean();
	$menu  .= '<li class="right search">' . $search . '</li>';

	return $menu;

}

//========================================================================================================

// breadcrumb
//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );


//* Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'rhswp_breadcrumb_args' );
function rhswp_breadcrumb_args( $args ) {

    global $wp_query;

    $separator = __( '<span class="separator">&gt;</span>', 'wp-rijkshuisstijl' );
    
    $args['home']                       = __( "Home", 'wp-rijkshuisstijl' );
    $args['sep']                        = $separator;
    $args['list_sep']                   = ', '; // Genesis 1.5 and later
    $args['prefix']                     = '<div class="breadcrumb"><div class="wrap"><nav class="breadlist">';
    $args['suffix']                     = '</nav></div></div>';
    $args['heirarchial_attachments']    = true; // Genesis 1.5 and later
    $args['heirarchial_categories']     = true; // Genesis 1.5 and later
    $args['display']                    = true;
    $args['labels']['prefix']           = ''; // __( "", 'wp-rijkshuisstijl' );
    $args['labels']['author']           = __( "Auteurs", 'wp-rijkshuisstijl' ) . $separator;
    $args['labels']['category']         = ''; // __( "", 'wp-rijkshuisstijl' );
    $args['labels']['tag']              = __( "Label", 'wp-rijkshuisstijl' );
    $args['labels']['date']             = __( "Datum-archief", 'wp-rijkshuisstijl' );
    $args['labels']['search']           = __( "Zoekresultaat", 'wp-rijkshuisstijl' );
    $args['labels']['tax']              = ''; // __( "", 'wp-rijkshuisstijl' );

    if ( isset( $wp_query->query_vars['taxonomy'] ) ) {
        
        $tax = $wp_query->query_vars['taxonomy'];
        
        if ( $tax == CTAX_contentsoort ) {
            $args['labels']['tax'] = '<a href="/' . CTAX_contentsoort . '/">' . __( 'Contentsoort', 'wp-rijkshuisstijl' ) . '</a>' . $separator;
        }
        elseif ( $tax == CTAX_thema ) {
            $tax = '';
            $args['labels']['tax'] = '<a href="/' . CTAX_thema . '/">' . __( 'Onderwerpen', 'wp-rijkshuisstijl' ) . '</a>' . $separator;
        }
        else {
            $args['labels']['tax'] = '<a href="/' . $tax . '/">' . $tax . '</a>' . $args['sep'] . $selector;
        }
    }
    
    
    $args['labels']['post_type']        = ''; // __( "", 'wp-rijkshuisstijl' );
    $args['labels']['404']              = __( "404 - Pagina niet gevonden", 'wp-rijkshuisstijl' );

    return $args;
    
}
//========================================================================================================

function admin_append_editor_styles() {
    add_editor_style(RHSWP__THEMEFOLDER . '/editor-styles.css');
}
add_action( 'init', 'admin_append_editor_styles' );

//========================================================================================================

// js filter functie
function add_defer_to_javascripts( $url )
{
    if ( // comment the following line out add 'defer' to all scripts
//    FALSE === strpos( $url, 'contact-form-7' ) or
    FALSE === strpos( $url, '.js' )
    )
    { // not our file
        return $url;
    }
    // Must be a ', not "!
    return "$url' defer='defer";
}
//add_filter( 'clean_url', 'add_defer_to_javascripts', 11, 1 );

//========================================================================================================

function rhswp_add_taxonomy_description() {

    global $wp_query;

    if ( ! is_category() && ! is_tag() && ! is_tax() )
        return;

//    if ( get_query_var( 'paged' ) >= 2 )
//        return;

    $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

    if ( ! $term || ! isset( $term->meta ) )
        return;

    $headline   = '';
    $intro_text = '';

    if ( $term->name )
        $headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->name ) );
        
    if ( $term->meta['headline'] )
        $headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->meta['headline'] ) );
        
    if ( $term->meta['intro_text'] )
        $intro_text = apply_filters( 'genesis_term_intro_text_output', $term->meta['intro_text'] );

    if ( $term->description ) {
        $intro_text = apply_filters( 'genesis_term_intro_text_output', $term->description );
    }

    if ( $headline || $intro_text ) {
        printf( '<div class="taxonomy-description">%s</div>', $headline . $intro_text );
    }
    else {
        echo '';
    }

}

//========================================================================================================

// Add custom site description

add_filter('genesis_seo_description', 'custom_site_description', 10, 3);

function custom_site_description( $description, $inside, $wrap ) {

    $inside = str_replace(". ", "</span><span>", $inside);
    $description = sprintf('<div class="site-description" itemprop="description"><span>%s</span></div>', $inside );

    return $description;

}


//========================================================================================================

function dovardump($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}        

//========================================================================================================

//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'rhswp_correct_postinfo' ); 

function rhswp_correct_postinfo($post_info) {
    global $wp_query;
    global $post;


    if ( 
        ( 'page'    == get_post_type() ) ||
        ( 'post'    == get_post_type() ) ) {
        
        if ( function_exists( 'get_field' ) ) {
            $deelknoppen_boven    = get_field('deelknoppen_boven', $post->ID );
            $deelknoppen_onder    = get_field('deelknoppen_onder', $post->ID );
        }

        if ( has_post_format( 'link' ) ) {
            echo '<p>dit is een link</p>';
            return '';
        }
        else {
            return '[post_date]';
        }
    }

    return '';
    
}

//========================================================================================================

//* Customize the entry meta in the entry footer (requires HTML5 theme support)
add_filter( 'genesis_post_meta', 'rhswp_single_post_meta_data' );

function rhswp_single_post_meta_data($post_meta) {
  
  global $post;

  if ( is_single() ) {
    if ( 'post'    == get_post_type() ) {
  
      $post_meta = '[post_categories] [post_tags]';
  
    }
  }
    
  

  return $post_meta;
  
}

//========================================================================================================

// action for writing extra info in the alt-sidebar
add_action( 'wbvb_sidebar_alt_title', 'rhswp_sidebar_context_widgets' );

function rhswp_sidebar_context_widgets() {

    global $post;
    global $wp_query;
    
    if ( is_home() || is_front_page() ) {


    }
    elseif ( is_tax( CTAX_thema ) ) {

        $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
    
        $args = array(
            'child_of'        => $term->term_id,
            'hide_empty'    => 1
        );
    
        $terms = get_terms( CTAX_thema, $args );
    
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    
            echo '<section class="thema-blocks">';
            echo '<h2>' . _x( "Subthema's", 'Titel in de zijbalk', 'wp-rijkshuisstijl' ) . '</h2>';
    
            echo '<div class="flex">';
    
            foreach($terms as $term) {
              // nog even helemaal niks
        
            }
            
            echo '</div>';
            echo '</section>';
        
        }

        
    }
    elseif ( is_tax( ) ) {
    }


}


//========================================================================================================
// 404 AFHANDELING
//========================================================================================================

remove_action( 'genesis_loop_else', 'genesis_404' );
remove_action( 'genesis_loop_else', 'genesis_do_noposts' );

add_action( 'genesis_loop_else', 'rhswp_no_posts_content_header', 13 );
add_action( 'genesis_loop_else', 'rhswp_no_posts_content', 14 );
add_action( 'genesis_loop_else', 'rhswp_404', 15 );

//========================================================================================================

function rhswp_no_posts_content_header() {

    printf( '<h2 class="entry-title">%s</h2>', __( 'Pagina niet gevonden.', 'wp-rijkshuisstijl' ) );

}

//========================================================================================================

function rhswp_no_posts_content() {

    echo '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'wp-rijkshuisstijl' ), home_url() ) . '</p>';

    echo '<p>' . get_search_form() . '</p>';

}

//========================================================================================================

function rhswp_404() {

  echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';
  
  if ( is_404() ) {
    rhswp_no_posts_content_header();
  }
  
  echo '<div class="entry-content">';
  
  if ( is_404() ) {
    rhswp_no_posts_content();
  }
  
  rhswp_get_sitemap_content();
  
  echo '</div>';
  
  echo genesis_html5() ? '</article>' : '</div>';
  
}

//========================================================================================================


function rhswp_get_relevant_links() {


  $args = array(
    'post_type'   => RHS_LINK_CPT,
    'limit'       => -1,
    'orderby'     => 'name',
    'order'       => 'ASC'
  ); 
  $links = new WP_Query( $args );
  
  if ( $links->have_posts() ) {
    
    echo '<div class="flex">';  
    
    while ( $links->have_posts() ) : $links->the_post();
    
      if ( function_exists( 'get_field' ) ) {
        $url_voor_relevante_link        = get_field('url_voor_relevante_link' );
        $linktekst_voor_relevante_link  = get_field('linktekst_voor_relevante_link' );
      }
      
      
      echo '<section><header class="entry-header"><h2 class="entry-title" itemprop="headline">';
      the_title();
      echo '</h2></header>';
      
      echo '<div class="entry-content" itemprop="text">';
      the_content();
      
      if ( $url_voor_relevante_link ) {
        echo '<a href="';
        echo $url_voor_relevante_link;
        echo '">';
        echo $linktekst_voor_relevante_link;
        echo '</a>';
      }
      
      
      echo '</div></section>';
      
    endwhile;
    
    echo '</div>';  
    
  }

}

//========================================================================================================

function rhswp_get_sitemap_content() {
  ?>        

  <section>
    <h2><?php _e( "Pagina's", 'wp-rijkshuisstijl' ); ?></h2>
    <ul>
        <?php wp_list_pages( 'exclude=78,80&title_li=' ); ?>
    </ul>

    <h2><?php _e( 'Recent Posts:', 'wp-rijkshuisstijl' ); ?></h2>
    <ul>
        <?php wp_get_archives( 'type=postbypost&limit=10' ); ?>
    </ul>
  </section>

  <?php
}

//========================================================================================================

function rhswp_get_sitemap() {
  
  
  echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';
  
  if ( is_404() ) {
    rhswp_no_posts_content_header();
  }
  
  echo '<div class="entry-content">';
  
  if ( is_404() ) {
    rhswp_no_posts_content();
  }
  
  rhswp_get_sitemap_content();

  echo '</div>';
  
  echo genesis_html5() ? '</article>' : '</div>';
  
}

//========================================================================================================

// add an extra widget area
function rhswp_widget_homepage() {

  if ( is_active_sidebar( RHSWP_HOME_WIDGET_AREA ) ) {
    echo '<div class="widgets ' . RHSWP_HOME_WIDGET_AREA . ' entry">';
    dynamic_sidebar( RHSWP_HOME_WIDGET_AREA );
    echo '</div>';
  }
}


genesis_register_sidebar(   
    array(
        'name'              => __( "Homepage widget area", 'wp-rijkshuisstijl' ),
        'id'                => RHSWP_HOME_WIDGET_AREA,
        'description'       => __( "Ruimte voor widget op de homepage", 'wp-rijkshuisstijl' ),
        'before_widget' => genesis_markup( array(
            'html5' => '<section id="%1$s" class="widget %2$s '.RHSWP_HOME_WIDGET_AREA . '"><div class="widget-wrap">',
            'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
            'echo'  => false,
        ) ),
        'after_widget'  => genesis_markup( array(
            'html5' => '</div></section>' . "\n",
            'xhtml' => '</div></div>' . "\n",
            'echo'  => false
        ) ),
        'before_title'  => '<h2 class="widget-title widgettitle">',
        'after_title'   => "</h2>\n",
    )
);

//========================================================================================================


// Ervoor zorgen dat het commentform niet leeg gelaten kan worden
add_action( 'wp_enqueue_scripts', 'rhswp_enqueue_js_scripts' );

function rhswp_enqueue_js_scripts() {

    if ( ( is_home() || is_front_page() ) ) {
//        wp_enqueue_script( 'commentform', RHSWP__THEMEFOLDER . '/js/min/scripts-home-min.js', array( 'jquery' ), '', true );
    }
}

//========================================================================================================

add_filter( 'genesis_after', 'rhswp_trackercode', 999 );

function rhswp_trackercode() {


  if ( 'www.digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] || 'digitaleoverheid.nl' == $_SERVER["HTTP_HOST"] ) { 

        echo '<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["enableLinkTracking"]);
  _paq.push(["setLinkTrackingTimer", 750]);
  _paq.push(["enableHeartBeatTimer"]);
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
  (function() {
    var u="//statistiek.rijksoverheid.nl/piwik/";
    _paq.push(["setTrackerUrl", u+"js/tracker.php"]);
    _paq.push(["setSiteId", 388]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0];
    g.type="text/javascript"; g.async=true; g.defer=true; g.src=u+"js/tracker.php"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->';
    }

    else {
        if ( WP_DEBUG ) {
          echo '<!-- Geen Piwik: ' . $_SERVER["HTTP_HOST"] . '-->';
        }
    }
}

//========================================================================================================



/*
 * Modifying TinyMCE editor to remove unused items.
*/

function admin_set_tinymce_options( $settings ) {
    $settings['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6,q,hr';
    $settings['theme_advanced_disable'] = 'underline,spellchecker,forecolor,justifyfull';
    $settings['theme_advanced_buttons2_add'] = 'styleselect';
    $settings['theme_advanced_styles'] = "'Infoblok'=infoblock, 'Streamer'=pullquote";

    // ============
     
    $settings['toolbar1'] = 'formatselect,italic,bullist,numlist,blockquote,|,link,unlink,|,spellchecker,|,removeformat,cleanup,|,alignleft,alignright,undo,redo,outdent,indent,hr,fullscreen';
    $settings['toolbar2'] = '';
    $settings['block_formats'] = 'Tussenkop niveau 2=h2;Tussenkop niveau 3=h3;Tussenkop niveau 4=h4;Paragraaf=p;Citaat=q';


//            {title: "Streamer", block: "aside", classes: "pullquote"},
//    		{title: "Interviewvraag", inline: "i", classes: "interview"}
    
    return $settings;
}


 
add_filter('tiny_mce_before_init', 'admin_set_tinymce_options');

//========================================================================================================

function rhswp_debug_css() {
//  wp_enqueue_style( 'debug-header-check', RHSWP__THEMEFOLDER . '/css/header.css', array(), CHILD_THEME_VERSION );
  if ( WP_REVENGE ) {
    wp_enqueue_style( 'debug-css', RHSWP__THEMEFOLDER . '/css/revenge.css', array(), CHILD_THEME_VERSION );
  }
}


if ( WP_DEBUG ) {
    add_action( 'wp_enqueue_scripts', 'rhswp_debug_css' );
}

//========================================================================================================
            
function ibo_home_filter() {

echo 'ibo_home_filter';

    $args = array(
        'parent'         => 0,
        'hide_empty'    => 1
    );


    $terms = get_terms( CTAX_thema, $args );

    echo '<section class="content">';


    echo '<div class="thema-blocks flex">';

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    
        foreach($terms as $term) {

            echo termblock_home($term);

        }
        
//        echo '</div>';

    }


    if ( function_exists( 'get_field' ) ) {
        
        $acf_id = $term->taxonomy . '_' . $term->term_id;
        
        $thema_titel_met_opmaak        = get_field( 'thema_titel_met_opmaak', $acf_id );
        $thema_kleur                = get_field( 'thema_kleur', $acf_id );

        if ( $thema_kleur == 'donkerblauw' ) {
            $thema_kleur = ' donkerblauw';
        }
        else {
            $thema_kleur = ' mediumblauw';
        }
        
    }
    $return = '';

    $return .= '<div class="collection">';


    $return .=  '<h2>';
    $return .=  __( 'Koepels', 'ibewustzijn' );
    $return .=  '</h2>';

    $args = array(
        'parent'         => 0,
        'hide_empty'    => 1
    );


    $terms = get_terms( CTAX_bestuurslaag, $args );

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    
        $return .= '<ul>';

    
        foreach($terms as $term) {

            $acf_id = $term->taxonomy . '_' . $term->term_id;
            
            $thema_titel_met_opmaak        = get_field( 'thema_titel_met_opmaak', $acf_id );
            $thema_kleur                = get_field( 'thema_kleur', $acf_id );
    
            if ( $thema_kleur == 'mediumblauw' ) {
                $thema_kleur = 'mediumblauw';
            }
            else {
                $thema_kleur = ' donkerblauw';
            }
    
            $return .= '<li class="' . $thema_kleur . '">';
            $return .= '<a href="';
            $return .= get_term_link($term);
            $return .= '">';
            
            if ( $thema_titel_met_opmaak ) {
                $return .= $thema_titel_met_opmaak;
            }
            else {
                $return .= $term->name;
            }
            
            $return .= '</a></li>';

        }
        
        $return .= '</ul>';

    }
    
    
    $return .= '</div>';
    
    echo     $return;        
    

    
        echo '</div>';


    echo '</section>';

}            

//========================================================================================================

function rhswp_register_extra_menu() {
  register_nav_menu('extra-menu',__( 'Extra navigatiemenu (rechtsboven)', 'wp-rijkshuisstijl' ) );
}

add_action( 'init', 'rhswp_register_extra_menu' );

//========================================================================================================

//* Add the extra navigation menu
add_action( 'genesis_header', 'rhswp_display_extra_menu', 2 );

function rhswp_display_extra_menu() {
  wp_nav_menu( array( 'theme_location' => 'extra-menu', 'container_class' => 'wrap extra-menu' ) );
}


//========================================================================================================

  /**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );
  