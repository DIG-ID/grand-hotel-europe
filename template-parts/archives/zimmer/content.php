<section id="zimmer-overview" class="zimmer-overview">
  <div class="theme-container">
    <div class="theme-grid">
      <?php if ( have_posts() ) : ?>
        <?php $i = 0; ?>
        <?php while ( have_posts() ) : the_post(); $i++; ?>
          <?php
            $is_even = ($i % 2 === 0);
            $image_order   = $is_even ? 'xl:order-2' : 'xl:order-1';
            $content_order = $is_even ? 'xl:order-1' : 'xl:order-2';
            $section_padding = $is_even ? 'pl-0 pr-0' : 'pl-0 pr-6';
            $border_side = $is_even ? 'zimmer-suiten-border--right' : 'zimmer-suiten-border--left';
          ?>
          <article class="col-span-2 md:col-span-6 xl:col-span-12">
            <div class="relative zimmer-suiten-border <?php echo esc_attr($border_side); ?> pt-0 pb-32 <?php echo esc_attr($section_padding); ?>">
              <div class="theme-grid items-start">
                <div class="col-span-2 md:col-span-6 xl:col-span-7 <?php echo esc_attr($image_order); ?>">
                  <a href="<?php the_permalink(); ?>" class="block">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail('large', [ 'class' => 'w-full h-auto object-cover' ]); ?>
                    <?php endif; ?>
                  </a>
                </div>
                <div class="col-span-2 md:col-span-6 xl:col-span-5 <?php echo esc_attr($content_order); ?>">
                  <h2 class="text-dark-1">
                    <a href="<?php the_permalink(); ?>" class="title-secondary text-dark-2"><?php the_title(); ?></a>
                  </h2>
                  <div class="pt-6 grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-2">
                    <?php if ( have_rows('facilities_list_top') ) : ?>
                      <?php while ( have_rows('facilities_list_top') ) : the_row(); ?>
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
                      <?php endwhile; ?>
                    <?php endif; ?>
                  </div>
                  <p class="text-dark-2 pt-5 pb-7 xl:py-7"><?php the_field('intro_text'); ?></p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary max-w-56"><?php esc_html_e( 'Mehr erfahren', 'grand-hotel-europe' ) ?></a>
                </div>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="col-span-2 md:col-span-6 xl:col-span-12">
          <p><?php esc_html_e( 'Keine Zimmer gefunden.', 'grand-hotel-europe' ) ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
