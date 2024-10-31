<?php

/**
 * The widget functionality of the plugin.
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Advanced_Search
 * @subpackage RS_Advanced_Search/includes
 */

 /**
 * The widget functionality of the plugin.
 *
 * @package    RS_Advanced_Search
 * @subpackage RS_Advanced_Search/includes
 * @author     Ratko Solaja <me@ratkosolaja.info>
 */
class RS_Advanced_Search_Widget extends WP_Widget {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		$this->plugin_name = 'rs-advanced-search';

		parent::__construct(
			'rs_advanced_search',
			__( 'RS Advanced Search', 'rs-advanced-search' ),
			array(
				'description' => __( 'Use this widget to show advanced search in the sidebar.', 'rs-advanced-search' ),
			)
		);

	}

	/**
	 * Back-end widget form.
	 */
	function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = '';
		}

		?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'rs-advanced-search' ); ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
			</p>

		<?php

	}

	/**
	 * Front-end display of widget.
	 */
	function widget( $args, $instance ) {

		$cache = wp_cache_get( $this->plugin_name, 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->plugin_name;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			return print $cache[ $args['widget_id'] ];
		}

		extract( $args, EXTR_SKIP );

		$widget_string = $before_widget;

		ob_start();

		include( plugin_dir_path( __FILE__ ) . 'partials/rs-advanced-search-display-widget.php' );

		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;

		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->plugin_name, $cache, 'widget' );

		print $widget_string;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;

	}

}