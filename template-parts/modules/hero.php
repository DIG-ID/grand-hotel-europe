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

$rb_id  = theme_resolve_hero_field('hero_background_image', $hero_options_prefix);
$title  = theme_resolve_hero_field('hero_title', $hero_options_prefix);
/*Different titles for suitens and zimmer*/
if ( is_post_type_archive('suiten') ) {
  $title = esc_html__( 'Suiten', 'grand-hotel-europe' );
} elseif ( is_post_type_archive('zimmer') ) {
  $title = esc_html__( 'Zimmer', 'grand-hotel-europe' );
}
?>

<section id="hero" class="hero-section relative overflow-hidden pt-72 pb-72 md:pt-96 md:pb-96 xl:pt-[22.13rem] xl:pb-48 text-center">
  <figure class="w-full">
    <?php
    if ( $rb_id ) :
      echo wp_get_attachment_image( $rb_id, 'full', false, array( 'class' => 'absolute inset-0 w-full h-full object-cover -z-10' ) );
    endif;
    ?>
  </figure>

  <div class="absolute inset-0 bg-[#222222] opacity-[0.59] -z-10"></div>

  <div class="theme-container relative z-10">
    <h1 class="title-main pb-5 xl:pb-6 text-white"><?php echo $title; ?></h1>
    <div class="breadcrumbs text-white">
        <?php theme_breadcrumbs(); ?>
    </div>
  </div>

</section>