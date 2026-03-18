<?php
/**
 * Content Section in the jobs Archive Template.
 *
 * Loop trough Custom Post Type Jobs.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

$general_query = new WP_Query([
	'post_type'      => 'jobs',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
]);
?>
<section id="jobs-overview" class="jobs-overview mb-20 md:mb-28 xl:mb-36">
	<div class="theme-container theme-grid">
		<?php if ( $general_query->have_posts() ) : ?>
			<?php $i = 0; ?>
			<?php while ( $general_query->have_posts() ) : $general_query->the_post(); ?>
				<article class="col-span-2 md:col-span-6 xl:col-span-12 theme-grid bg-cream py-9 md:py-8 xl:py-16 mb-5 xl:mb-8 last-of-type:mb-0 gap-y-8 px-6 md:px-0">
					<div class="col-span-2 md:col-span-4 md:col-start-2 xl:col-span-3 xl:col-start-2">
						<h2>
							<a href="<?php the_permalink(); ?>" class="title-small text-dark-2"><?php the_title(); ?></a>
						</h2>
					</div>
					<div class="col-span-2 md:col-span-2 md:col-start-2 xl:col-span-3 xl:col-start-7">
						<a href="<?php the_permalink(); ?>" class="btn btn-primary max-w-56"><?php esc_html_e( 'Stelle Anzeigen', 'grand-hotel-europe' ) ?></a>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="col-span-2 md:col-span-6 xl:col-span-12 ">
				<div class="flex justify-center items-center bg-cream py-9 md:py-8 xl:py-16 mb-5 xl:mb-8 gap-8 px-6 border border-gold">
					<div class="w-6 h-6 xl:w-8 xl:h-8 flex items-center justify-center">
						<svg class="w-6 h-6 xl:w-8 xl:h-8" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M13.5 7.5H16.5V10.5H13.5V7.5ZM13.5 13.5H16.5V22.5H13.5V13.5ZM15 0C6.72 0 0 6.72 0 15C0 23.28 6.72 30 15 30C23.28 30 30 23.28 30 15C30 6.72 23.28 0 15 0ZM15 27C8.385 27 3 21.615 3 15C3 8.385 8.385 3 15 3C21.615 3 27 8.385 27 15C27 21.615 21.615 27 15 27Z" fill="#A7986E"/>
						</svg>
					</div>


					<p><?php esc_html_e( 'Derzeit haben wir keine offenen Positionen zu besetzen. Wir freuen uns, wenn Sie zu einem späteren Zeitpunkt wieder vorbeischauen.', 'grand-hotel-europe' ) ?></p>
				</div>
				
			</div>
		<?php endif; ?>
	</div>
</section>