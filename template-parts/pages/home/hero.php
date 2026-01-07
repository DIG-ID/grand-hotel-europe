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
    <div class="theme-grid absolute bottom-8 md:bottom-16 xl:bottom-0 w-full">
      <div class="col-span-2 md:col-span-6 xl:col-span-12 scroll-down flex flex-col justify-center mb-11">
        <h1 class="title-main text-white text-center mb-9"><?php the_field( 'hero_title' ); ?></h1>
        <div id="sb-container"></div> 
      </div>
      <div class="col-span-2 md:col-span-6 xl:col-span-12 scroll-down flex flex-col items-center">
        <figure>
          <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none">
            <rect x="32.25" y="0.750001" width="31.5" height="31.5" transform="rotate(90 32.25 0.750001)" stroke="#A7986E" stroke-width="1.5"/>
            <path d="M26 12L16.5 21L7 12" stroke="#A7986E" stroke-width="1.5"/>
          </svg>
        </figure>
        <div class="w-[1px] md:w-[1px] h-[125px] xl:h-[150px] bg-gold" aria-hidden="true"></div>
      </div>
    </div>
  </div>
</section>
