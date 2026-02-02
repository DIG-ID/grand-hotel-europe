<?php
/**
 * Your Stay Section in the Gruppen Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>

<section id="your-stay-section" class="your-stay-section bg-white pt-24 xl:pt-36">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-span-5 xl:col-span-8">
                <h2 class="overtitle text-dark"><?php the_field( 'your-stay_overtitle' ); ?></h2>
                <h3 class="title-secondary text-darker pt-5"><?php the_field( 'your-stay_title' ); ?></h3>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-4 pt-5">
                <p class="text-dark font-bold"><?php the_field( 'your-stay_list_one_title' ); ?></p>
                <?php if ( have_rows( 'your-stay_list_one' ) ) : ?>
                <ul class="pt-2">
                    <?php while ( have_rows( 'your-stay_list_one' ) ) : the_row(); ?>
                    <li class="flex items-start gap-2 text-dark">
                        <span class="mt-[14px] block w-[4px] h-[4px] bg-dark rounded-full"></span>
                        <span><?php the_sub_field( 'item' ); ?></span>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-6 xl:col-span-3 pt-5">
                  <p class="text-dark font-bold"><?php the_field( 'your-stay_list_two_title' ); ?></p>
                <?php if ( have_rows( 'your-stay_list_two' ) ) : ?>
                <ul class="pt-2">
                    <?php while ( have_rows( 'your-stay_list_two' ) ) : the_row(); ?>
                    <li class="flex items-start gap-2 text-dark">
                        <span class="mt-[14px] block w-[4px] h-[4px] bg-dark rounded-full"></span>
                        <span><?php the_sub_field( 'item' ); ?></span>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12 pt-8 xl:pt-10">
                <div class="split-image">
                    <figure class="framed__asymmetric--bottom-left w-full">
                        <?php
                        $stay_id = get_field( 'your-stay_image' );
                        if ( $stay_id ) :
                        echo wp_get_attachment_image( $stay_id, 'full', false, array( 'class' => 'relative w-full h-full object-cover z-10' ) );
                        endif;
                        ?>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>