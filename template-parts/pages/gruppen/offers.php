<?php
/**
 * Offer Section in the Gruppen Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>

<section id="offers-section" class="offers-section bg-white xl:pt-48 md:pt-16 pt-8">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-span-3 xl:col-span-5 order-2 md:order-none">
                <h2 class="overtitle text-dark pt-8 md:pt-0"><?php the_field('offers_overtitle'); ?></h2>
                <h3 class="title-secondary text-darker pt-5"><?php the_field('offers_title'); ?></h3>
                <p class="text-dark pt-5 max-w-[344px] md:max-w-none"><?php the_field( 'offers_text' ); ?></p>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-4 md:col-span-3 xl:col-start-8 xl:col-span-5 order-1 md:order-none">
                <figure class="framed__asymmetric--top-right w-full">
                    <?php
                    $hero_id = get_field( 'offers_image' );
                    if ( $hero_id ) :
                    echo wp_get_attachment_image( $hero_id, 'full', false, array( 'class' => 'relative inset-0 w-full h-full' ) );
                    endif;
                    ?>
                </figure>
            </div>
        </div>
    </div>
</section>