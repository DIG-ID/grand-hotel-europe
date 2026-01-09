<?php
/**
 * Travel Banner Section in the Home Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

$bg_id  = get_field('travel_banner_image');
$bg_url = $bg_id ? wp_get_attachment_image_url($bg_id, 'full') : '';
?>

<section id="section-travel-banner" class="section-travel-banner relative bg-cover bg-no-repeat bg-[position:center_0%]" style="<?php echo $bg_url ? 'background-image: url(' . esc_url($bg_url) . ');' : ''; ?>">
  <div class="absolute inset-0 bg-[rgba(34,34,34,0.75)] pointer-events-none z-0" aria-hidden="true"></div>
  <div class="theme-container py-24 md:py-28 xl:py-28 relative z-10">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <h2 class="title-secondary text-white"><?php the_field( 'travel_banner_title' ); ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <h2 class="title-small text-white mb-7 xl:mb-14"><?php the_field( 'travel_banner_dates' ); ?></h2>
        <p class="text-white mb-7 xl:mb-14"><?php the_field( 'travel_banner_text' ); ?></p>
        <?php 
        $tb_button = get_field('travel_banner_button');
        if( $tb_button ): 
            $link_url = $tb_button['url'];
            $link_title = $tb_button['title'];
            $link_target = $tb_button['target'] ? $tb_button['target'] : '_self';
            ?>
            <a class="btn btn-primary max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>