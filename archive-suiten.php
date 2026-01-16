<?php
/**
 * The Archive Template for the Custom Post Type Suiten.
 *
 * @package ambassador-zermatt
 * @subpackage Template
 * @since 1.0.0
 */

get_header();
	do_action( 'before_main_content' );
			set_query_var('hero_options_prefix', 'suiten');
			get_template_part( 'template-parts/modules/hero' );
			set_query_var('options_prefix', 'suiten');
			get_template_part( 'template-parts/modules/section-intro' );
			get_template_part( 'template-parts/archives/suiten/content' );
			set_query_var('outro_options_prefix', 'suiten');
			get_template_part( 'template-parts/modules/section-outro' );
	do_action( 'after_main_content' );
get_footer();