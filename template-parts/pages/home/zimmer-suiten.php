<?php
/**
 * Zimmer & Suiten Section in the Home Page Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<section id="section-zimmer-suiten" class="section-zimmer-suiten pt-11 md:pt-16 pb-24 md:pb-32 xl:pb-40 bg-[linear-gradient(to_bottom,#F8F5F0_0%,#F8F5F0_60%,#FFFFFF_60%,#FFFFFF_100%)]">
  <div class="theme-container">
    <div class="theme-grid">
      <div class="col-span-2 md:col-span-4 xl:col-span-12">
        <p class="overtitle text-dark-2 mb-4"><?php the_field( 'zimmer_suiten_overtitle' ); ?></p>
        <h2 class="title-secondary text-dark-2 mb-5 xl:mb-10"><?php the_field( 'zimmer_suiten_title' ); ?></h2>
      </div>
      <div class="col-span-2 md:col-span-3 xl:col-span-5 col-start-1">
        <p class="text-dark-2"><?php the_field( 'zimmer_suiten_text' ); ?></p>
      </div>
      <div class="col-span-2 md:col-span-2 xl:col-span-3 col-start-1 md:col-start-5 xl:col-start-10 flex flex-col justify-end items-end">
        <?php 
        $zs_button = get_field('zimmer_suiten_button');
        if( $zs_button ): 
            $link_url = $zs_button['url'];
            $link_title = $zs_button['title'];
            $link_target = $zs_button['target'] ? $zs_button['target'] : '_self';
            ?>
            <a class="btn btn-transparent-linebreak max-w-56 md:max-w-none xl:max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
      </div>
      <div class="col-span-2 md:col-span-6 xl:col-span-12 mt-10">
        <figure class="framed__fullwidth-left w-full">
          <?php
          $zs_id = get_field( 'zimmer_suiten_image' );
          if ( $zs_id ) :
            echo wp_get_attachment_image( $zs_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) );
          endif;
          ?>
        </figure>
      </div>
    </div>
  </div>
</section>