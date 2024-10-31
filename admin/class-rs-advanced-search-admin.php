<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Advanced_Search
 * @subpackage RS_Advanced_Search/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    RS_Advanced_Search
 * @subpackage RS_Advanced_Search/admin
 * @author     Ratko Solaja <me@ratkosolaja.info>
 */
class RS_Advanced_Search_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'tools_page_rs-advanced-search' != $hook ) {
			return;
		}
		

		wp_enqueue_style( $this->plugin_name . '-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,500italic,300&subset=latin,latin-ext', array(), '', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rs-advanced-search-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'tools_page_rs-advanced-search' != $hook ) {
			return;
		}

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rs-advanced-search-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_admin_page() {

		// add_submenu_page ( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
		add_submenu_page(
			'tools.php',
			__( 'RS Advanced Search', 'rs-advanced-search' ),
			__( 'RS Advanced Search', 'rs-advanced-search' ),
			'manage_options',
			'rs-advanced-search',
			array( $this, 'display_admin_page' )
		);

	}

	/**
	 * Display the page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function display_admin_page() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rs-advanced-search-admin-display.php';

	}

	/**
	 * Settings callbacks.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_setting_callback( $input ) {

		$new_input = array();

		if ( isset( $input ) ) {
			foreach ( $input as $key => $value ) {
				if ( $key == 'taxonomy' ) {
					$new_input[ $key ] = $value;
				} else {
					$new_input[ $key ] = sanitize_text_field( $value );
				}
			}
		}

		return $new_input;

	}

	/**
	 * Register settings.
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		// Settings
		register_setting(
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings',
			array( $this, 'sandbox_setting_callback' )
		);

		// Section
		add_settings_section(
			$this->plugin_name . '-settings-section',
			__( 'Settings', 'rs-advanced-search' ),
			array( $this, 'sandbox_settings_section_callback' ),
			$this->plugin_name . '-settings'
		);

		// Fields
		add_settings_field(
			'toggle-search-override',
			__( 'Do you want us to override your search form:', 'rs-advanced-search' ),
			array( $this, 'sandbox_toggle_search_override_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section',
			array(
				'label_for' => $this->plugin_name . '-settings[toggle-search-override]'
			)
		);
		add_settings_field(
			'taxonomy',
			__( 'User can search inside these taxonomies:', 'rs-advanced-search' ),
			array( $this, 'sandbox_taxonomy_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'toggle-css',
			__( 'Do you want to use our styling for Advanced Search in Shortcode and Widget:', 'rs-advanced-search' ),
			array( $this, 'sandbox_toggle_css_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'toggle-relation',
			__( 'Do you want to use "AND" or "OR" relation:', 'rs-advanced-search' ),
			array( $this, 'sandbox_toggle_relation_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'toggle-search-input',
			__( 'Do you want to disable search input field:', 'rs-advanced-search' ),
			array( $this, 'sandbox_toggle_search_input_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section',
			array(
				'label_for' => $this->plugin_name . '-settings[toggle-search-input]'
			)
		);
		add_settings_field(
			'toggle-select2',
			__( 'Do you want to enable select2:', 'rs-advanced-search' ),
			array( $this, 'sandbox_toggle_select2_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section',
			array(
				'label_for' => $this->plugin_name . '-settings[toggle-select2]'
			)
		);

	}

	/**
	 * Section callbacks.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_settings_section_callback() {

		return;

	}

	/**
	 * Field callbacks.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_toggle_search_override_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-search-override'] ) ) {
			$option = $options['toggle-search-override'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-search-override]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-search-override]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	public function sandbox_taxonomy_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = array();

		if ( ! empty( $options['taxonomy'] ) ) {
			$option = $options['taxonomy'];
		}

		$taxonomies = get_taxonomies( '', 'objects' );

		if ( ! empty( $taxonomies ) && ! is_wp_error( $taxonomies ) ) {
			foreach ( $taxonomies as $tax ) {
				if ( $tax->name != 'nav_menu' && $tax->name != 'link_category' && $tax->name != 'post_format' && $tax->name != 'post_tag' ) {
					
					$checked = in_array( $tax->name, $option ) ? 'checked="checked"' : '';

					?>

						<div class="rs-input-row">
							<input type="checkbox" name="<?php echo $this->plugin_name; ?>-settings[taxonomy][]" id="<?php echo $this->plugin_name; ?>-settings[taxonomy]" value="<?php echo esc_attr( $tax->name ); ?>" <?php echo $checked; ?> />
							<span class="rs-input-label"><?php echo esc_html( $tax->name ); ?></span>
						</div>

					<?php
				}
			}
		}

	}

	public function sandbox_toggle_css_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-css'] ) ) {
			$option = $options['toggle-css'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-css]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-css]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	public function sandbox_toggle_relation_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 'OR';

		if ( ! empty( $options['toggle-relation'] ) ) {
			$option = $options['toggle-relation'];
		}

		$html = '<div class="rs-input-row">';
		$html .= '<input type="radio" id="' . $this->plugin_name . '-settings' . '-one" name="' . $this->plugin_name . '-settings' . '[toggle-relation]" value="AND" ' . checked( 'AND', $option, false ) . ' />';
		$html .= '<span class="rs-input-label">' . __( 'AND', 'rs-advanced-search' ) . '</span>';
		$html .= '</div>';

		$html .= '<div class="rs-input-row">';
		$html .= '<input type="radio" id="' . $this->plugin_name . '-settings' . '-two" name="' . $this->plugin_name . '-settings' . '[toggle-relation]" value="OR" ' . checked( 'OR', $option, false ) . ' />';
		$html .= '<span class="rs-input-label">' . __( 'OR', 'rs-advanced-search' ) . '</span>';
		$html .= '</div>';

		echo $html;

	}

	public function sandbox_toggle_search_input_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-search-input'] ) ) {
			$option = $options['toggle-search-input'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-search-input]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-search-input]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	public function sandbox_toggle_select2_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-select2'] ) ) {
			$option = $options['toggle-select2'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-select2]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-select2]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	/**
	 * Override search form with custom search form.
	 *
	 * @since    1.0.0
	 */
	public function override_search_form( $form ) {

		$options = get_option( $this->plugin_name . '-settings' );
		$toggle = 0;
		$input = 0;
		$taxonomies = array();

		if ( ! empty( $options['toggle-search-override'] ) ) {
			$toggle = $options['toggle-search-override'];
		}
		if ( ! empty( $options['toggle-search-input'] ) ) {
			$input = $options['toggle-search-input'];
		}
		if ( ! empty( $options['taxonomy'] ) ) {
			$taxonomies = $options['taxonomy'];
		}

		if ( $toggle == 1 ) {
			$form = '<form role="search" class="search-form rs-advanced-search-form" method="get" action="' . home_url( '/' ) . '">';
			$input_class = '';
			if ( $input == 1 ) {
				$input_class = 'search-field-hide';
			}
			$form .= '<input type="search" class="search-field ' . esc_attr( $input_class ) . '" placeholder="' . esc_attr_x( 'Search...', 'placeholder', 'rs-advanced-search' ) . '" name="s" />';
			if ( ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $tax ) {
					$terms = get_terms( array( 'taxonomy' => $tax, 'hide_empty' => false ) );
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						$tax_add = get_taxonomy( $tax );
						$menu_name = $tax_add->labels->name;
						$form .= '<div class="rs-advanced-search-inline-select">';
							$form .= '<select id="select-' . $tax . '" name="select-' . $tax . '">';
								$form .= '<option value="all">' . esc_html( $menu_name, 'rs-advanced-search' ) . '</option>';
								foreach ( $terms as $term ) {
									$form .= '<option value="' . esc_attr( $term->term_id ) . '">' . esc_html( $term->name ) . '</option>';
								}
							$form .= '</select>';
						$form .= '</div>';
					}
				}
			}
			$form .= '<input type="submit" class="search-submit-input" value="' . esc_attr_x( 'Submit', 'submit button', 'rs-advanced-search' ) . '" />';
			$form .= '</form>';

			return $form;
		} else {
			return;
		}

	}

}