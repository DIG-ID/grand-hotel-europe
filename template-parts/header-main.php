<?php
/**
 * The Section for the Header Template.
 *
 * @package website-name
 * @subpackage Section
 * @since 1.0.0
 */

?>
<header id="header-main" class="header-main" itemscope itemtype="http://schema.org/WebSite">

	<div class="main-navigation-wrapper relative z-40 py-4 md:py-8 xl:pt-5 xl:pb-4">
		<div class="theme-container theme-grid gap-y-5  ">
			
			<div class="main-navigation--top col-span-12 relative z-30">
				<?php get_template_part( 'template-parts/header/site-branding' ); ?>
			</div>


			<div class="main-navigation--bottom col-span-12 flex justify-between items-center">
				<div class="relative z-40">
					<?php get_template_part( 'template-parts/header/button-mega-menu' ); ?>
				</div>
				<div class="">
					<?php get_template_part( 'template-parts/header/navigation-main' ); ?>
				</div>
				<div class="flex items-center gap-x-4 relative z-40">
					<?php get_template_part( 'template-parts/header/language-switcher' ); ?>
					<?php get_template_part( 'template-parts/header/button-book-now' ); ?>
				</div>
			</div>

		</div>
	</div>

	<?php get_template_part( 'template-parts/header/mega-menu' ); ?>

</header>
