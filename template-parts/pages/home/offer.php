<?php
/**
 * Offer section (e.g. Weihnachtsangebot) in the Home Page Template.
 *
 * Two columns: media (left) and content (right). The heading sits above the
 * image on tablet and above the text on mobile and desktop, so it is printed
 * in both columns and shown per breakpoint.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.1.0
 */

$offer_show      = get_field( 'section_offer_show' );
$offer_overtitle = get_field( 'section_offer_overtitle' );
$offer_title     = get_field( 'section_offer_title' );
$offer_text      = get_field( 'section_offer_text' );
$offer_button    = get_field( 'section_offer_button' );
$offer_image_id  = get_field( 'section_offer_image' );

if ( ! $offer_show || ( ! $offer_title && ! $offer_text ) ) {
	return;
}

ob_start();
if ( $offer_overtitle ) :
	?>
	<p class="overtitle mb-5"><?php echo ghe_text( $offer_overtitle ); ?></p>
	<?php
endif;
if ( $offer_title ) :
	?>
	<h2 class="title-secondary mb-5"><?php echo ghe_text( $offer_title ); ?></h2>
	<?php
endif;
$offer_heading = ob_get_clean();
?>

<section id="section-offer" class="section-offer pt-[42px] pb-[46px] md:pt-[62px] md:pb-[70px] xl:pt-0 xl:pb-[148px]">
	<div class="theme-container">
		<div class="theme-grid text-dark-2">

			<?php if ( $offer_image_id ) : ?>
				<?php // Desktop: the column stretches with the text column; pb = button (60px) + its margin (20px), so the image ends with the text. ?>
				<div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-5 order-2 md:order-1 mt-10 md:mt-0 xl:pb-[80px]">
					<div class="hidden md:block xl:hidden"><?php echo $offer_heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above with ghe_text(). ?></div>

					<figure class="section-offer__media framed__symmetric--bottom-left w-full aspect-[484/868] xl:aspect-auto xl:h-full">
						<?php echo wp_get_attachment_image( $offer_image_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
					</figure>
				</div>
			<?php endif; ?>

			<div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-7 xl:col-span-6 order-1 md:order-2 md:pt-[39px] xl:pt-[206px]">
				<div class="md:hidden xl:block"><?php echo $offer_heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above with ghe_text(). ?></div>

				<?php if ( $offer_text ) : ?>
					<div class="section-offer__text"><?php echo wp_kses_post( $offer_text ); ?></div>
				<?php endif; ?>

				<?php
				if ( is_array( $offer_button ) && ! empty( $offer_button['url'] ) ) :
					$offer_target = ! empty( $offer_button['target'] ) ? $offer_button['target'] : '';
					?>
					<a class="btn btn-transparent max-w-56 mt-5" href="<?php echo esc_url( $offer_button['url'] ); ?>"<?php echo '_blank' === $offer_target ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $offer_button['title'] ); ?></a>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
