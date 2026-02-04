<?php
/**
 * Intro Section in the Das Hotel Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<?php
$intro_gallery = get_field('intro_image');
$intro_over    = get_field('intro_overtitle');
$intro_title   = get_field('intro_title');
$intro_text    = get_field('intro_text');
?>

<section id="section-intro" class="section-intro xl:pt-0 pb-20 md:pb-24 xl:pb-36">

  <div class="w-[128px] md:w-[690px] h-[1px] xl:bg-gold mt-10 md:mt-12 xl:mt-14 mx-auto xl:mb-5" aria-hidden="true"></div>

  <?php if ( ! empty( $intro_gallery ) && is_array( $intro_gallery ) ) : ?>
    <div class="intro-image px-6 md:px-14">
      <figure class="framed__asymmetric--bottom-both w-full h-full md:h-auto">

        <!-- IMPORTANT: set height here to match your original behavior -->
        <div class="intro-swiper swiper w-full h-[300px] md:h-auto overflow-hidden">
          <div class="swiper-wrapper">

            <?php foreach ( $intro_gallery as $img_id ) : ?>
              <div class="swiper-slide"><?php echo wp_get_attachment_image($img_id,'full',false,array('class' => 'w-full !h-full object-cover max-h-[276px] xl:max-h-[712px]'));?></div>
            <?php endforeach; ?>

          </div>
        </div>

      </figure>
    </div>
  <?php endif; ?>

  <div class="theme-container pt-11 md:pt-16">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-6 xl:col-span-12">
        <h2 class="overtitle text-dark-2 mb-4"><?php echo $intro_over; ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <h3 class="title-secondary text-dark-2 mb-5 md:mb-0"><?php echo $intro_title; ?></h3>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <p class="text-dark-2"><?php echo $intro_text; ?></p>
      </div>
    </div>
  </div>

</section>