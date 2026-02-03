<section id="section-suiten" class="section-suiten relative overflow-hidden pt-10 pb-36">
    <div class="theme-container bg-[linear-gradient(to_bottom,#F8F5F0_0%,#F8F5F0_75%,#FFFFFF_75%,#FFFFFF_100%)] md:bg-[linear-gradient(to_bottom,#FFFFFF_0%,#FFFFFF_30%,#F8F5F0_30%,#F8F5F0_100%)] pb-0 md:pb-16 xl:pb-0">
      <div class="theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-5 order-2 md:order-1">
          <figure class="framed__symmetric--top-right w-full">
            <?php
            $suiten_id = get_field( 'suiten_image' );
            if ( $suiten_id ) :
              echo wp_get_attachment_image( $suiten_id, 'full', false, array( 'class' => 'w-full h-full max-h-[320px] md:max-h-none object-cover object-bottom md:object-center' ) );
            endif;
            ?>
          </figure>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-7 pt-8 md:pt-[70%] lg:pt-[50%] xl:pt-52 xl:pr-20 pb-10 md:pb-0 order-1 md:order-2">
          <h2 class="overtitle text-dark-2 mb-4"><?php the_field( 'suiten_overtitle' ); ?></h2>
          <h3 class="title-secondary text-dark-2"><?php the_field( 'suiten_title' ); ?></h3>
          <p class="text-dark-2 pt-5 pb-7 xl:py-7"><?php the_field( 'suiten_text' ); ?></p>
          <?php 
          $suiten_button = get_field('suiten_button');
          if( $suiten_button ): 
              $link_url = $suiten_button['url'];
              $link_title = $suiten_button['title'];
              $link_target = $suiten_button['target'] ? $suiten_button['target'] : '_self';
              ?>
              <a class="btn btn-transparent max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
</section>