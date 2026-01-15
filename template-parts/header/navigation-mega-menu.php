<?php
if ( has_nav_menu( 'mega-menu') ) :
	wp_nav_menu(
		array(
		'theme_location' => 'mega-menu',
		'menu_class' => 'mega-menu',
		)
	);
else :
	esc_html_e( 'Please assign a menu to the mega-menu location.', 'grand-hotel-europe' );
endif;
