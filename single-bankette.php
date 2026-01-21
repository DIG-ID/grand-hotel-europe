<?php
/**
 * The Archive Template for the Single Post Type Bankette
 *
 * @package grand-hotel-europe
 * @subpackage Template
 * @since 1.0.0
 */


get_header();
	do_action( 'before_main_content' );
			get_template_part( 'template-parts/modules/section-hero' );
			get_template_part( 'template-parts/posts/bankette-seminare/content' );
			get_template_part( 'template-parts/modules/section-outro' );
	do_action( 'after_main_content' );
get_footer();

?>