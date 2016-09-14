<?php

/**
 * wp-rijkshuisstijl - widget-home.php
 * ----------------------------------------------------------------------------------
 * voor als je niet weet waar je bent. Als je jezelf zoekt, of als je
 * gewoon in z'n algemeenheid de site probeert stuk te maken.
 * ----------------------------------------------------------------------------------
 *
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @package wp-rijkshuisstijl
 * @version 0.1.0 
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    http://wbvb.nl/themes/wp-rijkshuisstijl/
 */


//========================================================================================================
//* banner widget
class rhswp_page_widget extends WP_Widget {


	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'page-link-widget',
			'description' => __( 'Korte tekst met verwijzing naar een pagina.', 'gebruikercentraal' ),
		);

		parent::__construct( 'rhswp_page_widget', 'RHS2 - home widget', $widget_ops );

	}
	
     
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, 
            array( 
                'rhswp_page_widget_title'    => '', 
                'rhswp_page_widget_short_text'    => '',    
                'rhswp_page_widget_page_linktext'    => '',    
                'rhswp_page_widget_page_link'    => '' 
                ) 
            );

        $rhswp_page_widget_title          = empty( $instance['rhswp_page_widget_title'] ) ? '' : $instance['rhswp_page_widget_title'];
        $rhswp_page_widget_short_text     = empty( $instance['rhswp_page_widget_short_text'] ) ? '' : $instance['rhswp_page_widget_short_text'];
        $rhswp_page_widget_page_link      = empty( $instance['rhswp_page_widget_page_link'] ) ? '' : $instance['rhswp_page_widget_page_link'];
        $rhswp_page_widget_page_linktext  = empty( $instance['rhswp_page_widget_page_linktext'] ) ? '' : $instance['rhswp_page_widget_page_linktext'];


        ?>

        <p><label for="<?php echo $this->get_field_id('rhswp_page_widget_title'); ?>">Titel: <input id="<?php echo $this->get_field_id('rhswp_page_widget_title'); ?>" name="<?php echo $this->get_field_name('rhswp_page_widget_title'); ?>" type="text" value="<?php echo esc_attr($rhswp_page_widget_title); ?>" /></label></p>
        
        <p><label for="<?php echo $this->get_field_id('rhswp_page_widget_short_text') ?>"><?php  _e( "Vrije tekst in widget:", 'wp-rijkshuisstijl' ) ?><br /><textarea cols="33" rows="4" id="<?php echo $this->get_field_id('rhswp_page_widget_short_text'); ?>" name="<?php echo $this->get_field_name('rhswp_page_widget_short_text'); ?>"><?php echo esc_attr($rhswp_page_widget_short_text); ?></textarea></label></p>


        <p><label for="<?php echo $this->get_field_id('rhswp_page_widget_page_linktext'); ?>">Linktekst:<br><input id="<?php echo $this->get_field_id('rhswp_page_widget_page_linktext'); ?>" name="<?php echo $this->get_field_name('rhswp_page_widget_page_linktext'); ?>" type="text" value="<?php echo esc_attr($rhswp_page_widget_page_linktext); ?>" /></label></p>
        


        <label for="<?php echo $this->get_field_id('rhswp_page_widget_page_link') . '">' . __( "Linkt naar pagina:", 'wp-rijkshuisstijl' ) ?><br />
        <?php
            $args = array(
                'depth'            => 0,
                'child_of'         => 0,
                'selected'         => esc_attr($rhswp_page_widget_page_link),
                'echo'             => 1,
                'name'             => $this->get_field_name('rhswp_page_widget_page_link')
            );
            
            wp_dropdown_pages( $args );
            
            echo '</label>';

            
    }
     
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['rhswp_page_widget_title']            = empty( $new_instance['rhswp_page_widget_title'] ) ? '' : $new_instance['rhswp_page_widget_title'];
        $instance['rhswp_page_widget_page_linktext']    = empty( $new_instance['rhswp_page_widget_page_linktext'] ) ? '' : $new_instance['rhswp_page_widget_page_linktext'];
        $instance['rhswp_page_widget_short_text']     	= empty( $new_instance['rhswp_page_widget_short_text'] ) ? '' : $new_instance['rhswp_page_widget_short_text'];
        $instance['rhswp_page_widget_page_link']        = empty( $new_instance['rhswp_page_widget_page_link'] ) ? '' : $new_instance['rhswp_page_widget_page_link'];
        return $instance;
    }
     
    function widget($args, $instance) {


        extract($args, EXTR_SKIP);

        $rhswp_page_widget_title          = empty($instance['rhswp_page_widget_title']) ? '' : $instance['rhswp_page_widget_title'] ;
        $rhswp_page_widget_short_text     = empty($instance['rhswp_page_widget_short_text']) ? '' : $instance['rhswp_page_widget_short_text'] ;
        $rhswp_page_widget_page_link      = empty($instance['rhswp_page_widget_page_link']) ? '' : $instance['rhswp_page_widget_page_link'] ;
        $rhswp_page_widget_page_linktext  = empty($instance['rhswp_page_widget_page_linktext']) ? '' : $instance['rhswp_page_widget_page_linktext'] ;
        $linkafter          = '';
        
         
        echo $before_widget;



        echo '<div class="text">'; 

        $linkbefore         = '';
        $linkafter          = '';
        
        if ( $rhswp_page_widget_page_link )
        {
            $rhswp_page_widget_page_link    = get_permalink($rhswp_page_widget_page_link);
            $linkbefore     = '<p class="read-more"><a href="' . $rhswp_page_widget_page_link. '">' . $rhswp_page_widget_page_linktext;
            $linkafter      = '</a></p>';
            $before_title  .= '<a href="' . $rhswp_page_widget_page_link. '" tabindex="-1">';
            $after_title    = '</a>' . $after_title;
        }

        if ( $instance['rhswp_page_widget_title'] !== '') {
            echo $before_title . $instance['rhswp_page_widget_title'] . $after_title;
        }

        echo $rhswp_page_widget_short_text;
        echo $linkbefore . $linkafter;

        echo $after_widget;
    }
 
}


add_action( 'widgets_init', create_function('', 'return register_widget("rhswp_page_widget");') );


add_action( 'widgets_init', create_function('', 'return register_widget("rhswp_news_widget");') );



//========================================================================================================
//* news widget
class rhswp_news_widget extends WP_Widget {

    function __construct() {

        $this->defaults = array(
            'title'          => '',
            'nav_menu'         => '',
        );

        $widget_ops = array('classname' => 'ibo-posts-widget', 'description' => 'Toont berichten uit een categorie');

        $control_ops = array();

        parent::__construct( 'rhswp_news_widget', __( 'Berichtenwidget (per categorie)', 'wp-rijkshuisstijl' ), $widget_ops, $control_ops );

    }
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, 
            array( 
                'rhswp_news_title' => '', 
                'rhswp_news_category' => '', 
                'rhswp_news_max' => '' 
                ) 
            );

        $rhswp_news_title     = empty( $instance['rhswp_news_title'] ) ? '' : $instance['rhswp_news_title'];
        $rhswp_news_category  = $instance['rhswp_news_category'];
        $rhswp_news_max       = $instance['rhswp_news_max'];
        
        ?>
        <p><label for="<?php echo $this->get_field_id('rhswp_news_title') . '">' . __( "Titel:", 'wp-rijkshuisstijl' ) ?><br /><input id="<?php echo $this->get_field_id('rhswp_news_title'); ?>" name="<?php echo $this->get_field_name('rhswp_news_title'); ?>" type="text" style="width: 100%;" value="<?php echo esc_attr($rhswp_news_title); ?>" /></label><br>(niet zichtbaar, wel noodzakelijk)</p>
        
        <?php
            
            $args = array(
                'orderby'       => 'name', 
                'order'         => 'ASC',
                'hide_empty'    => true, 
                'fields'        => 'all', 
                'hierarchical'  => true, 
                'cache_domain'  => 'core'
            ); 
            
            $availablecategories         = get_terms( 'category', $args );            
            $count                        = count($availablecategories);

            echo '<p><label for="' . $this->get_field_id('rhswp_news_category') . '">' . __( "Categorie:", 'wp-rijkshuisstijl' ) . '<br />';
            wp_dropdown_categories(array('hide_empty' => 1, 'name' => $this->get_field_name('rhswp_news_category'), 'hierarchical' => true, 'selected' => $rhswp_news_category));
            echo '</label></p>';

            $counter  = 0;
            $max      = 10;
            
            echo '<p><label for="' . $this->get_field_id('rhswp_news_max') . '">' . __( "Aantal:", 'wp-rijkshuisstijl' ) . '<br /><select name="' . $this->get_field_name('rhswp_news_max') . '" id="rhswp_news_max">';
            while ( $counter < $max ) {
                $counter++;
                echo '<option value="' . $counter . '"';
                if ($rhswp_news_max == $counter) {
                    echo ' selected>';
                }
                else {
                    echo '>';
                }
                echo $counter . '</option>';
            }
            echo "</select></label></p>";


    }
     
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['rhswp_news_title']     = empty( $new_instance['rhswp_news_title'] ) ? '' : $new_instance['rhswp_news_title'];
        $instance['rhswp_news_category']  = empty( $new_instance['rhswp_news_category'] ) ? '' : $new_instance['rhswp_news_category'];
        $instance['rhswp_news_max']       = empty( $new_instance['rhswp_news_max'] ) ? '' : $new_instance['rhswp_news_max'];
        return $instance;
    }
     
    function widget($args, $instance) {
        global $query;
        global $post;
        global $wp_query;
    
        extract($args, EXTR_SKIP);

        $rhswp_news_title     = empty( $instance['rhswp_news_title'] ) ? '' : $instance['rhswp_news_title'];
        $categorie          = empty($instance['rhswp_news_category']) ? '' : $instance['rhswp_news_category'] ;
        $aantalberichten    = empty($instance['rhswp_news_max']) ? '5' : $instance['rhswp_news_max'] ;


        if ( isset($wp_query->query_vars['category_name'] ) ) 
        {

            $currentcat     =   get_category_by_slug( $wp_query->query_vars['category_name'] ); 
            if ( $currentcat ) 
            {
                $currentcat_id  =   $currentcat->term_id;
    
                if ( $currentcat_id == $categorie ) 
                {
                    showdebug("currentcat " . $currentcat_id);
                    showdebug("categorie " . $categorie);
                    showdebug("WOEPS! " . $categorie . "=" . $currentcat_id);
                }
            }
        }
         

        $args = array(
            'type'                     => 'post',
            'child_of'                 => 0,
            'parent'                   => $categorie,
            'orderby'                  => 'id',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            'hierarchical'             => 1,
            'taxonomy'                 => 'category',
            'pad_counts'               => false 
        ); 
        
        $categories = get_categories( $args ); 
        
        $args = array(
            'post_type'             =>  'post',
            'posts_per_page'        =>  $aantalberichten, 
            'ignore_sticky_posts'   =>  1, 
            'order'                 =>  'DESC',
            'orderby'               =>  'date'
            );
        
        if ($categories) 
        {
            
            $subcat = $categorie;
            
            foreach ( $categories as $term ) 
            {
                $subcat .= ','.$term->term_id;
            }
            $args['cat']    =  $subcat;       
        }
        else 
        {
            $args['cat']    =  $categorie;       
        }
        
        $sidebarposts = new WP_query();

        if ( is_single() ) 
        {
            $args['post__not_in'] =  array( $post->ID );       
        }
        // Assign predefined $args to your query
        $sidebarposts->query($args);
        
        
        $countertje = 0; // Run your normal loop
        
        if ($sidebarposts->have_posts()) 
        {

            $category_id = get_cat_ID( 'Category Name' );
            
            // Get the URL of this category
            $category_link = get_category_link( $categorie );        

            echo $before_widget;
            echo '<h2 class="widget-title">'. $rhswp_news_title . '</h2>'; 

            echo '<div class="flex">';

             while ($sidebarposts->have_posts()) : $sidebarposts->the_post();
                // do loop stuff
                $countertje++;
                $permalink = get_permalink();
                    
                echo '<div class="flexmij">'; 
                echo '<h3>'; 
                echo '<a href="' . $permalink . '">';
                echo the_title();
                echo '</a>';
                echo '</h3>';
                echo the_excerpt();
                echo '<p class="read-more"><a href="' . $permalink. '" tabindex="-1">';
                echo __( "Lees", 'wp-rijkshuisstijl' ) . ' ' . get_the_title();
                echo '</a></p>';
                echo '</div>'; 
            
            endwhile;

            echo '</div>'; 


            if ( $countertje > 2 ) 
            {
                echo '<div class="category-link"><a href="' . $category_link . '">' . __( "Meer", 'wp-rijkshuisstijl' ) . ' ' . strtolower( get_the_category_by_ID( $categorie ) ). '</a></div>';
            }

            echo $after_widget;
            
        }
        
        // RESET THE QUERY
        wp_reset_query();

    }
 
}

	
	