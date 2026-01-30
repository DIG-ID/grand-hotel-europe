<?php
/**
 * Gallery Section in the Bankette and seminare Single Posts Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<?php
$gallery_ids = get_field('gallery_images');
if ($gallery_ids && is_array($gallery_ids)) :
?>
  <div class="gallery-images-swiper-col relative col-span-2 md:col-span-6 xl:col-span-12">

    <!-- Main slider -->
    <div class="swiper gallery-images-swiper-bs">
      <div class="swiper-wrapper">
        <?php
        foreach ($gallery_ids as $img_id) :
          echo '<div class="swiper-slide">'. wp_get_attachment_image( $img_id, 'full', false, array( 'class' => 'w-full h-auto max-h-[689px] object-cover', 'sizes' => '(min-width: 1280px) 1170px, 100vw' ) ) . '</div>';
         endforeach;
         ?>
        <?php
        /*
        foreach ($gallery_ids as $img_id) :
          $img_url = wp_get_attachment_image_url($img_id, 'zimmer-suiten-gallery');
          $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
          if (!$img_alt) $img_alt = get_the_title($img_id);
          if (!$img_url) continue;
          ?>
          <div class="swiper-slide">
            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" class="w-full h-auto block object-cover" />
          </div>
          <?php
        endforeach;
        */
        ?>
      </div>
    </div>
  </div>

  <!-- Nav arrows -->
  <div class="bankette-seminare-nav-arrows col-span-2 md:col-span-6 xl:col-span-12 absolute w-full top-1/2 left-0 -translate-y-1/2 z-10">
    <button type="button" class="swiper-button-prev absolute left-10 top-1/2 -translate-y-1/2 z-10 w-8 h-8 flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
        <rect x="32.25" y="32.25" width="31.5" height="31.5" transform="rotate(-180 32.25 32.25)" stroke="#A7986E" stroke-width="1.5"/>
        <path d="M21 26L12 16.5L21 7" stroke="#A7986E" stroke-width="1.5"/>
      </svg>
    </button>
    <button type="button" class="swiper-button-next absolute right-10 top-1/2 -translate-y-1/2 z-10 w-8 h-8 flex items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
        <rect x="0.75" y="0.75" width="31.5" height="31.5" stroke="#A7986E" stroke-width="1.5"/>
        <path d="M12 7L21 16.5L12 26" stroke="#A7986E" stroke-width="1.5"/>
      </svg>
    </button>
  </div>

  <!-- Thumbs -->
  <div class="gallery-images-swiper-col relative col-span-2 md:col-span-6 xl:col-span-12">
    <div class="swiper gallery-thumbs-swiper-bs mt-4">
      <div class="swiper-wrapper justify-center">
        <?php foreach ($gallery_ids as $img_id) :
          $thumb_url = wp_get_attachment_image_url($img_id, 'thumbnail');
          $thumb_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
          if (!$thumb_alt) $thumb_alt = get_the_title($img_id);
          if (!$thumb_url) continue;
        ?>
          <div class="swiper-slide !w-36 !h-20 cursor-pointer opacity-100">
            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($thumb_alt); ?>" class="w-full h-full object-cover block" />
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
