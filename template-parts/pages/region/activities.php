<?php
/**
 * Activities in the Region Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>

<section id="activities-section" class="activities-section bg-white">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12 bg-cream pt-12 md:pt-5 xl:pt-12 mb-20 -md:mb-24">

        <!-- Swiper container -->
        <div class="activities-swiper swiper w-full">
          <div class="swiper-wrapper">
            <?php if ( have_rows('activities_repeater') ) : ?>
              <?php while ( have_rows('activities_repeater') ) : the_row();
                $title  = get_sub_field('title');
                $text   = get_sub_field('text');
                $image  = get_sub_field('image');
                $button = get_sub_field('button');
                $img_2_id = is_array($image) ? ($image['ID'] ?? null) : $image;
              ?>

                <!-- Slide -->
                <div class="swiper-slide">
                  <div class="theme-grid">
                    <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12">
                      <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-x-5 xl:gap-x-7 gap-y-6 md:gap-y-8">

                        <!-- Image column -->
                        <div class="col-span-2 md:col-span-3 xl:col-start-2 xl:col-span-5 mb-8 xl:mb-14">
                          <?php if ( $img_2_id ) : ?>
                            <div class="w-full overflow-hidden min-h-[400px] md:min-h-[436px] xl:min-h-0 xl:max-h-[350px]">
                              <?php
                                if ( $img_2_id ) :
                                echo wp_get_attachment_image( $img_2_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) );
                                endif;
                                ?>
                            </div>
                          <?php endif; ?>
                        </div>

                        <!-- Text column -->
                        <div class="col-span-2 md:col-span-3 xl:col-span-5">
                          <?php if ( $title ) : ?>
                            <h3 class="title-small text-darker md:!text-[26px] xl:!text-[36px]">
                              <?php echo $title; ?>
                            </h3>
                          <?php endif; ?>

                          <?php if ( $text ) : ?>
                            <p class="body text-darker max-w-[335px] xl:max-w-none pt-5 xl:pt-8">
                              <?php echo $text; ?>
                            </p>
                          <?php endif; ?>

                          <?php if ( $button ) :
                            $link_url    = $button['url'];
                            $link_title  = $button['title'];
                            $link_target = $button['target'] ? $button['target'] : '_self';
                          ?>
                            <a class="btn btn-primary max-w-56 mt-8" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                              <?php echo $link_title; ?>
                            </a>
                          <?php endif; ?>

                          <!-- Controls (inside slide; duplicates per slide are OK with your JS binding approach) -->
                          <div class="activities-controls relative z-20 flex gap-8 pt-10 mb-8 pl-56">
                            <button type="button" class="activities-prev flex items-center justify-center w-[33px] h-[33px]" aria-label="Previous slide">
                              <svg viewBox="0 0 48 48" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor" />
                                <path d="M28 16L20 24L28 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" />
                              </svg>
                            </button>

                            <button type="button" class="activities-next flex items-center justify-center w-[33px] h-[33px]" aria-label="Next slide">
                              <svg viewBox="0 0 48 48" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor" />
                                <path d="M20 16L28 24L20 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" />
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

          </div><!-- /.swiper-wrapper -->
        </div><!-- /.activities-swiper -->

      </div>
    </div>
  </div>
</section>