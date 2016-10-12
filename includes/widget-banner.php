<?php

/**
 * wp-rijkshuisstijl - widget-banner.php
 * ----------------------------------------------------------------------------------
 * Widget voor het aanmaken van een banner
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.8 
 * @desc.   Changes for banner widget; added CPT documenten; 
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//========================================================================================================
//* banner widget
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
	
     
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, 
            array( 
                'rhswp_banner_widget_title'    => '', 
                'rhswp_banner_widget_short_text'    => '',    
                'rhswp_banner_widget_page_linktext'    => '',    
                'rhswp_banner_widget_page_link'    => '' 
                ) 
            );

        $rhswp_banner_widget_title          = empty( $instance['rhswp_banner_widget_title'] )         ? '' : $instance['rhswp_banner_widget_title'];
        $rhswp_banner_widget_short_text     = empty( $instance['rhswp_banner_widget_short_text'] )    ? '' : $instance['rhswp_banner_widget_short_text'];
        $rhswp_banner_widget_page_link      = empty( $instance['rhswp_banner_widget_page_link'] )     ? '' : $instance['rhswp_banner_widget_page_link'];
        $rhswp_banner_widget_page_linktext  = empty( $instance['rhswp_banner_widget_page_linktext'] ) ? '' : $instance['rhswp_banner_widget_page_linktext'];


        ?>

        <p><label for="<?php echo $this->get_field_id('rhswp_banner_widget_title'); ?>">Titel: <input id="<?php echo $this->get_field_id('rhswp_banner_widget_title'); ?>" name="<?php echo $this->get_field_name('rhswp_banner_widget_title'); ?>" type="text" value="<?php echo esc_attr($rhswp_banner_widget_title); ?>" /></label></p>
        
        <p><label for="<?php echo $this->get_field_id('rhswp_banner_widget_short_text') ?>"><?php  _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?><br /><textarea cols="33" rows="4" id="<?php echo $this->get_field_id('rhswp_banner_widget_short_text'); ?>" name="<?php echo $this->get_field_name('rhswp_banner_widget_short_text'); ?>"><?php echo esc_attr($rhswp_banner_widget_short_text); ?></textarea></label></p>


        <p><label for="<?php echo $this->get_field_id('rhswp_banner_widget_page_linktext'); ?>">Linktekst:<br><input id="<?php echo $this->get_field_id('rhswp_banner_widget_page_linktext'); ?>" name="<?php echo $this->get_field_name('rhswp_banner_widget_page_linktext'); ?>" type="text" value="<?php echo esc_attr($rhswp_banner_widget_page_linktext); ?>" /></label></p>
        


        <label for="<?php echo $this->get_field_id('rhswp_banner_widget_page_link') . '">' . __( "Linkt naar pagina:", 'wp-rijkshuisstijl' ) ?><br />
        <?php
            $args = array(
                'depth'            => 0,
                'child_of'         => 0,
                'selected'         => esc_attr($rhswp_banner_widget_page_link),
                'echo'             => 1,
                'name'             => $this->get_field_name('rhswp_banner_widget_page_link')
            );
            
            wp_dropdown_pages( $args );
            
            echo '</label>';

            
    }
     
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['rhswp_banner_widget_title']            = empty( $new_instance['rhswp_banner_widget_title'] ) ? '' : $new_instance['rhswp_banner_widget_title'];
        $instance['rhswp_banner_widget_page_linktext']    = empty( $new_instance['rhswp_banner_widget_page_linktext'] ) ? '' : $new_instance['rhswp_banner_widget_page_linktext'];
        $instance['rhswp_banner_widget_short_text']     	= empty( $new_instance['rhswp_banner_widget_short_text'] ) ? '' : $new_instance['rhswp_banner_widget_short_text'];
        $instance['rhswp_banner_widget_page_link']        = empty( $new_instance['rhswp_banner_widget_page_link'] ) ? '' : $new_instance['rhswp_banner_widget_page_link'];
        return $instance;
    }
     
    function widget($args, $instance) {


        extract($args, EXTR_SKIP);

        $rhswp_banner_widget_title          = empty($instance['rhswp_banner_widget_title']) ? '' : $instance['rhswp_banner_widget_title'] ;

        $text_color     = empty( get_field( 'rhswp_widget_tekstkleur', 'widget_' . $widget_id) ) ? '#000000' : get_field( 'rhswp_widget_tekstkleur', 'widget_' . $widget_id);
         

        $rhswp_banner_widget_title          = empty($instance['rhswp_banner_widget_title'])         ? '' : $instance['rhswp_banner_widget_title'] ;
        $rhswp_banner_widget_short_text     = empty($instance['rhswp_banner_widget_short_text'])    ? '' : '<span style="color:' . $text_color . ';">' . $instance['rhswp_banner_widget_short_text'] . '</span>';
        $rhswp_banner_widget_page_link      = empty($instance['rhswp_banner_widget_page_link'])     ? '' : $instance['rhswp_banner_widget_page_link'] ;
        $rhswp_banner_widget_page_linktext  = empty($instance['rhswp_banner_widget_page_linktext']) ? '' : $instance['rhswp_banner_widget_page_linktext'] ;
        $linkafter          = '';
        
        if ( $rhswp_banner_widget_page_linktext ) {
          
        
          echo $before_widget;
          echo '<div class="text">'; 
  
          $linkbefore         = '';
          $linkafter          = '';
          
          if ( $rhswp_banner_widget_page_link )
          {
              $rhswp_banner_widget_page_link    = get_permalink($rhswp_banner_widget_page_link);
//              $linkbefore     = '<p class="read-more"><a href="' . $rhswp_banner_widget_page_link. '" style="color:' . $text_color . ';">' . $rhswp_banner_widget_page_linktext;
//              $linkafter      = '</a></p>';
              $linkbefore  .= '<a href="' . $rhswp_banner_widget_page_link. '" tabindex="-1">';
              $linkafter    = '</a>';
          }
 
          echo $linkbefore;
  
          if ( $instance['rhswp_banner_widget_title'] !== '') {
              echo $before_title . $instance['rhswp_banner_widget_title'] . $after_title;
          }
  
          echo $rhswp_banner_widget_short_text;
          echo $linkafter;
          echo '</div>'; 
          echo $after_widget;

        }
        else {
          echo '<!-- ' . _x( "Hier zou een banner staan, maar er is geen linktekst ingevoerd", 'Widget', 'wp-rijkshuisstijl' )  . ' -->';
        }
        
    }
 
}


add_action( 'widgets_init', create_function('', 'return register_widget("rhswp_banner_widget");') );


//========================================================================================================

add_filter('dynamic_sidebar_params', 'filter_for_RHSWP_WIDGET_BANNER');

function filter_for_RHSWP_WIDGET_BANNER( $params ) {
	
	// get widget vars
	$widget_name  = $params[0]['widget_name'];
	$widget_id    = $params[0]['widget_id'];
	
//	echo($widget_name);
	
	// bail early if this widget is not a Text widget
	if( $widget_name != RHSWP_WIDGET_BANNER ) {
		
		return $params;
		
	}


  $backgr_color   = empty( get_field( 'rhswp_widget_achtergrondkleur', 'widget_' . $widget_id) ) ? '#ffffff' : get_field( 'rhswp_widget_achtergrondkleur', 'widget_' . $widget_id);
  $text_color     = empty( get_field( 'rhswp_widget_tekstkleur', 'widget_' . $widget_id) ) ? '#000000' : get_field( 'rhswp_widget_tekstkleur', 'widget_' . $widget_id);

  

  if( $backgr_color ) {
    $params[0]['before_widget'] .= sprintf('<div style="background-color: %s; padding: 1em;">', $backgr_color);
    $params[0]['after_widget'] .= '</div>';		
  }
  
  if ( $text_color ) {
//    $params[0]['before_widget'] .= sprintf('<a href="%s" style="color:%s;">', $url, $text_color);
//    $params[0]['after_widget'] .= '</a>';		
  }
    
  
  
	
	// return
	return $params;

}

//========================================================================================================

	
	