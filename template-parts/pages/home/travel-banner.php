<?php
/**
 * Travel Banner Slider Section in the Home Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>

<section id="section-travel-banner" class="section-travel-banner relative">
  <div class="swiper travel-banner-swiper">
    <div class="swiper-wrapper">
      <?php if ( have_rows('travel_banner') ) : ?>
        <?php while ( have_rows('travel_banner') ) : the_row();
          $bg_id  = get_sub_field('image');
          $bg_url = $bg_id ? wp_get_attachment_image_url($bg_id, 'full') : '';
          $title = get_sub_field('title');
          $dates = get_sub_field('dates');
          $text  = get_sub_field('text');
          $btn   = get_sub_field('button');
        ?>
          <div class="swiper-slide relative bg-cover bg-no-repeat min-h-[600px] md:min-h-[550px] xl:min-h-[600px]" style="<?php echo $bg_url ? 'background-image:url(' . esc_url($bg_url) . ');' : ''; ?>">
            <div class="absolute inset-0 bg-[rgba(34,34,34,0.75)] pointer-events-none z-0" aria-hidden="true"></div>
            <div class="theme-container w-full flex pt-20 pb-32 md:pt-20 md:pb-32 xl:pt-20 xl:pb-32 relative z-10">
              <div class="theme-grid w-full">
                <div class="col-span-2 md:col-span-3 xl:col-span-6">
                  <?php if ($title) : ?>
                    <h2 class="title-secondary text-white mb-16 md:mb-0"><?php echo $title; ?></h2>
                  <?php endif; ?>
                </div>
                <div class="col-span-2 md:col-span-3 xl:col-span-6">
                  <?php if ($dates) : ?>
                    <p class="title-small text-white mb-7 xl:mb-14"><?php echo $dates; ?></p>
                  <?php endif; ?>
                  <?php if ($text) : ?>
                    <div class="text-white mb-7 xl:mb-14">
                      <?php echo $text; ?>
                    </div>
                  <?php endif; ?>
                  <?php if ($btn) :
                    $link_url    = $btn['url'] ?? '';
                    $link_title  = $btn['title'] ?? '';
                    $link_target = !empty($btn['target']) ? $btn['target'] : '_self';
                    if ($link_url && $link_title) :
                  ?>
                    <a class="btn btn-primary max-w-56" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                      <?php echo $link_title; ?>
                    </a>
                  <?php endif; endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <div class="travel-banner-nav-arrows absolute w-full bottom-10 z-10 flex justify-center items-center gap-x-8 h-8">
      <button type="button" class="swiper-button-prev relative left-0 bottom-0 z-10 w-8 h-8 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
          <rect x="32.25" y="32.25" width="31.5" height="31.5" transform="rotate(-180 32.25 32.25)" stroke="#F8F5F0" stroke-width="1.5"/>
          <path d="M21 26L12 16.5L21 7" stroke="#F8F5F0" stroke-width="1.5"/>
        </svg>
      </button>
      <button type="button" class="swiper-button-next relative right-0 bottom-0 z-10 w-8 h-8 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
          <rect x="0.75" y="0.75" width="31.5" height="31.5" stroke="#F8F5F0" stroke-width="1.5"/>
          <path d="M12 7L21 16.5L12 26" stroke="#F8F5F0" stroke-width="1.5"/>
        </svg>
      </button>
    </div>

  </div>
</section>
