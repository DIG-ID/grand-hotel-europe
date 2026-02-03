<?php
/**
 * Bellvue Section in the Restaurant & Bar Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */
?>
<section id="bellvue-section" class="bellvue-section 
    bg-[linear-gradient(to_bottom,theme(colors.white)_0%,theme(colors.white)_10%,theme(colors.cream)_10%,theme(colors.cream)_100%)]
    md:bg-[linear-gradient(to_bottom,theme(colors.white)_0%,theme(colors.white)_12%,theme(colors.cream)_12%,theme(colors.cream)_100%)]
    xl:bg-[linear-gradient(to_bottom,theme(colors.white)_0%,theme(colors.white)_15%,theme(colors.cream)_15%,theme(colors.cream)_100%)]
    pb-20 md:pb-24 xl:pb-20">
    <div class="theme-container">
        <div class="theme-grid">
            <div class="col-start-1 col-span-2 md:col-span-6 xl:col-span-12 pb-12 xl:pb-24">
                <div class="split-image">
                    <figure class="framed__asymmetric--bottom-left w-full">
                        <?php
                        $bellvue_id = get_field( 'bellvue_image' );
                        if ( $bellvue_id ) :
                        echo wp_get_attachment_image( $bellvue_id, 'full', false, array( 'class' => 'relative w-full h-full object-cover z-10' ) );
                        endif;
                        ?>
                    </figure>
                </div>
            </div>
            <div class="col-start-1 col-span-2 md:col-start-1 md:col-span-5 xl:col-start-1 xl:col-span-6">
                <h2 class="title-secondary text-darker "><?php the_field( 'bellvue_title' ); ?></h2>
            </div>
            <div class="col-start-1 col-span-2 md:col-span-3 xl:col-start-7 xl:col-span-5 pt-5 xl:pt-0">
                <p class="text-darker"><?php the_field( 'bellvue_text' ); ?></p>
            </div>
                <div class="button-wrapper col-start-1 col-span-2 md:col-start-5 md:col-span-2 xl:col-start-7 xl:col-span-6 pt-7 md:pt-10 xl:gap-x-20">
                    <?php 
                    $bellvue_button = get_field('bellvue_button');
                    if( $bellvue_button ): 
                        $link_url = $bellvue_button['url'];
                        $link_title = $bellvue_button['title'];
                        $link_target = $bellvue_button['target'] ? $bellvue_button['target'] : '_self';
                        ?>
                        <a class="btn btn-transparent max-w-56 mb-7 xl:mb-0 xl:mr-20" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                    <?php 
                    $bellvue_button_2 = get_field('bellvue_button_2');
                    if( $bellvue_button_2 ): 
                        $link_url = $bellvue_button_2['url'];
                        $link_title = $bellvue_button_2['title'];
                        $link_target = $bellvue_button_2['target'] ? $bellvue_button_2['target'] : '_self';
                        ?>
                        <a class="btn btn-transparent max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>