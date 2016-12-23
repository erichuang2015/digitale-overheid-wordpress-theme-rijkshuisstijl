<?php
/*
Plugin Name: BE Subpages Widget
Plugin URI: http://www.billerickson.net
Description: Lists subpages of the current section
Version: 1.6.1
Author: Bill Erickson
Author URI: http://www.billerickson.net
License: GPLv2
*/

/** 
 * Register Widget
 *
 */
function be_subpages_load_widgets() {
	register_widget( 'BE_Subpages_Widget' );
}
add_action( 'widgets_init', 'be_subpages_load_widgets' );

/**
 * Subpages Widget Class
 *
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class BE_Subpages_Widget extends WP_Widget {
	
    /**
     * Constructor
     *
     * @return void
     **/
	function __construct() {
		load_plugin_textdomain( 'wp-rijkshuisstijl', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		$widget_ops = array( 'classname' => 'widget_subpages', 'description' => __( "Toont de subpagina's of hoofdpagina van de huidige pagina in een widget", 'wp-rijkshuisstijl' ) );
		parent::__construct( 'subpages-widget', __( '(DO) toon subpagina-widget', 'wp-rijkshuisstijl' ), $widget_ops );
	}

    /**
     * Outputs the HTML for this widget.
     *
     * @param array, An array of standard parameters for widgets in this theme 
     * @param array, An array of settings for this widget instance 
     * @return void Echoes it's output
     **/
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		
		// Only run on hierarchical post types
		$post_types = get_post_types( array( 'hierarchical' => true ) );
		if ( !is_singular( $post_types ) && !apply_filters( 'be_subpages_widget_display_override', false ) )
			return;
			
		// Find top level parent and create path to it
		global $post;
		$be_post = apply_filters( 'be_subpages_widget_override_post', $post );
		$parents = array_reverse( get_ancestors( $be_post->ID, 'page' ) );
		$parents[] = $be_post->ID;
		$parents = apply_filters( 'be_subpages_widget_parents', $parents );

		// Build a menu listing top level parent's children
		$args = array(
			'child_of' => $parents[0],
			'parent' => $parents[0],
			'sort_column' => 'menu_order',
			'post_type' => get_post_type(),
		);
		$depth = 1;
		$subpages = get_pages( apply_filters( 'be_subpages_widget_args', $args, $depth ) );
		
		// If there are pages, display the widget
		if ( empty( $subpages ) ) 
			return;
			
		echo $before_widget;
		
		global $be_subpages_is_first;
		$be_subpages_is_first = true;

		// Build title
		$title = esc_attr( $instance['title'] );
		if( 1 == $instance['title_from_parent'] ) {
			$title = apply_filters( 'be_subpages_widget_title', get_the_title( $parents[0] ) );
			if( 1 == $instance['title_link'] )
				$title = '<a href="' . get_permalink( $parents[0] ) . '">' . $title . '</a>';
		}	

		if( !empty( $title ) ) 
			echo $before_title . $title . $after_title;
		
		if( !isset( $instance['deep_subpages'] ) )
			$instance['deep_subpages'] = 0;
			
		if( !isset( $instance['nest_subpages'] ) )
			$instance['nest_subpages'] = 0;

		// Print the tree
		$this->build_subpages( $subpages, $parents, $instance['deep_subpages'], $depth, $instance['nest_subpages'] );
		
		echo $after_widget;			
	}
	
	/**
	 * Build the Subpages
	 *
	 * @param array $subpages, array of post objects
	 * @param array $parents, array of parent IDs
	 * @param bool $deep_subpages, whether to include current page's subpages
	 * @return string $output
	 */
	function build_subpages( $subpages, $parents, $deep_subpages = 0, $depth = 1, $nest_subpages = 0 ) {
		if( empty( $subpages ) )
			return;
			
		global $post, $be_subpages_is_first;
		// Build the page listing	
		echo '<ul>';
		foreach ( $subpages as $subpage ) {
			$class = array();
			
			// Unique Identifier
			$class[] = 'menu-item-' . $subpage->ID;
			
			// Set special class for current page
			if ( $subpage->ID == $post->ID )
				$class[] = 'widget_subpages_current_page';
				
			// First menu item
			if( $be_subpages_is_first )
				$class[] .= 'first-menu-item';
			$be_subpages_is_first = false;
			
			$class = apply_filters( 'be_subpages_widget_class', $class, $subpage );
			$class = !empty( $class ) ? ' class="' . implode( ' ', $class ) . '"' : '';

			echo '<li' . $class . '><a href="' . get_permalink( $subpage->ID ) . '">' . apply_filters( 'be_subpages_page_title', $subpage->post_title, $subpage ) . '</a>';
			// If nesting supress the closing li
			if (!$nest_subpages)
				echo '</li>';
			
			do_action( 'be_subpages_widget_menu_extra', $subpage, $class );
			
			// Check if the subpage is in parent tree to go deeper
			if ( $deep_subpages && in_array( $subpage->ID, $parents ) ) {
				$args = array(
					'child_of' => $subpage->ID,
					'parent' => $subpage->ID,
					'sort_column' => 'menu_order',
					'post_type' => get_post_type(),
				);
				$deeper_pages = get_pages( apply_filters( 'be_subpages_widget_args', $args, $depth ) );
				$depth++;
				$this->build_subpages( $deeper_pages, $parents, $deep_subpages, $depth, $nest_subpages );
			}
			// If li was surpressed for nesting echo it now
			if ($nest_subpages)
				echo '</li>';

		}
		echo '</ul>';
	}

	/**
	 * Sanitizes form inputs on save
	 * 
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array $new_instance
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['title_from_parent'] = (int) $new_instance['title_from_parent'];
		$instance['title_link'] = (int) $new_instance['title_link'];
		$instance['deep_subpages'] = (int) $new_instance['deep_subpages'];
		$instance['nest_subpages'] = (int) $new_instance['nest_subpages'];
		
		return $instance;
	}

	/**
	 * Build the widget's form
	 *
	 * @param array $instance, An array of settings for this widget instance 
	 * @return null
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'title_from_parent' => 0, 'title_link' => 0, 'deep_subpages' => 0, 'nest_subpages' => 0 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		 
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'wp-rijkshuisstijl' );?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['title_from_parent'], 1 ); ?> id="<?php echo $this->get_field_id( 'title_from_parent' ); ?>" name="<?php echo $this->get_field_name( 'title_from_parent' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'title_from_parent' ); ?>"><?php _e( 'Gebruik hoofd-pagina als widget-titel', 'wp-rijkshuisstijl' );?></label>
		</p>		

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['title_link'], 1 ); ?> id="<?php echo $this->get_field_id( 'title_link' ); ?>" name="<?php echo $this->get_field_name( 'title_link' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'title_link' ); ?>"><?php _e( 'Maak de titel klikbaar', 'wp-rijkshuisstijl' ); echo '<br /><em>('; _e( "Alleen als 'Gebruik hoofd-pagina als widget-titel' is aangevinkt", 'wp-rijkshuisstijl' ); echo ')</em></label>';?>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['deep_subpages'], 1 ); ?> id="<?php echo $this->get_field_id( 'deep_subpages' ); ?>" name="<?php echo $this->get_field_name( 'deep_subpages' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'deep_subpages' ); ?>"><?php _e( "Toon ook de subpagina's van de huidige pagina", 'wp-rijkshuisstijl' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['nest_subpages'], 1 ); ?> id="<?php echo $this->get_field_id( 'nest_subpages' ); ?>" name="<?php echo $this->get_field_name( 'nest_subpages' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'nest_subpages' ); ?>"><?php _e( 'Toon subpagina &lt;ul&gt; in de parent &lt;li&gt;', 'wp-rijkshuisstijl' ); echo '<br /><em>('; _e( "Alleen als 'Toon ook de subpagina's van de huidige pagina' is aangevinkt", 'wp-rijkshuisstijl' ); echo ')</em></label>';?></p>

		<?php
	}	
}