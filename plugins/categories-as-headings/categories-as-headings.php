<?php
/*
Plugin Name: Categories as headings
Plugin URI: http://dealerfire.com
Description: A category widget with headings instead of a list.
Author: Justin Friebel
Version: 1.0
Author URI: http://dealerfire.com
*/


/**
 * Categories as headings widget class
 *
 * @since 2.8.0
 */
class categories_as_headings extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_categories_as_headings', 'description' => __( "Categories as headings" ) );
		parent::__construct('categories_as_headings', __('Categories as headings.'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
    $s = ! empty( $instance['style'] ) ? 'list' : 'none';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'style' => $s);

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category');

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
?>

<script type='text/javascript'>
/* <![CDATA[ */
	var dropdown = document.getElementById("cat");
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> */
</script>

<?php
		} else {
?>

<?php
		$cat_args['title_li'] = '';

		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.
		 */

    $custom_cat_args = array(
      'orderby' => 'count',
      'parent' => 0,
      'number' => 5
      );
    $categories = get_categories( $custom_cat_args );
    foreach ( $categories as $category ) {
      echo '<h6><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></h6>';
    }
      
?>

<a href="<?php echo home_url(); ?>/popular-categories">View all</a>

<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

<?php
	}

}

// Register and load the widget
function cah_load_widget() {
  register_widget( 'categories_as_headings' );
}
add_action( 'widgets_init', 'cah_load_widget' );

?>
