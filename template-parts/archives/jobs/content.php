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
				<p><?php esc_html_e( 'Derzeit haben wir keine offenen Positionen zu besetzen. Wir freuen uns, wenn Sie zu einem späteren Zeitpunkt wieder vorbeischauen.', 'grand-hotel-europe' ) ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>