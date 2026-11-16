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
$offer_video_id  = get_field( 'section_offer_video' );
$offer_video_url = $offer_video_id ? wp_get_attachment_url( $offer_video_id ) : '';

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

			<?php if ( $offer_image_id || $offer_video_url ) : ?>
				<?php // Desktop: the column stretches with the text column; pb = button (60px) + its margin (20px), so the image ends with the text. ?>
				<div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-5 order-2 md:order-1 mt-10 md:mt-0 xl:pb-[80px]">
					<div class="hidden md:block xl:hidden"><?php echo $offer_heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above with ghe_text(). ?></div>

					<figure class="section-offer__media framed__symmetric--bottom-left w-full aspect-[484/868] xl:aspect-auto xl:h-full">
						<?php
						if ( $offer_video_url ) :
							// Click to play: browsers only allow sound on a video started by the visitor.
							$offer_poster = $offer_image_id ? wp_get_attachment_image_url( $offer_image_id, 'full' ) : '';
							$offer_label  = $offer_title ? wp_strip_all_tags( $offer_title ) : __( 'Video', 'grand-hotel-europe' );
							?>
							<div class="section-offer__video relative w-full h-full" data-offer-video>
								<video class="w-full h-full object-cover bg-darker" preload="metadata" playsinline<?php echo $offer_poster ? ' poster="' . esc_url( $offer_poster ) . '"' : ''; ?>>
									<source src="<?php echo esc_url( $offer_video_url ); ?>" type="video/mp4">
								</video>
								<?php // Big play button over the poster; removed by assets/js/offerVideo.js on the first play. ?>
								<button type="button" class="section-offer__play absolute inset-0 flex items-center justify-center w-full h-full" data-offer-start aria-label="<?php echo esc_attr( sprintf( /* translators: %s: section title. */ __( 'Video abspielen: %s', 'grand-hotel-europe' ), $offer_label ) ); ?>">
									<span class="section-offer__play-icon" aria-hidden="true"></span>
								</button>

								<?php // Custom controls (Vimeo-like), the same in every browser. Hidden until the first play. ?>
								<div class="section-offer__controls absolute inset-x-0 bottom-0 flex items-center gap-3 px-4 pt-8 pb-3 text-cream" data-offer-controls hidden>
									<button type="button" class="section-offer__ctrl" data-offer-toggle aria-label="<?php echo esc_attr__( 'Pause', 'grand-hotel-europe' ); ?>" data-label-play="<?php echo esc_attr__( 'Abspielen', 'grand-hotel-europe' ); ?>" data-label-pause="<?php echo esc_attr__( 'Pause', 'grand-hotel-europe' ); ?>">
										<svg class="icon-play" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z" fill="currentColor"/></svg>
										<svg class="icon-pause" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 4h4v16H6zM14 4h4v16h-4z" fill="currentColor"/></svg>
									</button>

									<input type="range" class="section-offer__range section-offer__progress flex-1 min-w-0" data-offer-progress min="0" max="1000" step="1" value="0" aria-label="<?php echo esc_attr__( 'Wiedergabeposition', 'grand-hotel-europe' ); ?>">

									<span class="section-offer__time shrink-0 font-barlow text-sm tabular-nums" data-offer-time>0:00</span>

									<div class="section-offer__volume flex items-center shrink-0">
										<button type="button" class="section-offer__ctrl" data-offer-mute aria-label="<?php echo esc_attr__( 'Ton aus', 'grand-hotel-europe' ); ?>" data-label-mute="<?php echo esc_attr__( 'Ton aus', 'grand-hotel-europe' ); ?>" data-label-unmute="<?php echo esc_attr__( 'Ton an', 'grand-hotel-europe' ); ?>">
											<svg class="icon-volume" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 9v6h4l5 5V4L7 9H3z" fill="currentColor"/><path d="M15.5 8.5a5 5 0 0 1 0 7M18 6a8.5 8.5 0 0 1 0 12" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
											<svg class="icon-muted" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 9v6h4l5 5V4L7 9H3z" fill="currentColor"/><path d="M16 9l5 6M21 9l-5 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
										</button>
										<input type="range" class="section-offer__range section-offer__volume-range" data-offer-volume min="0" max="1" step="0.05" value="1" aria-label="<?php echo esc_attr__( 'Lautstärke', 'grand-hotel-europe' ); ?>">
									</div>

									<button type="button" class="section-offer__ctrl" data-offer-fullscreen aria-label="<?php echo esc_attr__( 'Vollbild', 'grand-hotel-europe' ); ?>">
										<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 9V4h5M15 4h5v5M20 15v5h-5M9 20H4v-5" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
									</button>
								</div>
							</div>
						<?php else : ?>
							<?php echo wp_get_attachment_image( $offer_image_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
						<?php endif; ?>
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
