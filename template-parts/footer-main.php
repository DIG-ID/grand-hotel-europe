<?php
/**
 * The Section for the Footer Default Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<footer class="footer-main bg-dark-2 text-cream">
	<div class="theme-container">
		<div class="theme-grid py-16 gap-y-16">
			<div class="col-span-2 md:flex md:flex-col md:justify-between md:h-full self-center md:self-start">
				<div class="site-branding">
					<?php do_action( 'theme_logo' ); ?>
				</div>
				<div class="socials hidden invisible md:block md:visible xl:mb-20">
					<?php do_action( 'socials' ); ?>
				</div>
			</div>

			<div class="footer-menus col-span-2 xl:col-span-4 xl:col-start-5 grid grid-cols-2 xl:grid-cols-4 gap-x-5 xl:gap-x-[30.5px]">
				<?php
				if ( has_nav_menu( 'footer-menu-1' ) ) :
					wp_nav_menu(
						array(
						'theme_location' => 'footer-menu-1',
						'menu_class' => 'footer-menu-1',
						'container_class' => 'footer-menu-container col-span-2',
						)
					);
				else :
					esc_html_e( 'Please assign a menu to the footer-menu-1 location.', 'grand-hotel-europe' );
				endif;
				if ( has_nav_menu( 'footer-menu-2' ) ) :
					wp_nav_menu(
						array(
						'theme_location' => 'footer-menu-2',
						'menu_class' => 'footer-menu-2',
						'container_class' => 'footer-menu-container col-span-2',
						)
					);
				else :
					esc_html_e( 'Please assign a menu to the footer-menu-2 location.', 'grand-hotel-europe' );
				endif;
				?>
			</div>
			<div class="footer-contacts col-span-2 xl:col-start-10">
				<p class="overtitle mb-4 md:mb-8"><?php esc_html_e( 'Kontakt', 'grand-hotel-europe' ); ?></p>
				<div class="flex flex-col">
					<p class="text-base md:order-3 mb-4"><?php the_field( 'address', 'options' ); ?></p>
					<div class="phone flex flex-col md:order-1 md:mb-4 xl:mb-8">
						<a class="text-base translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1" href="tel:<?php the_field( 'contacts_telephone', 'options' ); ?>"><?php esc_html_e( 'Tel: ', 'grand-hotel-europe' ); ?><?php the_field( 'contacts_telephone', 'options' ); ?></a>
						<p class="text-base"><?php esc_html_e( 'Fax: ', 'grand-hotel-europe' ); ?><?php the_field( 'contacts_fax', 'options' ); ?></p>
					</div>
					<a class="text-base translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1 md:order-2 mb-4 xl:mb-8" href="mailto:<?php the_field( 'contacts_email', 'options' ); ?>"><?php the_field( 'contacts_email', 'options' ); ?></a>
				</div>

				
			</div>
			<div class="socials col-span-2 flex justify-center items-center md:hidden md:invisible">
				<?php do_action( 'socials' ); ?>
			</div>
		</div>
		<div class="copy-footer bg-dark flex flex-col md:flex-row md:items-center md:justify-between px-5 py-4">
			<div class="text-center md:text-left text-cream text-xs md:text-sm xl:text-base order-2 md:order-1">
				&copy; <?php echo date( 'Y' ); ?> <?php esc_html_e( 'Alle Rechte vorbehalten.', 'grand-hotel-europe' ); ?>
			</div>
			<div class="menu-copy order-1 md:order-2">
				<?php
				if ( has_nav_menu( 'copyright-menu' ) ) :
					wp_nav_menu(
						array(
						'theme_location' => 'copyright-menu',
						'menu_class' => 'copyright-menu',
						)
					);
				else :
					esc_html_e( 'Please assign a menu to the copyright-menu location.', 'grand-hotel-europe' );
				endif;
				?>
			</div>
		</div>
	</div>
</footer>
