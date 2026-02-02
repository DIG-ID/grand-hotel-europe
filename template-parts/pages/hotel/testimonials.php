<?php
/**
 * Testimonials Section in the Das Hotel Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="testimonials-section" class="testimonials-section bg-white pt-20 md:pt-24 xl:pt-36 pb-20 md:pb-24 xl:pb-32">
  <div class="theme-container">
    <div class="theme-grid">

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-1 xl:col-span-4 pb-7 md:pb-5 xl:pb-12">
        <h2 class="title-secondary text-darker"><?php the_field('testimonials_title'); ?></h2>
      </div>

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-1 xl:col-span-12">
        <div class="testimonials-swiper swiper w-full">
          <div class="swiper-wrapper">
            <?php if ( have_rows('testimonials_repeater') ) : ?>
              <?php while ( have_rows('testimonials_repeater') ) : the_row();
                $name    = get_sub_field('name');
                $text    = get_sub_field('text');
                $website = get_sub_field('website');
              ?>
                <div class="swiper-slide h-auto">
                  <div class="bg-cream min-h-44 md:min-h-48 gap-x-5 h-full">
                    <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-1 xl:col-span-5 pt-5 md:pt-8 xl:pt-5 xl:pl-9 xl:pr-10 min-h-[270px]">
                      <?php if ($name) : ?>
                        <h3 class="title-small text-darker pl-7 md:pl-9 xl:pl-0"><?php echo $name; ?></h3>
                      <?php endif; ?>

                      <?php if ($text) : ?>
                        <p class="body text-darker !text-[15px] min-h-[100px] pt-12  pl-7 md:pl-9 xl:pl-0 max-w-[320px] md:max-w-[400px] xl:max-w-none "><?php echo $text; ?></p>
                      <?php endif; ?>

                      <?php if ($website) : ?>
                        <p class="body text-darker pt-4 pb-3  pl-7 md:pl-9 xl:pl-0"><?php echo $website; ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <div class="testimonials-controls">
            <button type="button" class="testimonials-prev swiper-button-prev" aria-label="Previous testimonial">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor"/>
                <path d="M28 16L20 24L28 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"/>
                </svg>
            </button>

            <button type="button" class="testimonials-next swiper-button-next" aria-label="Next testimonial">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="47" height="47" stroke="currentColor"/>
                <path d="M20 16L28 24L20 32" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"/>
                </svg>
            </button>
            </div>
        
        </div>
      </div>

    </div>
  </div>
</section>