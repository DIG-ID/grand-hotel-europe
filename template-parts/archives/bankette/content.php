<?php
/**
 * Content Section in the Bankette Archive Template.
 *
 * Loop trough Custom Post Type Bankette.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.0.0
 */

?>

<section id="post-intro" class="post-intro pb-24 md:pb-28 xl:pb-12">
  <div class="theme-container">
    <div class="theme-grid">
      <?php
      if( have_rows('bankette_content_top', 'option') ):
        while( have_rows('bankette_content_top', 'option') ) : the_row();
        ?>
        <div class="col-span-2 md:col-span-6 xl:col-span-12 theme-grid bg-cream px-5 md:px-0 py-7 md:pt-8 md:pb-10 xl:mt-8 mb-5 xl:mb-12">
          <div class="col-span-2 md:col-span-2 xl:col-span-4 col-start-1 md:col-start-2 xl:col-start-2">
            <h2 class="title-small text-dark-2"><?php the_sub_field('title'); ?></h2>
          </div>
          <div class="col-span-2 md:col-span-2 xl:col-span-5 col-start-1 md:col-start-4 xl:col-start-7">
            <p class="text-dark-2"><?php the_sub_field('text'); ?></p>
            <?php 
            $postIntroBtn = get_sub_field('button');
            if( $postIntroBtn ): 
                $link_url = $postIntroBtn['url'];
                $link_title = $postIntroBtn['title'];
                $link_target = $postIntroBtn['target'] ? $postIntroBtn['target'] : '_self';
                ?>
                <a class="btn btn-primary max-w-56 mt-7" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
          </div>
        </div>
        <?php
        endwhile;
      endif; ?>
    </div>
  </div>
</section>

<?php
$general_query = new WP_Query([
  'post_type'      => 'bankette',
  'post_status'    => 'publish',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);
?>
<section id="bankette-overview" class="bankette-overview">
  <div class="theme-container">
    <div class="theme-grid">
      <?php if ( $general_query->have_posts() ) : ?>
        <?php $i = 0; ?>
        <?php while ( $general_query->have_posts() ) : $general_query->the_post(); $i++; ?>
          <?php
            $is_even = ($i % 2 === 0);
            $image_order   = $is_even ? 'md:order-2' : 'md:order-1';
            $content_order = $is_even ? 'md:order-1' : 'md:order-2';
            $section_padding = $is_even ? 'pl-0 pr-0' : 'pl-0 pr-0 xl:pr-6';
            $border_side = $is_even ? 'bankette-seminare-border--right' : 'bankette-seminare-border--left';
          ?>
          <article class="col-span-2 md:col-span-6 xl:col-span-12">
            <div class="relative bankette-seminare-border <?php echo esc_attr($border_side); ?> pt-0 pb-14 md:pb-24 xl:pb-32 <?php echo esc_attr($section_padding); ?>">
              <div class="theme-grid items-start">
                <div class="col-span-2 md:col-span-3 xl:col-span-7 h-auto md:h-full xl:h-auto <?php echo esc_attr($image_order); ?>">
                  <a href="<?php the_permalink(); ?>" class="block">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail('full', [ 'class' => 'w-full h-auto md:h-full xl:h-auto max-h-[400px] md:max-h-[450px] xl:max-h-[650px] min-h-[400px] md:min-h-[450px] xl:min-h-[650px] object-cover md:object-center xl:object-cover' ]); ?>
                    <?php endif; ?>
                  </a>
                </div>
                <div class="col-span-2 md:col-span-3 xl:col-span-5 pt-8 md:pt-0 <?php echo esc_attr($content_order); ?>">
                  <h2 class="text-dark-1">
                    <a href="<?php the_permalink(); ?>" class="title-secondary text-dark-2"><?php the_title(); ?></a>
                  </h2>
                  <div class="pt-6 grid grid-cols-1 xl:grid-cols-1 gap-x-5 gap-y-2">
                    <?php if ( have_rows('facilities_list_top') ) : ?>
                      <?php $h = 0; ?>
                      <?php while ( have_rows('facilities_list_top') ) : the_row(); ?>
                        <?php if ( $h >= 4 ) break; ?>
                        <div class="flex items-center justify-start gap-3">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <g clip-path="url(#clip0_2105_9024)">
                              <path d="M9 0C4.03759 0 0 4.03759 0 9C0 13.9624 4.03759 18 9 18C13.9624 18 18 13.9624 18 9C18 4.03759 13.9624 0 9 0ZM14.0301 6.63158L8.2782 12.3383C7.93985 12.6767 7.3985 12.6992 7.03759 12.3609L3.99248 9.58647C3.63158 9.24812 3.60902 8.68421 3.92481 8.32331C4.26316 7.96241 4.82707 7.93985 5.18797 8.2782L7.6015 10.4887L12.7444 5.34586C13.1053 4.98496 13.6692 4.98496 14.0301 5.34586C14.391 5.70677 14.391 6.27068 14.0301 6.63158Z" fill="#A7986E"/>
                            </g>
                            <defs>
                              <clipPath id="clip0_2105_9024">
                                <rect width="18" height="18" fill="white"/>
                              </clipPath>
                            </defs>
                          </svg>
                          <p class="text-dark-2"><?php the_sub_field('item'); ?></p>
                        </div>
                        <?php $h++; ?>
                      <?php endwhile; ?>
                    <?php endif; ?>
                  </div>
                  <p class="text-dark-2 pt-5 pb-7 xl:pb-7 xl:pt-12"><?php the_field('intro_text_overview'); ?></p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary max-w-56"><?php esc_html_e( 'Mehr erfahren', 'grand-hotel-europe' ) ?></a>
                </div>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="col-span-2 md:col-span-6 xl:col-span-12">
          <p><?php esc_html_e( 'Keine bankette gefunden.', 'grand-hotel-europe' ) ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section id="post-content" class="post-content bg-cream py-5 md:py-14 xl:py-28">
  <div class="theme-container">
    <div class="theme-grid">
        <div class="col-span-2 md:col-span-6 xl:col-span-12 theme-grid">
          <div class="col-span-2 md:col-span-3 xl:col-span-5">
            <h2 class="title-secondary text-dark-2 mb-5 md:mb-0"><?php the_field('bankette_content_bottom_title', 'option'); ?></h2>
          </div>
          <div class="col-span-2 md:col-span-3 xl:col-span-5 col-start-1 md:col-start-4 xl:col-start-7">
            <p class="text-dark-2"><?php the_field('bankette_content_bottom_text', 'option'); ?></p>
          </div>
        </div>
    </div>
  </div>
</section>