<?php
/**
 * Theme helpers: printing text fields and reading module fields.
 *
 * New sections use these; the older templates still print fields directly
 * and are moved over when they are touched.
 *
 * @package grand-hotel-europe
 * @subpackage Helpers
 * @since 1.1.0
 */

if ( ! function_exists( 'ghe_text_allowed_html' ) ) :
	/**
	 * Returns the inline HTML an editor may type in a text field: line
	 * breaks (with a class, for breakpoint-only breaks), emphasis, spans
	 * and links.
	 *
	 * @since 1.1.0
	 *
	 * @return array Allowed tags and attributes, in wp_kses() format.
	 */
	function ghe_text_allowed_html() {
		$allowed = array(
			'br'     => array( 'class' => true ),
			'strong' => array(),
			'b'      => array(),
			'em'     => array(),
			'i'      => array(),
			'span'   => array( 'class' => true ),
			'sup'    => array(),
			'sub'    => array(),
			'a'      => array(
				'href'   => true,
				'target' => true,
				'rel'    => true,
				'class'  => true,
			),
		);

		/**
		 * Filters the inline HTML allowed in text fields.
		 *
		 * @since 1.1.0
		 *
		 * @param array $allowed Allowed tags and attributes.
		 */
		return apply_filters( 'ghe_text_allowed_html', $allowed );
	}
endif;

if ( ! function_exists( 'ghe_text' ) ) :
	/**
	 * Returns a text field's value ready to print: the inline HTML of
	 * ghe_text_allowed_html() kept, anything else stripped.
	 *
	 * Use it in place of esc_html() for content typed in the admin (text and
	 * textarea fields, repeater sub-fields, titles and excerpts). Theme
	 * strings, menu labels and values built in code keep esc_html().
	 *
	 * @since 1.1.0
	 *
	 * @param mixed $value The field value.
	 * @return string Safe HTML.
	 */
	function ghe_text( $value ) {
		if ( ! is_scalar( $value ) ) {
			return '';
		}

		return wp_kses( (string) $value, ghe_text_allowed_html() );
	}
endif;

if ( ! function_exists( 'ghe_module_field' ) ) :
	/**
	 * Reads a module field, wherever the module's fields live.
	 *
	 * A module is either cloned straight into a page's field group (read with
	 * get_field()) or used as a layout of a Flexible Content field (read with
	 * get_sub_field(), from inside the have_rows() loop). The page template
	 * says which by passing 'row' => true in the module's $args.
	 *
	 *     $foo_title = ghe_module_field( 'section_foo_title', $args );
	 *
	 * @since 1.1.0
	 *
	 * @param string $name Field name, without the clone prefix.
	 * @param array  $args The module's $args: 'row' (bool), 'prefix' (string), 'post_id' (int|string).
	 * @return mixed The formatted field value, or null when ACF is inactive.
	 */
	function ghe_module_field( $name, $args = array() ) {
		if ( ! function_exists( 'get_field' ) ) {
			return null;
		}

		$args   = is_array( $args ) ? $args : array();
		$prefix = ! empty( $args['prefix'] ) ? $args['prefix'] : '';

		if ( ! empty( $args['row'] ) ) {
			return get_sub_field( $prefix . $name );
		}

		$ctx = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
		return get_field( $prefix . $name, $ctx );
	}
endif;
