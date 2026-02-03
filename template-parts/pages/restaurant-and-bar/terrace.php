<?php
/**
 * Terrace Section in the Restaurant & Bar Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="terrace-section" class="terrace-section bg-cream pb-16 md:pb-20 xl:pb-28">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-5 md:pb-8 xl:pb-0 pt-7 md:pt-0 order-2 md:order-none">
                <figure>
                    <?php
                    $terrace_left_id = get_field( 'terrace_image_left' );
                    if ( $terrace_left_id ) :
                    echo wp_get_attachment_image( $terrace_left_id, 'full', false, array( 'class' => 'relative w-full h-full object-cover z-10 hidden md:block' ) );
                    endif;
                    ?>
                </figure>
                <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-5 xl:pt-14 order-2 md:order-none md:pb-36 xl:pb-32">
                    <p class="text-darker"><?php the_field( 'terrace_text' ); ?></p>
                </div>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-7 xl:col-span-6 xl:pt-7 order-1 md:order-none">
                <h2 class="title-secondary text-darker md:pb-7 xl:max-w-80"><?php the_field( 'terrace_title' ); ?></h2>
                <figure>
                    <?php
                    $terrace_right_id = get_field( 'terrace_image_right' );
                    if ( $terrace_right_id ) :
                    echo wp_get_attachment_image( $terrace_right_id, 'full', false, array( 'class' => 'hidden md:block relative w-full h-full object-cover z-10' ) );
                    endif;
                    ?>
                </figure>
            </div>
            <div class="col-start-1 col-span-2 md:hidden order-3 pt-7 pb-20">
                <figure>
                    <?php
                    $terrace_right_2_id = get_field( 'terrace_image_right' );
                    if ( $terrace_right_2_id ) :
                    echo wp_get_attachment_image( $terrace_right_2_id, 'full', false, array( 'class' => 'relative w-full h-full object-cover z-10' ) );
                    endif;
                    ?>
                </figure>
            </div>
        </div>
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-6 xl:col-start-2 xl:col-span-10 framed__symmetric--bottom-right framed__symmetric--top-left relative">
                <div class="bg-white">
                    <div class="grid grid-cols-2 md:grid-cols-6 xl:grid-cols-10 gap-x-5 xl:gap-x-7">
                        <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-4 xl:col-start-1 xl:col-span-4 pt-6 md:pt-8 xl:pt-12">
                        <h2 class="title-secondary text-darker px-5 md:px-0 "><?php the_field('terrace_schedule_title'); ?></h2>
                        </div>
                        <div class="col-start-1 col-span-2 md:col-start-2 md:col-span-5 xl:col-start-5 xl:col-span-5 pt-2 md:pt-5 mb-7 md:mb-8 xl:mb-12 xl:pt-12">
                        <p class="text-darker px-5 md:px-0 xl:leading-[45px]"><?php the_field('terrace_schedule_text'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>