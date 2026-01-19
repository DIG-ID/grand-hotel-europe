<?php
/**
 * Discover in the Region Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="discover-section" class="discover-section bg-white">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12 bg-cream pt-12 md:pt-5 xl:pt-12 mb-20 -md:mb-24">

                <div class="discover-swiper swiper w-full">
                    <div class="swiper-wrapper">
                    <?php if (have_rows('discover')) : ?>
                    <?php while (have_rows('discover')) : the_row(); ?>
                        <?php if (have_rows('repeater')) : ?>
                        <?php while (have_rows('repeater')) : the_row();
                            $title  = get_sub_field('title');
                            $text   = get_sub_field('text');
                            $image  = get_sub_field('image');
                            $img_id = is_array($image) ? ($image['ID'] ?? null) : $image;
                        ?>

                        <div class="swiper-slide">
                            <div class="theme-grid">
                            <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12">
                                <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-x-5 xl:gap-x-7 gap-y-6 md:gap-y-8">

                                <div class="col-span-2 md:col-span-3 xl:col-start-2 xl:col-span-5 mb-8 xl:mb-14">
                                    <?php if ($img_id) : ?>
                                    <div class="w-full overflow-hidden min-h-[400px] md:min-h-[436px] xl:min-h-0 xl:max-h-[350px]">
                                        <?php
                                        echo wp_get_attachment_image(
                                            $img_id,
                                            'full',
                                            false,
                                            [
                                            'class'    => 'w-full h-full object-cover',
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                            ]
                                        );
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-span-2 md:col-span-3 xl:col-span-5">
                                    <?php if ($title) : ?>
                                    <h3 class="title-small text-darker md:!text-[26px] xl:!text-[36px]"><?php echo esc_html($title); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($text) : ?>
                                    <p class="body text-darker max-w-[335px] xl:max-w-none pt-5 xl:pt-8"><?php echo esc_html($text); ?></p>
                                    <?php endif; ?>

                                    <div class="testimonials-controls flex gap-8 pt-10 mb-8 pl-56">
                                        <button type="button" class="activities-prev flex items-center justify-center w-[33px] h-[33px]" aria-label="Previous slide">
                                            <svg viewBox="0 0 48 48" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor"/>
                                            <path d="M28 16L20 24L28 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"/>
                                            </svg>
                                        </button>

                                        <button type="button" class="activities-next flex items-center justify-center w-[33px] h-[33px]" aria-label="Next slide">
                                            <svg viewBox="0 0 48 48" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor"/>
                                            <path d="M20 16L28 24L20 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                </div>
                            </div>
                            </div>
                        </div>

                        <?php endwhile; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                </div>

            </div>
        </div>
</section>