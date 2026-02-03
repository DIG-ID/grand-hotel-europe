<section id="section-zimmer" class="section-zimmer relative overflow-hidden pb-10">
    <div class="theme-container pt-8 bg-[linear-gradient(to_bottom,#F8F5F0_0%,#F8F5F0_75%,#FFFFFF_75%,#FFFFFF_100%)] md:bg-[linear-gradient(to_bottom,#F8F5F0_0%,#F8F5F0_85%,#FFFFFF_85%,#FFFFFF_100%)] xl:bg-[linear-gradient(to_bottom,#F8F5F0_0%,#F8F5F0_65%,#FFFFFF_65%,#FFFFFF_100%)]">
      <div class="theme-grid">
        <div class="col-span-2 md:col-span-3 xl:col-span-6 xl:col-start-2 pb-10 md:pb-0">
          <h2 class="overtitle text-dark-2 mb-4"><?php the_field( 'zimmer_overtitle' ); ?></h2>
          <h3 class="title-secondary text-dark-2"><?php the_field( 'zimmer_title' ); ?></h3>
          <p class="text-dark-2 pt-5 pb-7 xl:py-7"><?php the_field( 'zimmer_text' ); ?></p>
          <?php 
          $zimmer_button = get_field('zimmer_button');
          if( $zimmer_button ): 
              $link_url = $zimmer_button['url'];
              $link_title = $zimmer_button['title'];
              $link_target = $zimmer_button['target'] ? $zimmer_button['target'] : '_self';
              ?>
              <a class="btn btn-transparent max-w-56" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          <?php endif; ?>
        </div>
        <div class="col-span-2 md:col-span-3 xl:col-span-5 pt-0 md:pt-[35%] lg:pt-0">
          <figure class="framed__symmetric--bottom-left w-full">
            <?php
            $zimmer_id = get_field( 'zimmer_image' );
            if ( $zimmer_id ) :
              echo wp_get_attachment_image( $zimmer_id, 'full', false, array( 'class' => 'w-full h-full max-h-[320px] md:max-h-none object-cover object-bottom md:object-center' ) );
            endif;
            ?>
          </figure>
        </div>
      </div>
    </div>
</section>