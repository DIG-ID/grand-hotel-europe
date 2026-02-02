<?php
/**
 * Discover in the Region Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="discover-intro-section" class="discover-intro-section bg-white pb-8 md:pb-5 xl:pb-12">
  <div class=" w-[128px] md:w-[420px] xl:w-[690px] h-[1px] xl:h-[1px] bg-gold mx-auto" aria-hidden="true"></div>
  <div class="theme-container">
    <div class="theme-grid pt-20 md:pt-24 xl:pt-36 ">
      <div class="col-start-1 col-span-2 md:col-span-3 xl:col-start-1 xl:col-span-6">
         <h2 class="overtitle text-dark pb-2 md:pb-5"><?php echo get_field('discover_overtitle');?></h2>
         <h3 class="title-secondary text-dark xl:max-w-none"><?php echo get_field('discover_title');?></h3>
      </div>
      <div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-7 xl:col-span-6 pt-5 md:pt-10 xl:pt-9">
        <h3 class="text-dark"><?php echo get_field('discover_text');?></p>
      </div>
    </div>
  </div>
</section>
<section id="discover-section" class="discover-section bg-cream xl:bg-white">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12 bg-cream pt-8 xl:pt-12 ">

        <!-- Swiper container -->
        <div class="discover-swiper swiper w-full">
          <div class="swiper-wrapper">

            <?php if ( have_rows('discover_repeater') ) : ?>
              <?php while ( have_rows('discover_repeater') ) : the_row();
                $title  = get_sub_field('title');
                $text   = get_sub_field('text');
                $image  = get_sub_field('image');
                $img_id = is_array($image) ? ($image['ID'] ?? null) : $image;
              ?>

                <!-- Slide -->
                <div class="swiper-slide">
                  <div class="theme-grid">
                    <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12">
                      <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-x-5 xl:gap-x-7 gap-y-6 md:gap-y-8">

                        <!-- Image column -->
                        <div class="col-span-2 md:col-span-3 xl:col-start-2 xl:col-span-5 mb-8 xl:mb-14 order-2 md:order-none">
                          <?php if ( $img_id ) : ?>
                            <div class="w-full overflow-hidden">
                              <?php
                                if ( $img_id ) :
                                echo wp_get_attachment_image( $img_id, 'full', false, array( 'class' => 'w-full h-[400px] md:h-[436px] xl:h-[350px] object-cover' ) );
                                endif;
                                ?>
                            </div>
                          <?php endif; ?>
                        </div>

                        <!-- Text column -->
                        <div class="col-span-2 md:col-span-3 xl:col-span-5 ">
                          <?php if ( $title ) : ?>
                            <h3 class="title-small text-darker md:!text-[26px] xl:!text-[36px]">
                              <?php echo $title; ?>
                            </h3>
                          <?php endif; ?>

                          <?php if ( $text ) : ?>
                            <p class="text-darker max-w-[335px] xl:max-w-none pt-5 xl:pt-8 ">
                              <?php echo $text; ?>
                            </p>
                          <?php endif; ?>

                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                
                <?php endwhile; ?>
                <?php endif; ?>
                
              </div><!-- /.swiper-wrapper -->
            </div><!-- /.discover-swiper -->

            <div class="discover-controls relative z-20 flex gap-8 xl:pt-10 mb-8 pl-[140px] md:pl-[385px] xl:pl-[789px] ">
              <button type="button" class="discover-prev flex items-center justify-center w-[33px] h-[33px]" aria-label="Previous slide">
                <svg viewBox="0 0 48 48" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor" />
                  <path d="M28 16L20 24L28 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" />
                </svg>
              </button>

              <button type="button" class="discover-next flex items-center justify-end w-[33px] h-[33px]" aria-label="Next slide">
                <svg viewBox="0 0 48 48" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor" />
                  <path d="M20 16L28 24L20 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" />
                </svg>
              </button>
            </div>

      </div>
    </div>
  </div>
</section>