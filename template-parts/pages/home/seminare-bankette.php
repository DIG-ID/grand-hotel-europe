<?php
/**
 * Seminare & Bankette Section in the Home Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<section id="section-seminare-bankette" class="section-seminare-bankette pb-20 md:pb-28 xl:pb-44">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-3 xl:col-span-5 order-2 md:order-1">
        <p class="text-dark-2 pt-0 xl:pt-10 mb-10 md:mb-0"><?php the_field( 'seminare_bankette_text' ); ?></p>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-5 col-start-1 xl:col-start-8 order-1 md:order-2">
        <p class="overtitle text-dark-2 mb-4"><?php the_field( 'seminare_bankette_overtitle' ); ?></p>
        <h2 class="title-secondary text-dark-2 mb-5 md:mb-0"><?php the_field( 'seminare_bankette_title' ); ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-5 order-4 md:order-3">
        <figure class="hidden md:block w-full">
          <?php
          $sb_id = get_field( 'seminare_bankette_image_1' );
          if ( $sb_id ) :
            echo wp_get_attachment_image( $sb_id, 'full', false, array( 'class' => 'w-full h-full object-cover md:mt-5 xl:mt-20' ) );
          endif;
          ?>
        </figure>
        <div class="btn-wrapper flex flex-col xl:flex-row gap-x-7 md:mt-7 xl:mt-14">
          <?php 
          $sb_button_1 = get_field('seminare_bankette_button_1');
          if( $sb_button_1 ): 
              $link_url = $sb_button_1['url'];
              $link_title = $sb_button_1['title'];
              $link_target = $sb_button_1['target'] ? $sb_button_1['target'] : '_self';
              ?>
              <a class="btn btn-transparent max-w-56 mb-7 xl:mb-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          <?php endif; ?>
          <?php 
          $sb_button_2 = get_field('seminare_bankette_button_2');
          if( $sb_button_2 ): 
              $link_url = $sb_button_2['url'];
              $link_title = $sb_button_2['title'];
              $link_target = $sb_button_2['target'] ? $sb_button_2['target'] : '_self';
              ?>
              <a class="btn btn-transparent max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-5 col-start-1 xl:col-start-8 order-3 md:order-4 mb-12 md:mb-0">
        <figure class="framed__symmetric--bottom-right w-full">
          <?php
          $sb_id = get_field( 'seminare_bankette_image_2' );
          if ( $sb_id ) :
            echo wp_get_attachment_image( $sb_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) );
          endif;
          ?>
        </figure>
      </div>
    </div>
  </div>
</section>