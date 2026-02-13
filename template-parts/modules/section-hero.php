<?php
/**
 * Hero Module Section that appears on multiple page templates.
 *
 * @package grand-hotel-europe
 * @subpackage modules
 * @since 1.0.0
 */

$hero_options_prefix = get_query_var('hero_options_prefix');

function theme_resolve_hero_field(string $base_key, ?string $hero_options_prefix = null) {
  $local_value = null;

  if (is_singular() || is_page()) {
    $local_value = get_field($base_key, get_queried_object_id());
  }
  if ((empty($local_value) || $local_value === null) && $hero_options_prefix) {
    return get_field($hero_options_prefix . '_' . $base_key, 'option');
  }

  return $local_value;
}

$rb_id_desktop  = theme_resolve_hero_field('hero_background_image', $hero_options_prefix);
$rb_id_mobile  = theme_resolve_hero_field('hero_background_image_responsive', $hero_options_prefix);

// Fallback: if responsive isn’t set, use desktop
if (empty($rb_id_mobile)) {
  $rb_id_mobile = $rb_id_desktop;
}

if ( $hero_options_prefix ) {
  $title  = theme_resolve_hero_field('hero_title', $hero_options_prefix);
} else {
  $title  = get_the_title();
}

/*Different titles for suitens and zimmer*/
if ( is_post_type_archive('suiten') ) {
  $title = esc_html__( 'Suiten', 'grand-hotel-europe' );
} elseif ( is_post_type_archive('zimmer') ) {
  $title = esc_html__( 'Zimmer', 'grand-hotel-europe' );
} elseif ( is_post_type_archive('jobs') ) {
  $title = esc_html__( 'Offene Stellen', 'grand-hotel-europe' );
}
?>

<section id="hero" class="hero-section relative overflow-hidden min-h-[80dvh] flex flex-col justify-center md:block md:min-h-0 pt-0 md:pt-80 md:pb-80 xl:pt-[22.13rem] xl:pb-48 text-center <?php echo ($rb_id_desktop || $rb_id_mobile) ? '' : 'bg-darker'; ?>">
  <?php if ( $rb_id_desktop || $rb_id_mobile ) : ?>
    <figure class="absolute inset-0 -z-20">
      <?php
      // If both IDs are the same, output just one image to avoid duplicate downloads.
      if ($rb_id_mobile && $rb_id_desktop && (int)$rb_id_mobile === (int)$rb_id_desktop) { echo wp_get_attachment_image($rb_id_desktop,'full', false, array('class' => 'w-full h-full object-cover') );
      } 
      else {
        if ($rb_id_mobile) { echo wp_get_attachment_image($rb_id_mobile, 'full', false, array('class' => 'w-full h-full object-cover !block xl:!hidden') );
        }
        if ($rb_id_desktop) { echo wp_get_attachment_image($rb_id_desktop, 'full', false, array('class' => 'w-full h-full object-cover !hidden xl:!block') );
        }
      }
      ?>
    </figure>
  <?php endif; ?>
  <div class="absolute inset-0 bg-[#222222] opacity-[0.59] -z-10"></div>
    
  <div class="theme-container relative z-10">
    <h1 class="title-main pb-5 xl:pb-6 text-white"><?php echo $title; ?></h1>
    <div class="breadcrumbs text-white">
        <?php theme_breadcrumbs(); ?>
    </div>
  </div>

</section>