<div id="mega-menu" class="mega-menu-wrapper fixed top-0 left-0 w-full h-[100svh] inset-0 pointer-events-none opacity-0 bg-yellow-100 border-4 border-pink-500 z-50">

	<div class="js-mega-overlay absolute inset-0 bg-black/60"></div>

	<nav class="js-mega-panel relative bg-white h-full">
		<button class="mega-menu-button-close flex items-center space-x-3 cursor-pointer" type="button">
			<svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path class="mega-menu-button--icon stroke-gold" d="M1 1L21 13M21 1L1 13" stroke="#FFF" stroke-width="1.5"/>
			<span class="font-barlow font-semibold text-base text-gold uppercase"><?php esc_html_e( 'close', 'grand-hotel-europe' ); ?></span>
		</button>
		<ul>
			<li class="js-mega-item"><a href="">Item 1</a></li>
			<li class="js-mega-item"><a href="">Item 2</a></li>
			<li class="js-mega-item"><a href="">Item 3</a></li>
		</ul>
	</nav>
	<?php get_template_part( 'template-parts/header/navigation-mega-menu' ); ?>
</div>