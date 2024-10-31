<?php

if ( ! empty( $instance['title'] ) ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
}

if ( ! empty( $title ) ) {
	echo $before_title . $title . $after_title;
}

$options = get_option( $this->plugin_name . '-settings' );
$input = 0;
$taxonomies = array();

if ( ! empty( $options['toggle-search-input'] ) ) {
	$input = $options['toggle-search-input'];
}
if ( ! empty( $options['taxonomy'] ) ) {
	$taxonomies = $options['taxonomy'];
}

$form = '<form role="search" class="search-form rs-advanced-search-form rs-advanced-search-shortcode" method="get" action="' . home_url( '/' ) . '">';
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

echo $form;