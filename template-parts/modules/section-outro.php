<?php
/**
 * Outro Module Section that appears on multiple page templates.
 *
 * @package grand-hotel-europe
 * @subpackage Module
 * @since 1.0.0
 */

$outro_options_prefix = get_query_var('outro_options_prefix');

function theme_resolve_outro_field(string $base_key, ?string $outro_options_prefix = null) {
  $local_value = null;

  if (is_singular() || is_page()) {
    $local_value = get_field($base_key, get_queried_object_id());
  }
  if ((empty($local_value) || $local_value === null) && $outro_options_prefix) {
    return get_field($outro_options_prefix . '_' . $base_key, 'option');
  }

  return $local_value;
}

$outro_section_type = theme_resolve_outro_field('outro_section_type', $outro_options_prefix);

$bg_outro_id  = get_field('outro_image');
$bg_outro_url = $bg_outro_id ? wp_get_attachment_image_url($bg_outro_id, 'full') : '';
?>

<?php if ( 'full' === $outro_section_type ) : ?>
<section id="section-outro" class="section-outro relative bg-cover bg-center bg-no-repeat" style="<?php echo $bg_outro_url ? 'background-image: linear-gradient(to bottom, rgba(34,34,34,0) 0%, rgba(34,34,34,0) 77%, rgba(34,34,34,1) 77%, rgba(34,34,34,1) 100%), url(' . esc_url($bg_outro_url) . ');' : 'background-color:#222222;'; ?>">
  <div class="absolute inset-0 bg-[rgba(34,34,34,0.75)] pointer-events-none z-0" aria-hidden="true"></div>
  <div class="theme-container pt-9 pb-24 md:py-28 xl:pb-24 xl:pt-20 relative z-10">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-6 xl:col-span-12">
        <p class="overtitle text-white mb-4"><?php the_field( 'outro_overtitle' ); ?></p>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <h2 class="title-secondary text-white mb-5 md:mb-0"><?php the_field( 'outro_title' ); ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <p class="text-white mb-7 xl:mb-14"><?php the_field( 'outro_text' ); ?></p>
        <?php 
        $outro_button = get_field('outro_button');
        if( $outro_button ): 
            $link_url = $outro_button['url'];
            $link_title = $outro_button['title'];
            $link_target = $outro_button['target'] ? $outro_button['target'] : '_self';
            ?>
            <a class="btn btn-transparent max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if ( 'simple' === $outro_section_type ) : ?>
<section id="section-outro" class="section-outro relative bg-cover bg-center bg-no-repeat">
<?php endif; ?>
  
  
  <div class="theme-container relative z-10 bg-cream !w-11/12 xl:!w-full">
    <div class="theme-grid py-14 md:pt-20 md:pb-24">
      <div class="col-span-2 md:col-span-4 xl:col-span-9 xl:pl-14">
        <p class="overtitle text-dark-2 mb-6 md:mb-4"><?php the_field( 'outro_overtitle', 'option' ); ?></p>
        <h2 class="title-secondary text-dark-2 mb-7 md:mb-6"><?php the_field( 'outro_title', 'option' ); ?></h2>
        <div class="flex flex-col xl:flex-row mb-20 md:mb-0">
        <?php
        if( have_rows('outro_features_list', 'option') ):
            while( have_rows('outro_features_list', 'option') ) : the_row(); ?>
            <div class="flex flex-row items-center mr-6 mb-3 xl:mb-0">
              <figure>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none">
                  <path d="M12.9249 0L4.33899 7.99723L1.0751 4.95712L0 5.95851L4.33899 10L14 1.00138L12.9249 0Z" fill="black"/>
                </svg>
              </figure>
              <p class="inline-block ml-2 text-dark-2"><?php the_sub_field('item'); ?></p>
            </div>
            <?php
            endwhile;
        endif; ?>
        </div>
      </div>
      <div class="col-span-2 md:col-span-2 xl:col-span-3 flex flex-col items-center md:items-end justify-center md:justify-end xl:justify-center pr-0 xl:pr-12">
        <?php 
        $booking_url = get_field('booking_button_url','option');
        if( $booking_url ): ?>
          <a class="btn btn-primary max-w-56" href="<?php echo esc_url( $booking_url ); ?>" target="_blank"><?php echo esc_html_e( 'Jetzt buchen', 'grand-hotel-europe' );?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>