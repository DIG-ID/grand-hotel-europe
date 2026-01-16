<?php
/**
 * Intro Module Section that appears on multiple page templates.
 *
 * @package grand-hotel-europe
 * @subpackage Module
 * @since 1.0.0
 */

$options_prefix = get_query_var('options_prefix');

function theme_resolve_field(string $base_key, ?string $options_prefix = null) {
  $local_value = null;

  if (is_singular() || is_page()) {
    $local_value = get_field($base_key, get_queried_object_id());
  }
  if ((empty($local_value) || $local_value === null) && $options_prefix) {
    return get_field($options_prefix . '_' . $base_key, 'option');
  }

  return $local_value;
}

$intro_id      = theme_resolve_field('intro_image', $options_prefix);
$intro_over    = theme_resolve_field('intro_overtitle', $options_prefix);
$intro_title   = theme_resolve_field('intro_title', $options_prefix);
$intro_text    = theme_resolve_field('intro_text', $options_prefix);
?>

<section id="section-intro" class="section-intro xl:pt-0 pb-20 md:pb-24 xl:pb-36">
  <?php if ( is_front_page() ) : ?>
  <div class="w-[1px] md:w-[1px] h-[56px] xl:h-[56px] bg-gold mx-auto" aria-hidden="true"></div>
  <?php endif; ?>
  <div class="w-[128px] md:w-[690px] h-[1px] xl:h-[1px] bg-gold mb-4 md:mb-5 xl:mb-[30.5px] mx-auto" aria-hidden="true"></div>
  <div class="intro-image px-6 md:px-14">
    <figure class="framed__asymmetric--bottom-both w-full">
      <?php
      if ( $intro_id ) :
        echo wp_get_attachment_image( $intro_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) );
      endif;
      ?>
    </figure>
  </div>
  <div class="theme-container pt-11 md:pt-16">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <p class="overtitle text-dark-2 mb-4"><?php echo $intro_over; ?></p>
        <h2 class="title-secondary text-dark-2 mb-5 md:mb-0"><?php echo $intro_title; ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <p class="text-dark-2"><?php echo $intro_text; ?></p>
      </div>
    </div>
  </div>
</section>