---
description: SASS and Tailwind house style — @apply, naming, breakpoints, recurring layout patterns.
paths:
  - "assets/sass/**/*.sass"
  - "tailwind.config.js"
---

# SASS / Tailwind — convenções de escrita

### Naming
- Tailwind para layout/spacing/responsive; SASS para componentes custom — não duplicar.
- Classes custom em kebab-case, semânticas. BEM-inspired em componentes complexos: `section-foo`, `section-foo__media`, `section-foo--reverse`.
- Secções: `.section-{nome}` · Botões: `.btn .btn-primary` / `-secondary` / `-white-cream` / `-transparent` (`_components/_buttons.sass`) · Molduras douradas das imagens: `.framed__asymmetric--*` / `.framed__symmetric--*` (`_components/_img-corners.sass` — lista das classes no topo do ficheiro).
- Wrappers de layout: `.theme-container` (largura máxima 1170px + margens) e `.theme-grid` (12/6/2 colunas), em `_base-styles.sass` — valores na tabela do `figma.md`.
- Manter a ordem de imports do `main.sass`; uma secção nova entra no índice da pasta (`_modules/_modules.sass`, `_pages/_pages.sass`…).

### Layout no PHP, não no SASS (Bruno, Outubro 2026)
- **Colunas, paddings, margens, gaps e `max-w` das secções escrevem-se no PHP**, como classes Tailwind no markup — não em `@apply` no SASS.
- **Posição horizontal de texto e imagens = colunas da grelha** (`col-start-*` / `col-span-*`), nunca `pl-*`, `ml-*`, larguras em `%`/`calc()` ou larguras fixas. Para alinhar um bloco interior às colunas usar `grid-cols-subgrid` (Tailwind 3.4). Uma subgrid herda o gap de colunas do pai **só se não lhe deres outro** — um `gap-*` no elemento também muda o das colunas: usar `gap-y-*` ou repor `gap-x-5 xl:gap-x-[30.5px]`.
- `max-w-*` só para limitar **caixas de texto** dentro das colunas.
- Valores do Figma que caem fora das colunas → arredondar para a coluna e escrever no comentário do SASS o que estava desenhado.
- Uma variante (ex.: `--reverse`) troca as classes no PHP com uma condição, em vez de regras no SASS.
- **Uma propriedade vive num só sítio.** Um `md:max-w-none` no PHP pode ganhar a um `xl:max-w-[585px]` do SASS — a ordem entre utilitários responsivos e parciais não é fiável. Ao pôr uma propriedade no PHP, tirar do SASS todos os breakpoints dela.
- O SASS da secção fica com: o comentário das medidas (Figma ids, valores desenhados vs. arredondados), sobreposições de tipografia com duas classes, e CSS que não tem utilitário (pseudo-elementos, `:has()`, Swiper).

O código antigo do tema não segue este modelo (`pl-6 md:pl-0`, `!text-[...]` em
cima das classes de título). Numa secção nova, não copiar.

### @apply (componentes e o que não é layout de secção)
```sass
.title-secondary
  @apply font-source text-[2.188rem] md:text-[2.75rem] xl:text-[3.375rem] leading-[2.5rem] md:leading-[3.125rem] xl:leading-[3.75rem] font-normal
```

- Uma classe = uma linha `@apply` com os utilitários; **valores arbitrários** quando não há token.
- **Responsive** com os breakpoints por omissão do Tailwind. Vocabulário: **mobile** < `md` (768) · **tablet** entre `md` e `xl` · **desktop** ≥ `xl` (1280). Mobile-first: valor base, depois `xl:`; `md:` só quando o design dá um valor próprio para tablet.
- **`mob-ls:`** é um breakpoint próprio do GHE (`tailwind.config.js`): telemóvel em landscape (≤ 1023 × 500). Os templates antigos usam-no para baixar alturas de imagens; numa secção nova, testar a 844 × 390 e usar só se a secção partir.
- **Tipografia sem cor** — a cor define-se no container. Excepção: links inline.
- Fontes: `font-source` (títulos — Source Serif 4), `font-gilda` (títulos pequenos — Gilda Display), `font-barlow` (texto), `font-barlowCondensed` (overtitle, breadcrumbs). Typekit `lmo5nfm` + Google Fonts (Gilda), enqueue no `functions.php`.
- **Usar as classes de título existentes** (`_components/_typography.sass`): `.title-main` (H1), `.title-secondary` (H2), `.title-small` (H3), `.title-smaller` (H4), `.overtitle`. Se o Figma tiver um tamanho que nenhuma tem, criar uma classe nova em `_typography.sass` em vez de forçar com `!text-[...]` no markup.
- CSS puro só quando não há utilitário equivalente.

### Especificidade — duas armadilhas
- `@tailwind utilities` é emitido **antes** dos parciais. Uma classe escrita aqui ganha a um utilitário de igual especificidade só pela ordem — mas perde para uma classe partilhada se tiver a mesma contagem. Para sobrepor uma classe partilhada, usar **duas classes** (`.section-foo .title-small`), nunca `!important`.
- Um utilitário `px-*` numa media query posterior **repõe** `padding-right`. Quando um lado é diferente do outro, escrever `pl-*` e `pr-*` separados.

### Padrões recorrentes
```sass
// Colunas de grid com altura igual (imagem enche a célula esticada).
// No HTML: .theme-grid.items-stretch — a imagem precisa de h-full.
.section-foo__img
  @media (min-width: 1280px)
    height: 100%
  img
    width: 100%
    height: 100%
    object-fit: cover

// Imagem que "sangra" até à direita do viewport, além do container de 1170px.
$container: 1170px
.section-foo__wide-img
  @media (min-width: #{$container + 1px})
    margin-right: calc(-1 * (100vw - #{$container}) / 2)
    width: calc(100% + (100vw - #{$container}) / 2)
// (o <main> já tem overflow-hidden — inc/theme-template-tags.php)
```

### Espaço vertical entre secções
Margens de irmãos adjacentes **colapsam**: o espaço entre duas secções é a
**maior** das duas margens, não a soma — para mudar o espaço, mudar as duas.
No GHE as secções usam sobretudo **padding** (`pb-20 md:pb-24 xl:pb-36`), que
não colapsa: confirmar qual dos dois a secção vizinha usa antes de acertar o
espaço, e documentar o valor no comentário de ambas.
