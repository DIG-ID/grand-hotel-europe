<?php
/**
 * Intro Section in the Arrival & Contact Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Module
 * @since 1.0.0
 */

$intro_title = get_field('intro_title');
$intro_text  = get_field('intro_text');
$location = get_field('intro_location');
$intro_group = get_field('intro');
$location = is_array($intro_group) ? ($intro_group['location'] ?? null) : null;
?>

<section id="section-intro" class="section-intro xl:pt-0 pb-20 md:pb-24 xl:pb-36">
  <!-- MAP (replaces intro image) -->
  <?php if ( $location ) : ?>
    <div class="theme-container pt-10 md:pt-12">
      <div class="theme-grid">
        <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12">
          <?php if ( is_array($location) && !empty($location['lat']) && !empty($location['lng']) ) : ?>
            <div class="acf-map" data-zoom="17" data-zoom-mobile="16">
              <div class="marker"
                data-lat="<?php echo esc_attr($location['lat']); ?>"
                data-lng="<?php echo esc_attr($location['lng']); ?>">
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="theme-container pt-11 md:pt-16">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-3 xl:col-span-6">

        <?php if ( $intro_title ) : ?>
          <h2 class="title-secondary text-dark-2 mb-5 md:mb-0"><?php echo $intro_title; ?></h2>
        <?php endif; ?>
      </div>

      <div class="col-span-2 md:col-span-3 xl:col-span-6">
        <?php if ( $intro_text ) : ?>
          <p class="text-dark-2"><?php echo $intro_text; ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>