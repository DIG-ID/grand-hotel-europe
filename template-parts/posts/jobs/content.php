<?php
/**
 * Content Section in the Jobs Single Posts Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<section id="jobs-content" class="jobs-content relative overflow-hidden">
	<div class="theme-container">
		<div class="theme-grid pt-12 md:pt-24 xl:pt-16 pb-20 xl:pb-36">
			<div class="col-span-2 md:col-span-4 xl:col-span-7">
				<div class="jobs-content--wrapper">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col-span-2 md:col-span-6 xl:col-span-4 xl:col-start-9">
					<div class="jobs-sidebar bg-cream px-5 md:px-5 xl:px-16 py-5 md:py-9 xl:pt-12 xl:pb-16">
						<h4 class="title-smaller text-dark-2 pb-5"><?php the_field( 'jobs_extras_sidebar_title', 'options' ); ?></h4>
						<p><?php the_field( 'jobs_extras_sidebar_description', 'options' ); ?></p>
			
						<p class="text-base md:order-3 mt-10"><?php the_field( 'address', 'options' ); ?></p>
						<div class="flex flex-col">
							<a class="text-base translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1 md:order-2" href="mailto:<?php the_field( 'contacts_email', 'options' ); ?>"><?php the_field( 'contacts_email', 'options' ); ?></a>
							<a class="text-base translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1" href="tel:<?php the_field( 'contacts_telephone', 'options' ); ?>"><?php esc_html_e( 'Tel: ', 'grand-hotel-europe' ); ?><?php the_field( 'contacts_telephone', 'options' ); ?></a>
							<a class="text-base translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1" href="tel:<?php the_field( 'contacts_fax', 'options' ); ?>"><?php esc_html_e( 'Fax: ', 'grand-hotel-europe' ); ?><?php the_field( 'contacts_fax', 'options' ); ?></a>
						</div>

					</div>
			</div>
		</div>
	</div>
</section>