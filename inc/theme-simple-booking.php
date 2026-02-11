<?php

add_action('wp_enqueue_scripts', function () {

  $hotel_id = '4015';

  // Detect current language (WPML)
  $site_lang = null;

  // WPML constant (often available)
  if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE) {
    $site_lang = ICL_LANGUAGE_CODE;
  }

  // WPML filter (safe fallback)
  if (!$site_lang && has_filter('wpml_current_language')) {
    $site_lang = apply_filters('wpml_current_language', null);
  }

  // Map WPML language to SimpleBooking CodLang
  // WPML returns lowercase like 'de' / 'en'
  $map = [
    'de' => 'DE',
    'en' => 'EN',
  ];

  $lang = $map[$site_lang] ?? 'DE'; // default to DE

  wp_register_script('simplebooking-syncrobox', false, [], null, true);
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
        CheckAvailability: {
          'DE': 'VERFÜGBARKEIT PRÜFEN',
          'EN': 'CHECK AVAILABILITY'
        }
      },

      Styles: {
        Theme: 'light-pink',
        CustomColor: '#A7986E',
        CustomColorHover: '#8F835E',
        CustomBGColor: '#FFFFFF',
        CustomFieldBackgroundColor: '#FFFFFF',
        CustomWidgetBGColor: '#FFFFFF',
        CustomCalendarBackgroundColor: '#FFFFFF',
        CustomLabelColor: '#25211E',
        CustomWidgetColor: '#25211E',
        CustomLinkColor: '#A7986E',
        CustomButtonBGColor: '#A7986E',
        CustomButtonColor: '#FFFFFF',
        CustomButtonHoverBGColor: '#8F835E',
        CustomIconColor: '#A7986E',
        CustomAccentColor: '#A7986E',
        CustomAccentColorHover: '#8F835E',
        CustomBoxShadowColor: 'rgba(167,152,110,0.25)',
        CustomBoxShadowColorHover: 'rgba(167,152,110,0.35)',
        CustomBoxShadowColorFocus: 'rgba(167,152,110,0.55)',
        CustomIntentSelectionDaysBGColor: 'rgba(167,152,110,0.15)',
        CustomSelectedDaysColor: 'rgba(248,245,240)',
        CustomIntentSelectionColor: '#A7986E',
        FontFamily: '\"barlow\", ui-sans-serif, system-ui'
      }
    });
  ";

  wp_add_inline_script('simplebooking-syncrobox', $inline, 'after');
}, 20);