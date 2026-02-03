<?php
/**
 * Philosophy Section in the Das Hotel Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="philosophy-section" class="philosophy-section bg-white xl:pt-12">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-4 xl:col-start-3 xl:col-span-8 pb-20 md:pb-24 xl:pb-48">
                <h3 class="title-small !text-[1.5625rem] md:!text-[1.875rem] xl:!text-[2.25rem] text-darker text-center"><?php the_field( 'philosophy_quote' ); ?></h3>
            </div>
            <div class="repeater-wrapper col-start-1 col-span-2 md:col-span-6 xl:col-span-12 grid gap-y-5 xl:gap-y-8">
                <?php if ( have_rows('philosophy_repeater') ) : ?>
                    <?php while ( have_rows('philosophy_repeater') ) : the_row();
                    $title = get_sub_field('title');
                    $text  = get_sub_field('text');
                    ?>
                    <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 bg-cream min-h-44 md:min-h-48 gap-x-5">
                        <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-1 xl:col-start-2 xl:col-span-3  pt-6 md:pt-8 xl:pt-10">
                        <?php if ($title) : ?>
                            <h3 class="title-small text-darker !text-[26px] xl:!text-[36px] pl-6 md:pl-0 pb-5"><?php echo $title; ?></h3>
                        <?php endif; ?>
                        </div>

                        <div class="col-start-1 col-span-2 md:col-start-3 md:col-span-3 xl:col-start-7 xl:col-span-5 md:pt-8 xl:pt-10 md:pb-8 xl:pb-10  max-w-[330px] min-h-28">
                        <?php if ($text) : ?>
                            <p class="text-darker pl-6 md:pl-0"><?php echo $text; ?></p>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>