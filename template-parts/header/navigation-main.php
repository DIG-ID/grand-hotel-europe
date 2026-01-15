<?php
if ( has_nav_menu( 'main-menu') ) :
	wp_nav_menu(
		array(
		'theme_location' => 'main-menu',
		'menu_class' => 'main-menu',
		)
	);
else :
	esc_html_e( 'Please assign a menu to the main-menu location.', 'grand-hotel-europe' );
endif;
