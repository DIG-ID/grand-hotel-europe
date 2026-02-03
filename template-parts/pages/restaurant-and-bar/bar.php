<?php
/**
 * Bar Section in the Restaurant & Bar Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="bar-section" class="bar-section
    bg-[linear-gradient(to_bottom,theme(colors.white)_0%,theme(colors.white)_6%,theme(colors.cream)_6%,theme(colors.cream)_100%)]
    md:bg-[linear-gradient(to_bottom,theme(colors.white)_0%,theme(colors.white)_8%,theme(colors.cream)_8%,theme(colors.cream)_100%)]
    xl:bg-[linear-gradient(to_bottom,theme(colors.white)_0%,theme(colors.white)_5%,theme(colors.cream)_5%,theme(colors.cream)_100%)]
    pb-20 md:pb-32 xl:pb-48">

  <div class="theme-container">

    <!-- FIRST GRID -->
    <div class="theme-grid">

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-1 xl:col-span-12 md:pb-12 xl:pb-24 hidden md:block">
        <figure class="framed__symmetric--bottom-left w-full">
          <?php
          $bar_id = get_field('bar_image');
          if ($bar_id) :
            echo wp_get_attachment_image($bar_id, 'full', false, [
              'class' => 'relative w-full h-full object-cover z-10'
            ]);
          endif;
          ?>
        </figure>
      </div>

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-1 xl:col-span-12 md:pb-12 xl:pb-24 block md:hidden">
        <figure class="framed__symmetric--bottom-left w-full">
          <?php
          $bar_id = get_field('bar_image_mobile');
          if ($bar_id) :
            echo wp_get_attachment_image($bar_id, 'full', false, [
              'class' => 'relative w-full h-full object-cover z-10'
            ]);
          endif;
          ?>
        </figure>
      </div>

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-4 pt-12 md:pt-0">
        <h2 class="title-secondary text-darker"><?php the_field('bar_title'); ?></h2>
      </div>

      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-7 xl:col-span-5 pt-5 xl:pt-0 md:pb-32 xl:pb-0">
        <p class="text-darker"><?php the_field('bar_text'); ?></p>
      </div>

      <div class="button-wrapper col-start-1 col-span-2 md:col-start-5 md:col-span-2 xl:col-start-7 xl:col-span-6 pt-7 md:pt-10 xl:gap-x-20 pb-24 md:pb-0 xl:pb-32">
        <?php 
        $bar_button = get_field('bellvue_button');
        if ($bar_button): ?>
          <a class="btn btn-transparent max-w-56 mb-7 xl:mb-0 xl:mr-20"
             href="<?php echo esc_url($bar_button['url']); ?>"
             target="<?php echo esc_attr($bar_button['target'] ?: '_self'); ?>">
            <?php echo esc_html($bar_button['title']); ?>
          </a>
        <?php endif; ?>

        <?php 
        $bar_button_2 = get_field('bellvue_button_2');
        if ($bar_button_2): ?>
          <a class="btn btn-transparent max-w-56"
             href="<?php echo esc_url($bar_button_2['url']); ?>"
             target="<?php echo esc_attr($bar_button_2['target'] ?: '_self'); ?>">
            <?php echo esc_html($bar_button_2['title']); ?>
          </a>
        <?php endif; ?>
      </div>

    </div><!-- /.theme-grid -->

    <!-- SECOND GRID -->
    <div class="theme-grid">
      <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-2 xl:col-span-10 framed__symmetric--bottom-right framed__symmetric--top-left relative">
        <div class="bg-white">
          <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-10 gap-x-5 xl:gap-x-7">
            <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-4 xl:col-start-1 xl:col-span-4 pt-6 md:pt-8 xl:pt-12">
              <h2 class="title-secondary text-darker px-5 md:px-0 xl:px-5">
                <?php the_field('bar_schedule_title'); ?>
              </h2>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-5 xl:col-start-5 xl:col-span-5 pt-2 md:pt-5 mb-7 md:mb-8 xl:mb-12 xl:pt-12">
              <p class="text-darker px-5 md:px-0 xl:leading-[45px] xl:pl-6 xl:pt-3">
                <?php the_field('bar_schedule_text'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>