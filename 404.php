<?php
get_header();
do_action( 'before_main_content' );
?>
<section class="page-header pt-36 md:pt-56 xl:pt-80 pb-32 md:pb-36 xl:pb-28 bg-dark">
	<div class="theme-container flex flex-col w-full text-center">
		<h1 class="font-source text-[110px] md:text-[150px] xl:text-[200px] leading-10 md:leading-[60px] uppercase text-white"><?php esc_html_e( '404', 'grand-hotel-europe' ); ?></h1>
		<h2 class="font-source text-[50px] md:text-[60px] leading-[50px] md:leading-[60px] uppercase text-white pt-20 font-normal"><?php esc_html_e( 'Nicht gefunden', 'grand-hotel-europe' ); ?></h2>
	</div>
</section>
<section class="section-error-404 not-found pt-16 md:pt-[71px] xl:pt-24 pb-24 xl:pb-20 bg-gold">
<div class="theme-container">
		<div class="theme-grid">
			<div class ="col-start-1 col-span-2 md:col-span-3 xl:col-span-4">
				<h2 class="title-secondary font-gilda text-white"><?php esc_html_e( 'Es sieht so aus, als hätten Sie sich verlaufen.', 'grand-hotel-europe' ); ?></h2>
			</div>
			<div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-7 xl:col-span-6">
				<p class="body font-barlow text-white mb-8 xl:mb-10 md:max-w-56 xl:max-w-none"><?php esc_html_e( 'Die von Ihnen angeforderte Seite existiert nicht mehr oder hat nie unter dieser Adresse existiert.', 'grand-hotel-europe' ); ?></p>
				<a class="btn btn-secondary max-w-[247px]" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'zurück zur Startseite', 'grand-hotel-europe' ); ?></a>
			</div>
		</div>
	</div>
</section>
<section class="bg-gradient-to-b from-gold from-0% via-gold via-50% to-dark-2 to-50%">
<?php do_action (get_template_part( 'template-parts/modules/section-outro' ));?>
</section>
<?php
do_action( 'after_main_content' );
get_footer();
