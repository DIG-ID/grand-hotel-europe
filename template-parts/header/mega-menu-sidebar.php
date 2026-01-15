<div class="panel-right-wrapper text-cream font-barlow">

	<div class="site-branding mb-16">
		<?php do_action( 'theme_logo' ); ?>
	</div>

	<div class="flex flex-col gap-y-9">

		<div class="address flex flex-col gap-y-6">
			<h3 class="overtitle"><?php esc_html_e( 'Adresse', 'grand-hotel-europe' ); ?></h3>
			<p><?php the_field( 'address', 'options' ); ?></p>
		</div>

		<div class="contact flex flex-col gap-y-6">
			<h3 class="overtitle"><?php esc_html_e( 'Kontakt', 'grand-hotel-europe' ); ?></h3>
			<div class="phone flex flex-col">
				<a class="translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1" href="tel:<?php the_field( 'contacts_telephone', 'options' ); ?>"><?php esc_html_e( 'Tel: ', 'grand-hotel-europe' ); ?><?php the_field( 'contacts_telephone', 'options' ); ?></a>
				<a class="translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1" href="tel:<?php the_field( 'contacts_fax', 'options' ); ?>"><?php esc_html_e( 'Fax: ', 'grand-hotel-europe' ); ?><?php the_field( 'contacts_fax', 'options' ); ?></a>
			</div>

			<a class="translate-x-0 transition-all duration-500 ease-in-out hover:text-gold hover:translate-x-1" href="mailto:<?php the_field( 'contacts_email', 'options' ); ?>"><?php the_field( 'contacts_email', 'options' ); ?></a>
			<?php do_action( 'socials' ); ?>
		</div>

		<div class="copyright-menu">
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

		<div class="copyright">
			copyright
		</div>

	</div>

</div>
