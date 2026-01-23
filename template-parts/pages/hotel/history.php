<?php
/**
 * History Section in the Das Hotel Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="history-section" class="history-section bg-white pt-20 md:pt-28 xl:pt-36">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-4 xl:col-start-1 xl:col-span-6">
        <h2 class="title-secondary text-darker">
          <?php the_field('history_title'); ?>
        </h2>
      </div>
      <div class="repeater-wrapper col-start-1 col-span-2 md:col-span-6 xl:col-span-12 grid gap-y-16 md:gap-y-7 pt-12 md:pt-5 xl:pt-12">
        <?php if (have_rows('history_repeater')) : ?>
          <?php while (have_rows('history_repeater')) : the_row();
            $title = get_sub_field('title');
            $text  = get_sub_field('text');
            $image = get_sub_field('image');
            $img_id = is_array($image) ? ($image['ID'] ?? null) : $image;
          ?>
            <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 xl:grid-rows-2 gap-x-5 xl:gap-x-7 gap-y-6 md:gap-y-8">
              <div class="col-span-2 md:col-span-3 xl:col-span-6 xl:row-span-2">
                <figure class="w-full h-full">
                    <?php
                    if ( $img_id ) :
                    echo wp_get_attachment_image( $img_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) );
                    endif;
                    ?>
                </figure>
              </div>
              <div class="col-span-2 md:col-span-3 xl:col-span-6 xl:row-span-2">
                <div class="">
                  <?php if ($title) : ?><h3 class="title-small text-darker md:!text-[26px] xl:!text-[36px]"><?php echo $title; ?></h3>
                  <?php endif; ?>
                </div>
                <div class="pt-5">
                    <?php if ($text) : ?><p class="body text-darker max-w-[527px]"><?php echo $text; ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>