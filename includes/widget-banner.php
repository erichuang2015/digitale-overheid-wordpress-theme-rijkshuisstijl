<?php

/**
// * wp-rijkshuisstijl - widget-banner.php
// * ----------------------------------------------------------------------------------
// * Widget voor het aanmaken van een banner
// * ----------------------------------------------------------------------------------
// *
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @package wp-rijkshuisstijl
// * @version 1.1.20
// * @desc.   Allow banner widget to display larger sized images.
// * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */


//========================================================================================================
//* banner widget

$rhswp_banner_widget_customcss = '';

class rhswp_banner_widget extends WP_Widget {


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'banner banner-widget',
			'description' => __( 'Mogelijkheid voor het aanmaken van een banner. Kies achtergrondkleur, links, stijl', 'wp-rijkshuisstijl' ),
		);

    parent::__construct( 'rhswp_banner_widget', RHSWP_WIDGET_BANNER, $widget_ops );
	}

  //======================================================================================================

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, 
        array( 
            'rhswp_banner_widget_title'       => '', 
            'rhswp_banner_widget_short_text'  => ''
            ) 
        );
  
    $rhswp_banner_widget_title      = empty( $instance['rhswp_banner_widget_title'] )         ? '' : $instance['rhswp_banner_widget_title'];
    $rhswp_banner_widget_short_text = empty( $instance['rhswp_banner_widget_short_text'] )    ? '' : $instance['rhswp_banner_widget_short_text'];
  
    ?>
  
    <p><label for="<?php echo $this->get_field_id('rhswp_banner_widget_title'); ?>">Titel: <input id="<?php echo $this->get_field_id('rhswp_banner_widget_title'); ?>" name="<?php echo $this->get_field_name('rhswp_banner_widget_title'); ?>" type="text" value="<?php echo esc_attr($rhswp_banner_widget_title); ?>" /></label></p>
    
    <p><label for="<?php echo $this->get_field_id('rhswp_banner_widget_short_text') ?>"><?php  _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?><br /><textarea cols="35" rows="8" id="<?php echo $this->get_field_id('rhswp_banner_widget_short_text'); ?>" name="<?php echo $this->get_field_name('rhswp_banner_widget_short_text'); ?>"><?php echo esc_attr($rhswp_banner_widget_short_text); ?></textarea></label></p><?php

  }

  //======================================================================================================

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['rhswp_banner_widget_title']            = empty( $new_instance['rhswp_banner_widget_title'] ) ? '' : $new_instance['rhswp_banner_widget_title'];
    $instance['rhswp_banner_widget_short_text']     	= empty( $new_instance['rhswp_banner_widget_short_text'] ) ? '' : $new_instance['rhswp_banner_widget_short_text'];
    return $instance;
  }

  //======================================================================================================

  function widget($args, $instance) {
    
    extract($args, EXTR_SKIP);
    
    $rhswp_banner_widget_title          = empty($instance['rhswp_banner_widget_title']) ? '' : $instance['rhswp_banner_widget_title'] ;
    
    $text_color     = empty( get_field( 'rhswp_widget_tekstkleur', 'widget_' . $widget_id) ) ? '#000000' : get_field( 'rhswp_widget_tekstkleur', 'widget_' . $widget_id);
     
    
    $rhswp_banner_widget_title          = empty($instance['rhswp_banner_widget_title'])         ? '' : $instance['rhswp_banner_widget_title'] ;
    $rhswp_banner_widget_short_text     = empty($instance['rhswp_banner_widget_short_text'])    ? '' : $instance['rhswp_banner_widget_short_text'];
    
    
    echo $before_widget;
    echo '<div class="text">'; 
    
    if ( $instance['rhswp_banner_widget_title'] !== '') {
        echo $before_title . $instance['rhswp_banner_widget_title'] . $after_title;
    }
    
    echo $rhswp_banner_widget_short_text;
    
    echo '</div>'; 
    echo $after_widget;
    
  }

  //======================================================================================================

 
}

//========================================================================================================

add_filter('dynamic_sidebar_params', 'filter_for_rhswp_banner_widget');

function filter_for_rhswp_banner_widget( $params ) {

  global $rhswp_banner_widget_customcss;
	
	// get widget vars
	$widget_name  = $params[0]['widget_name'];
	$widget_id    = $params[0]['widget_id'];
	
	$rhswp_banner_widget_customcss = '';

	// bail early if this widget is not a Text widget
	if( $widget_name != RHSWP_WIDGET_BANNER ) {
		return $params;
	}
	
	$imagesize = 'widget-image';

  $rhswp_widget_link          = empty( get_field( 'rhswp_widget_link', 'widget_' . $widget_id) ) ? '' : get_field( 'rhswp_widget_link', 'widget_' . $widget_id);
  $rhswp_widget_bannerimage   = empty( get_field( 'rhswp_widget_bannerimage', 'widget_' . $widget_id) ) ? '' : get_field( 'rhswp_widget_bannerimage', 'widget_' . $widget_id);
  $rhswp_widget_class         = empty( get_field( 'rhswp_widget_class', 'widget_' . $widget_id) ) ? 'standaard' : get_field( 'rhswp_widget_class', 'widget_' . $widget_id);
  $rhswp_widget_textalignment = empty( get_field( 'rhswp_widget_textalignment', 'widget_' . $widget_id) ) ? '' : get_field( 'rhswp_widget_textalignment', 'widget_' . $widget_id);



  // link toevoegen, if any
  if( $rhswp_widget_link ) {

    $params[0]['before_widget'] .= '<a href="' . $rhswp_widget_link . '">';
    $params[0]['after_widget'] = '</a>' . $params[0]['after_widget'];

  }

  // plaatje toevoegen, if any
  if( $rhswp_widget_bannerimage ) {


    $rhswp_widget_bannerimage_alignment = empty( get_field( 'rhswp_widget_image_alignment', 'widget_' . $widget_id) ) ? 'top' : get_field( 'rhswp_widget_image_alignment', 'widget_' . $widget_id);

    if ( $rhswp_widget_bannerimage_alignment == 'top' || $rhswp_widget_class == 'text-over-plaatje' ) {

      if ( $rhswp_widget_bannerimage['sizes']['large-width'] > 700 ) {
        $imagesize = 'large';
      }
      else {
        $imagesize = 'widget-image-top';
      }

    }

    $params[0]['before_widget'] .= sprintf('<img src="%s" alt="' . $rhswp_widget_bannerimage['alt'] . '" class="align' . $rhswp_widget_bannerimage_alignment . '" width="%s" height="%s" />',
    $rhswp_widget_bannerimage['sizes'][$imagesize], 
    $rhswp_widget_bannerimage['sizes'][$imagesize.'-width'], 
    $rhswp_widget_bannerimage['sizes'][$imagesize.'-height'] );

  }

  // class toepassen, if any
  if( $rhswp_widget_class ) {

    $haystack = $params[0]['before_widget'];
    $needle   = 'class="widget-wrap';
    $replacer = 'class="widget-wrap ' . $rhswp_widget_class;

    $params[0]['before_widget'] = str_replace( $needle, $replacer, $haystack );

  }

  // tekstuitlijning, if any
  if( $rhswp_widget_textalignment ) {

    $haystack = $params[0]['before_widget'];
    $needle   = 'class="widget-wrap';
    $replacer = 'class="widget-wrap text-align-' . $rhswp_widget_textalignment;

    $params[0]['before_widget'] = str_replace( $needle, $replacer, $haystack );

  }


  

	// return
	return $params;

}

//========================================================================================================


function rhswp_banner_widget_register() {
  return register_widget("rhswp_banner_widget");  
}

add_action( 'widgets_init', 'rhswp_banner_widget_register' );

	
