---
description: JavaScript house style — entry point, jQuery, Swiper, script enqueueing through Laravel Mix.
paths:
  - "assets/js/**/*.js"
  - "webpack.mix.js"
---

# JavaScript — convenções de escrita

### Entry point
Um só bundle: `assets/js/main.js` → `dist/js/main.js` (Laravel Mix). Importa
`gsap.js` (GSAP + ScrollTrigger + Lenis), `stickyHeader`, `megaMenu` e
`swiper.js`. O CSS do Swiper e do Fancybox entra pelo `main.sass`.

Não há a divisão crítico / atrasável do Montela (`animations.js`,
`assets/js/modules/`, `montela_enqueue_module()`). **Não a introduzir por causa
de uma secção** — é uma mudança ao build do projecto, a discutir com o Bruno.
Uma secção nova:
- slider → inicialização em `assets/js/swiper.js`, presa a um seletor da
  secção (`if ( ! el ) return;`), como as que lá estão;
- animação → função em `assets/js/gsap.js` (ver `initTravelBannerParallax()`),
  com `prefers-reduced-motion` respeitado e o conteúdo **visível sem JS**:
  estados iniciais com `gsap.from()`, nunca `opacity: 0` no CSS. Em produção
  corre o WP Rocket: com o *Delay JavaScript execution* ligado, o JS só corre
  depois da primeira interacção;
- outro comportamento → ficheiro próprio em `assets/js/`, importado no `main.js`.

### jQuery
O `webpack.mix.js` faz `autoload` do jQuery do npm (`$`, `jQuery`) e o tema
enfileira também o do WordPress. Código novo: **sem jQuery** (vanilla JS). Se
for mesmo preciso, em IIFE:
```javascript
/* globals jQuery */
(function ($) {
  document.addEventListener('DOMContentLoaded', function () { /* ... */ });
})(window.jQuery);
```

### Enqueue
`ghe_theme_enqueue_styles()` no `functions.php`. Os ficheiros são
`dist/css/main.css` e `dist/js/main.js` com a versão do tema como `?ver=` —
**o cache-busting depende do `Version:` do `style.css`** (o `mix.version()` gera
o `mix-manifest.json`, mas o PHP não o lê). Subir a versão em cada deploy.

Scripts só de uma página: `wp_enqueue_script()` dentro de um
`is_page_template( 'page-templates/page-foo.php' )`, como o Google Maps.

### Build
- `npm run dev` — build de desenvolvimento + BrowserSync. **O proxy do
  `webpack.mix.js` aponta para `grand-hotel-europe.digid`, mas o site no Local é
  agora `europe-luzern.digid`** — acertar antes de usar o BrowserSync.
- `npm run prod` — build de produção (minificado). Correr antes de commit/deploy.
  O `dist/` vai no git (o WP Pusher não corre builds).
- `node_modules/` não está instalado: `npm install` antes do primeiro build.

### Comentários
Em **inglês (en-EN)**, como todo o código.
