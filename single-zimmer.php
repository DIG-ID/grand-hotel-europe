<?php
/**
 * The Archive Template for the Single Post Type Zimmer
 *
 * @package grand-hotel-europe
 * @subpackage Template
 * @since 1.0.0
 */


get_header();
	do_action( 'before_main_content' );
			get_template_part( 'template-parts/modules/hero' );
			get_template_part( 'template-parts/posts/zimmer-suiten/content' );
			get_template_part( 'template-parts/modules/section-outro' );
	do_action( 'after_main_content' );
get_footer();


?>

