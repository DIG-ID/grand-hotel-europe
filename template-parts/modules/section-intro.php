<?php
/**
 * Intro Module Section that appears on multiple page templates.
 *
 * @package grand-hotel-europe
 * @subpackage Module
 * @since 1.0.0
 */

?>

<section id="section-intro" class="section-intro xl:pt-0 xl:pb-36">
  <?php if ( is_front_page() ) : ?>
  <div class="w-[1px] md:w-[1px] h-[56px] xl:h-[56px] bg-gold mx-auto" aria-hidden="true"></div>
  <?php endif; ?>
  <div class="w-[1px] md:w-[690px] h-[1px] xl:h-[1px] bg-gold mb-5 mx-auto" aria-hidden="true"></div>
  <div class="intro-image px-14">
    <figure class="framed__fullwidth-both w-full">
      <?php
      $intro_id = get_field( 'intro_image' );
      if ( $intro_id ) :
        echo wp_get_attachment_image( $intro_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) );
      endif;
      ?>
    </figure>
  </div>
  <div class="theme-container pt-11 md:pt-16">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <p class="overtitle text-dark-2 mb-4"><?php the_field( 'intro_overtitle' ); ?></p>
        <h2 class="title-secondary text-dark-2"><?php the_field( 'intro_title' ); ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <p class="text-dark-2"><?php the_field( 'intro_text' ); ?></p>
      </div>
    </div>
  </div>
</section>