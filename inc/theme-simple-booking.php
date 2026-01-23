<?php

add_action('wp_enqueue_scripts', function () {

  $hotel_id = '4015';

  // Pick language (simple version)
  $lang = 'DE';

  wp_register_script('simplebooking-syncrobox', '', [], null, true);
  wp_enqueue_script('simplebooking-syncrobox');

  $inline = "
	(function (i, s, o, g, r, a, m) {
			i['SBSyncroBoxParam'] = r; i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date(); a = s.createElement(o),
			m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'https://cdn.simplebooking.it/search-box-script.axd?IDA=" . esc_js($hotel_id) . "', 'SBSyncroBox');

	SBSyncroBox({
		CodLang: '" . esc_js($lang) . "',

		Labels: {
			CheckAvailability: { 'DE': 'VERFÜGBARKEIT PRÜFEN' }
		},

		Styles: {
			Theme: 'light-pink',

			// Brand / primary
			CustomColor: '#A7986E',
			CustomColorHover: '#8F835E',

			// Backgrounds (box + fields)
			CustomBGColor: '#FFFFFF',
			CustomFieldBackgroundColor: '#FFFFFF',
			CustomWidgetBGColor: '#FFFFFF',
			CustomCalendarBackgroundColor: '#FFFFFF',

			// Text / labels
			CustomLabelColor: '#25211E',
			CustomWidgetColor: '#25211E',
			CustomLinkColor: '#A7986E',

			// Buttons
			CustomButtonBGColor: '#A7986E',
			CustomButtonColor: '#FFFFFF',
			CustomButtonHoverBGColor: '#8F835E',

			// Icons / accents
			CustomIconColor: '#A7986E',
			CustomAccentColor: '#A7986E',
			CustomAccentColorHover: '#8F835E',

			// Shadows / focus ring (subtle warm)
			CustomBoxShadowColor: 'rgba(167,152,110,0.25)',
			CustomBoxShadowColorHover: 'rgba(167,152,110,0.35)',
			CustomBoxShadowColorFocus: 'rgba(167,152,110,0.55)',

			// Calendar selections (light warm highlight)
			CustomIntentSelectionDaysBGColor: 'rgba(167,152,110,0.15)',
			CustomSelectedDaysColor: 'rgba(167,152,110,0.22)',
			CustomIntentSelectionColor: '#A7986E',

			// Optional: match site typography
			FontFamily: '\"barlow\", ui-sans-serif, system-ui'
		}
	});
	";

  wp_add_inline_script('simplebooking-syncrobox', $inline, 'after');
});