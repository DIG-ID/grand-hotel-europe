<?php
/**
 * Content Section in the Bankette and seminare Single Posts Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<section id="bankette-seminare-content" class="bankette-seminare-content relative overflow-hidden">
  <div class="theme-container">
    <div class="theme-grid pt-10 md:pt-12 xl:pt-36 pb-5 md:pb-14 xl:pb-24">
      <div class="col-span-2 md:col-span-4 xl:col-span-7 mb-16 md:mb-14 xl:mb-0">
        <div class="intro-block mb-8 md:mb-12 xl:mb-10">
          <h2 class="title-secondary text-dark-2"><?php the_field( 'intro_title' ); ?></h2>
          <p class="text-dark-2 pt-5 pb-7 xl:py-7"><?php the_field( 'intro_text' ); ?></p>
        </div>
        <div class="information-block">
          <h4 class="title-smaller text-dark-2 pb-5"><?php the_field( 'information_title' ); ?></h4>
          <p class="text-dark-2 pb-9"><?php the_field( 'information_text' ); ?></p>
          <div class="btn-wrapper flex flex-col md:flex-row gap-x-7 md:mt-7 xl:mt-12">
            <?php 
            $sb_button_1 = get_field('information_button_1');
            if( $sb_button_1 ): 
                $link_url = $sb_button_1['url'];
                $link_title = $sb_button_1['title'];
                $link_target = $sb_button_1['target'] ? $sb_button_1['target'] : '_self';
                ?>
                <a class="btn btn-transparent-linebreak max-w-56 mb-7 md:mb-0" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
            <?php 
            $sb_button_2 = get_field('information_button_2');
            if( $sb_button_2 ): 
                $link_url = $sb_button_2['url'];
                $link_title = $sb_button_2['title'];
                $link_target = $sb_button_2['target'] ? $sb_button_2['target'] : '_self';
                ?>
                <a class="btn btn-transparent-linebreak max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-span-2 md:col-span-6 xl:col-span-4 xl:col-start-9">
          <div class="bankette-seminare-sidebar bg-cream px-5 md:px-5 xl:px-16 py-5 md:py-9 xl:pt-12 xl:pb-16">
            <h4 class="title-smaller text-dark-2 pb-5"><?php the_field( 'facilities_title' ); ?></h4>
            <div class="facilities-list flex flex-col md:flex-row xl:flex-col xl:justify-between">
              <div class="list-top-wrapper w-full md:w-1/2 xl:w-full">
                <ul class="list-disc pl-4 marker:text-[0.6em] marker:text-dark-2">
                <?php
                if( have_rows('facilities_list_top') ):
                  while( have_rows('facilities_list_top') ) : the_row();
                  ?>
                  <li class="text-dark-2 pb-7 xl:pb-5 text-[16px]"><?php the_sub_field( 'item' ); ?></li>
                  <?php
                  endwhile;
                endif;
                ?>
                </ul>
              </div>
              <div class="list-bottom-wrapper w-full md:w-1/2 xl:w-full">
                <ul class="list-disc pl-4 marker:text-[0.6em] marker:text-dark-2">
                <?php
                if( have_rows('facilities_list_bottom') ):
                  while( have_rows('facilities_list_bottom') ) : the_row();
                  ?>
                  <li class="text-dark-2 pb-7 xl:pb-5 text-[16px]"><?php the_sub_field( 'item' ); ?></li>
                  <?php
                  endwhile;
                endif;
                ?>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="theme-grid pb-10 md:pb-24 xl:pb-32">
      <div class="col-span-2 md:col-span-6 xl:col-span-12 theme-grid relative">
        <?php get_template_part( 'template-parts/posts/bankette-seminare/gallery' ); ?>
      </div>
    </div>
  </div>
</section>