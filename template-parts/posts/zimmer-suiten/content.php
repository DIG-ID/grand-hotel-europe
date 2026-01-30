<?php
/**
 * Content Section in the Zimmer and Suiten Single Posts Template.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<section id="zimmer-suiten-content" class="zimmer-suiten-content relative overflow-hidden">
  <div class="theme-container">
    <div class="theme-grid pt-10 md:pt-12 xl:pt-24">
      <div class="col-span-2 md:col-span-6 xl:col-span-12 theme-grid relative">
        <?php get_template_part( 'template-parts/posts/zimmer-suiten/gallery' ); ?>
      </div>
    </div>
    <div class="theme-grid pt-20 md:pt-24 xl:pt-16 pb-20 xl:pb-36">
      <div class="col-span-2 md:col-span-4 xl:col-span-7">
        <div class="intro-block mb-20 md:mb-14 xl:mb-20">
          <h2 class="title-secondary text-dark-2"><?php the_field( 'intro_title' ); ?></h2>
          <p class="text-dark-2 pt-5 pb-7 xl:py-7"><?php the_field( 'intro_text' ); ?></p>
          <a class="btn btn-primary max-w-56" href="<?php the_field( 'booking_button_url', 'option' ); ?>" target="_blank"><?php esc_html_e( 'Jetzt buchen', 'grand-hotel-europe' ); ?></a>
        </div>
        
        <div class="additional-block">
          <h3 class="title-small text-dark-2 mb-8"><?php the_field( 'additional_title' ); ?></h3>
          <?php
          if( have_rows('additional_services') ):
              while( have_rows('additional_services') ) : the_row();
              ?>
              <?php if( get_sub_field( 'title' ) ) : ?>
                <h4 class="title-smaller text-dark-2 pb-5"><?php the_sub_field( 'title' ); ?></h4>
              <?php endif; ?>
              <?php if( get_sub_field( 'text' ) ) : ?>
                <p class="text-dark-2 pb-7 md:pb-12"><?php the_sub_field( 'text' ); ?></p>
              <?php endif; ?>
              <?php
              endwhile;
          endif;
          ?>
        </div>
      </div>
      <div class="col-span-2 md:col-span-6 xl:col-span-4 xl:col-start-9">
          <div class="zimmer-suiten-sidebar bg-cream px-5 md:px-5 xl:px-16 py-5 md:py-9 xl:pt-12 xl:pb-16">
            <h4 class="title-smaller text-dark-2 pb-5"><?php the_field( 'facilities_title' ); ?></h4>
            <div class="facilities-list flex flex-col md:flex-row xl:flex-col xl:justify-between">
              <div class="list-top-wrapper xl:mb-14 w-full md:w-1/2 xl:w-full">
                <ul>
                <?php
                if( have_rows('facilities_list_top') ):
                  while( have_rows('facilities_list_top') ) : the_row();
                  ?>
                  <li class="text-dark-2 pb-1 text-[16px]"><?php the_sub_field( 'item' ); ?></li>
                  <?php
                  endwhile;
                endif;
                ?>
                </ul>
              </div>
              <div class="list-bottom-wrapper w-full md:w-1/2 xl:w-full">
                <ul>
                <?php
                if( have_rows('facilities_list_bottom') ):
                  while( have_rows('facilities_list_bottom') ) : the_row();
                  ?>
                  <li class="text-dark-2 pb-1 text-[16px]"><?php the_sub_field( 'item' ); ?></li>
                  <?php
                  endwhile;
                endif;
                ?>
                </ul>
              </div>
              <div class="list-information-wrapper w-full mt-14 md:mt-11 xl:mt-24">
                <h4 class="title-smaller text-dark-2 pb-5"><?php the_field( 'information_title' ); ?></h4>
                <p class="text-dark-2 pb-1 text-[16px]"><?php the_field( 'information_check_in' ); ?></p>
                <p class="text-dark-2 text-[16px]"><?php the_field( 'information_check_out' ); ?></p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>