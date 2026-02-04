<?php
/**
 *
 * Template Name: Das Hotel Template
 *
 * @package grand-hotel-europe
 * @subpackage Template
 * @since 1.0.0
 */

get_header();
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		do_action( 'before_main_content' );
			get_template_part( 'template-parts/modules/section-hero' );
            get_template_part( 'template-parts/pages/hotel/intro' );
            get_template_part( 'template-parts/pages/hotel/philosophy' );
            get_template_part( 'template-parts/pages/hotel/history' );
            get_template_part( 'template-parts/pages/hotel/testimonials' );
            get_template_part( 'template-parts/modules/section-outro' );
		do_action( 'after_main_content' );
	endwhile;
endif;
get_footer();
