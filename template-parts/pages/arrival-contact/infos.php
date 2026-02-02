<?php
/**
 * Infos Section in the Arrival & Contact Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Module
 * @since 1.0.0
 */

?>
<section id="section-info" class="section-info bg-white pt-20 md:pt-24 xl:pt-32 pb-20 md:pb-24 xl:pb-32">
  <div class="theme-container">
    <div class="theme-grid">
        <div class="repeater-wrapper col-start-1 col-span-2 md:col-span-6 xl:col-span-12 grid gap-y-5 xl:gap-y-8">
            <?php if ( have_rows('infos_repeater') ) : ?>
                <?php while ( have_rows('infos_repeater') ) : the_row();
                $title = get_sub_field('title');
                $text  = get_sub_field('text');
                $button = get_sub_field('button');
                ?>
                <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 bg-cream min-h-44 md:min-h-48 gap-x-5 ">
                    <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-4 xl:col-start-2 xl:col-span-3  pt-5 md:pt-8 xl:pt-10 pl-6 md:pl-0">
                    <?php if ($title) : ?>
                        <h3 class="title-small text-darker md:!text-[26px] xl:!text-[36px]  xl:!max-w-[200px]"><?php echo $title; ?></h3>
                    <?php endif; ?>
                    </div>

                    <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-4 xl:col-start-7 xl:col-span-5 pt-5 md:pt-8 xl:pt-10 mb-16 pl-6 md:pl-0 !max-w-[330px] md:!max-w-none">
                    <?php if ($text) : ?>
                        <p class="body text-darker"><?php echo $text; ?></p>
                    <?php endif; ?>
                        <?php if ( $button ) :
                        $link_url    = $button['url'];
                        $link_title  = $button['title'];
                        $link_target = $button['target'] ? $button['target'] : '_self';
                        ?>
                        <a class="btn btn-primary max-w-56 mt-8"href="<?php echo esc_url($link_url); ?>"target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
  </div>
</section>