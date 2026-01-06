<?php
/**
 * Hero Module Section that appears on multiple page templates.
 *
 * @package grand-hotel-europe
 * @subpackage Module
 * @since 1.0.0
 */

?>


<section id="section-hero" class="section-hero relative xl:h-dvh w-full z-10">
  <figure>
    <?php
    $bg_id = get_field( 'hero_image' );
    if ( $bg_id ) :
      echo wp_get_attachment_image( $bg_id, 'full', false, array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) );
    endif;
    ?>
  </figure>
  <div class="home-hero-overlay" aria-hidden="true"></div>
  <div class="theme-container justify-center h-full flex items-end pb-8 xl:pb-14 relative z-10">
    <div class="theme-grid absolute bottom-8 md:bottom-16 xl:bottom-28">
      <div class="col-span-2 md:col-span-6 xl:col-span-12 scroll-down flex justify-center min-h-16">
        <h1 class="title-main text-white"><?php the_field( 'hero_title' ); ?></h1>
        <div class="w-[1px] md:w-[1px] h-[125px] xl:h-[202px] bg-gold absolute top-9 md:top-14 xl:top-16" aria-hidden="true"></div>
      </div>
    </div>
  </div>
</section>
