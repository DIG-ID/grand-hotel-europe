# CLAUDE.md — Grand Hotel Europe

## Language
- Responder sempre em **português de Portugal** no chat.
- Comentários no código em **inglês (en-EN)**.

---

## Estado do projecto — ler primeiro

Tema anterior ao método actual da dig.id (o do Montela): Laravel Mix, campos
ACF só na base de dados, templates que imprimem campos sem escaping, títulos de
secção em `<h3>`, alinhamento com `pl-*`. O site está **em produção**.

A regra é: **código novo segue o método** (este ficheiro + `.claude/rules/`);
**o código antigo não é modelo** e não se reescreve sem pedido. Ao tocar num
ficheiro antigo, corrigir só o que se tocou.

O que já está preparado para secções novas (desde a 1.1.0):
- `ghe_text()` / `ghe_module_field()` — `inc/helpers.php`;
- ACF Local JSON só para grupos novos — `acf-json/` + `inc/acf-json.php`;
- `.claude/` — regras, agentes, ferramentas do Figma e de QA, skills `/deploy` e `/release`.

---

## Stack

- **WordPress** custom theme (text domain `grand-hotel-europe`, prefixo `ghe_` — as funções antigas usam `theme_`)
- **ACF Pro** (CPTs, options pages e field groups registados pelo ACF)
- **WPML** (DE + EN) + ACFML, **Yoast SEO**, **Contact Form 7**, **WP Rocket**, SG Security, Safe SVG, GTM
- **Tailwind CSS v3** + **SASS** + **Laravel Mix 6** (webpack)
- **JS**: GSAP + ScrollTrigger, Lenis, Swiper 11, Fancybox 5 (Isotope e imagesloaded no `package.json`, sem uso)
- Fontes: Typekit `lmo5nfm` (Source Serif 4, Barlow, Barlow Condensed) + Google Fonts (Gilda Display)

---

## Estrutura

```
grand-hotel-europe/
├── acf-json/                 # field groups NOVOS (chave legível) — ver "Campos ACF"
├── assets/
│   ├── js/                   # main.js (entry), gsap.js, swiper.js, megaMenu*.js, stickyHeader.js, google-maps.js
│   └── sass/                 # main.sass, _base-styles (grelha), _components/, _modules/, _pages/, _posts/, _archives/
├── dist/                     # compilado (vai no git — o WP Pusher não corre builds; não editar)
├── inc/                      # helpers.php, acf-json.php, template-tags, admin, breadcrumbs, menu walker, simple-booking
├── page-templates/
├── template-parts/
│   ├── modules/              # section-hero, section-intro, section-outro
│   ├── pages/{página}/       # secções de uma só página
│   ├── posts/{cpt}/          # singles
│   ├── archives/{cpt}/       # arquivos
│   └── header/               # header, mega-menu, language switcher
├── functions.php
├── webpack.mix.js
└── tailwind.config.js
```

---

## Ambiente local

- Site no Local: **`https://europe-luzern.digid`** (ID `smhgiu-eQ`). A base de
  dados é uma **cópia de produção** (Novembro 2026).
- **WP-CLI**, a partir de `/Users/bankz/Local Sites/grand-hotel-europe/app/public`:
  ```bash
  php -d error_reporting=0 -d mysqli.default_socket="$HOME/Library/Application Support/Local/run/smhgiu-eQ/mysql/mysqld.sock" /usr/local/bin/wp <comando>
  ```
  Se o Local recriar o site, o ID muda — ver `~/Library/Application Support/Local/sites.json`.
- Nunca correr `search-replace`, `db import` ou `db reset` sem o Bruno pedir.

## Comandos

```bash
npm install        # node_modules/ não está instalado
npm run dev        # build de desenvolvimento + BrowserSync (proxy em webpack.mix.js)
npm run prod       # build de produção — correr antes de commit/deploy
```

- O proxy do BrowserSync ainda aponta para `grand-hotel-europe.digid`; o site
  local é `europe-luzern.digid`.
- **`npm run php:lint` não funciona** (chama um `phpcs` global que não existe e
  ignora o `phpcs.xml.dist`). Até ser resolvido: `php -l` nos ficheiros tocados
  e revisão contra `.claude/rules/php.md`.

## Deploy

**WP Pusher**: o push para `main` (`github.com/DIG-ID/grand-hotel-europe`) **é**
o deploy. Usar o skill `/deploy`; nunca fazer push sem confirmação explícita.
- O `dist/` vai no commit (`npm run prod` antes).
- **Cache-busting = `Version:` do `style.css`** (o enqueue usa a versão do tema
  como `?ver=`; o `mix-manifest.json` não é lido). Sem subir a versão, os
  browsers e o WP Rocket servem o CSS/JS antigos.
- Grupo ACF novo: depois do deploy, **Sync** em produção (ACF → Field Groups).
- Depois do deploy: limpar a cache do WP Rocket.

---

## Grelha e tokens

Tabela completa e fórmulas em `.claude/rules/figma.md`. Resumo:

| | Container | Colunas | Gutter | Margens |
|---|---|---|---|---|
| Desktop ≥1280 | 1170px | 12 | 30.5px | auto |
| Tablet 768–1279 | fluido | 6 | 20px | 64px |
| Mobile <768 | fluido | 2 | 20px | 24px |

Breakpoint extra `mob-ls:` (telemóvel em landscape, ≤ 1023 × 500).

Cores (`tailwind.config.js`): `darker` #25211E · `dark` #333333 · `dark-2` #222222 · `gold` #A7986E · `cream` #F8F5F0.
Títulos (`_typography.sass`): `.title-main` (H1) · `.title-secondary` (H2) · `.title-small` (H3) · `.title-smaller` (H4) · `.overtitle`.
Botões (`_buttons.sass`): `.btn` + `-primary` (dourado) · `-secondary` (branco, filete dourado) · `-white-cream` (sobre escuro) · `-transparent`.
Molduras douradas nas fotos: `.framed__asymmetric--*` / `.framed__symmetric--*` (`_img-corners.sass`).

**Figma**: o link do ficheiro ainda não está registado aqui — acrescentar quando
o Bruno o der, com os frames de referência de cada breakpoint.

---

## Templates

| Template | Ficheiro | Secções (por ordem) | Field group |
|---|---|---|---|
| Home | `page-templates/page-home.php` | `pages/home/hero`, `modules/section-intro`, `pages/home/zimmer-suiten`, `seminare-bankette`, `travel-banner`, `restaurant-bar`, `offer`, `modules/section-outro` | Homepage CF + `group_section_offer` (JSON) |
| Das Hotel | `page-templates/page-hotel.php` | hero, `pages/hotel/intro`, `philosophy`, `history`, `testimonials`, outro | Das Hotel CF |
| Zimmer und Suiten | `page-templates/page-zimmer-suiten.php` | hero, intro, `pages/zimmer-suiten/zimmer`, `suiten`, outro | Zimmer und Suiten Page CF |
| Restaurant & Bar | `page-templates/page-restaurant-and-bar.php` | hero, intro, `pages/restaurant-and-bar/bellvue`, `terrace`, `gastronomie`, `bar`, outro | Restaurant & Bar CF |
| Gruppen | `page-templates/page-gruppen.php` | hero, `pages/gruppen/offers`, `your-stay`, `form` (CF7), outro | Gruppen CF |
| Region | `page-templates/page-region.php` | hero, intro, `pages/region/discover`, `activities`, outro | Region CF |
| Arrival & Contact | `page-templates/page-arrival-contact.php` | hero, `pages/arrival-contact/intro`, `form` (CF7), `infos` (Google Maps), outro | Arrival & Contact CF |
| Copyright | `page-templates/page-copyright.php` | hero, `pages/copyright/content`, outro | — |
| Design System | `page-templates/page-design-system.php` | `template-parts/design-system.php` | — |
| Página simples | `page.php` | `pages/page-header`, `pages/page-content` | — |
| Singles `zimmer` / `suiten` | `single-*.php` | hero, `posts/zimmer-suiten/content`, outro | Rooms and Suites Single CPT CF |
| Singles `bankette` / `seminare` | `single-*.php` | hero, `posts/bankette-seminare/content`, outro | Bankette Seminar Single CPT CF |
| Single `jobs` | `single-jobs.php` | hero, `posts/jobs/content`, `form` (CF7), outro | — |
| Arquivos dos 5 CPTs | `archive-*.php` | hero, intro, `archives/{cpt}/content`, outro | textos nas options pages "… Overview" |

Hero (Hero CF) e Outro (Section Outro CF; valores por omissão nas Booking
Settings) estão em todas as páginas. A Intro cai nas options quando a página a
deixa vazia (`options_prefix`).

## CPTs e options pages

Registados pelo **ACF** (na base de dados, não em código): CPTs `zimmer`,
`suiten`, `bankette`, `seminare`, `jobs`; options pages `theme-settings`,
`booking-settings`, `rooms-and-suites-overview`, `bankette-seminare`,
`jobs-overview`.

---

## Campos ACF

### Os grupos existentes — só na base de dados

16 grupos, com chaves geradas pelo ACF (`group_6967d1a662bf8`), já em modo
Expert do ACFML. Padrão: **um tab por secção e, dentro dele, um campo `group`
com o nome da secção** — `philosophy` → sub-campos guardados e lidos como
`philosophy_quote`, `philosophy_repeater` (`get_field( 'philosophy_quote' )`).

**Não editar, exportar nem voltar a gravar estes grupos em local.** Mudanças a
eles fazem-se no admin de produção. Ficam fora do `acf-json/` de propósito
(`inc/acf-json.php` só deixa gravar em JSON as chaves legíveis): uma cópia local
desactualizada gravada em JSON substituiria a de produção no deploy.

### Grupos novos — Local JSON, como no Montela

Cada secção nova tem **o seu grupo em `acf-json/`**, com **chave legível**
(é isso que o põe no git):

| Caso | Ficheiro | Location |
|---|---|---|
| Secção de uma só página | `group_section_{nome}.json` (activo) | o template da página (ou o post type), `menu_order` depois do grupo da página |
| Secção em ≥2 páginas | `group_module_{nome}.json` (activo) | uma regra OR por página |
| Mesma secção 2× na mesma página | módulo **inactivo** + grupo JSON por página com clones "Prefix field names" | — |

- Campos `section_{nome}_*`, chaves `field_section_{nome}_*`.
- **Nenhum campo obrigatório** (`required: 0`): o template decide o que aparece.
- `description` no máximo 50 caracteres; ao editar o JSON à mão, actualizar o `modified`.
- **WPML (ACFML)**: `"acfml_field_group_mode": "advanced"` e `wpml_cf_preferences`
  em cada campo — imagens e vídeo `1` (copy), o resto `2` (translate); tabs sem
  preferência; clones `1`.
- Um grupo criado no admin recebe uma chave gerada e fica **só na BD**. Para ir
  para o git, nasce como JSON (escrito pelo `module-builder`) e entra por Sync.
- **Importar em local por WP-CLI** (em vez do Sync): o ID do grupo na BD vem de
  `acf_get_field_group_post( $key )`, **nunca** de `acf_get_field_group( $key )['ID']`
  (devolve a cópia do JSON, ID 0, e cada import cria um duplicado):
  ```php
  $json = json_decode( file_get_contents( get_template_directory() . '/acf-json/group_section_foo.json' ), true );
  $post = acf_get_field_group_post( $json['key'] );
  $json['ID'] = $post ? $post->ID : 0;
  acf_import_field_group( $json );
  ```
  Confirmar que não há duplicados:
  `wp post list --post_type=acf-field-group --field=post_name | sort | uniq -d`.

**Leitura**: `ghe_module_field( 'section_foo_title', $args )` (respeita `prefix`,
`post_id`, `row`); numa secção só de uma página, `get_field()` serve.

---

## Como fazer uma secção nova

O fluxo do Montela, com os agentes de `.claude/agents/`. A sessão principal
orquestra, revê e faz os commits — nenhum agente faz commit nem push.

1. **Bruno dá**: a página, a posição na página e os nodes do Figma (desktop,
   tablet, mobile — um breakpoint confirmado de cada vez, se for à mão).
2. **`module-builder`**: procura primeiro uma secção existente com o mesmo
   desenho; senão constrói PHP (`template-parts/pages/{página}/` ou
   `modules/`), SASS e o grupo ACF em JSON, e liga a secção no template.
3. **Importar o grupo em local** (Sync ou WP-CLI, acima).
4. **`content-editor`**: preenche os campos da secção em local (texto, imagens
   do Figma em WebP, alt em alemão).
5. **`qa-reviewer`**: varre larguras de 320 a 2560 e o landscape, testa com
   conteúdo no limite e compara com o Figma; só reporta.
6. Corrigir, rever, `npm run prod`, `/release` (versão + changelog) e `/deploy`.
7. Em produção: Sync do grupo, preencher DE e EN, limpar a cache do WP Rocket.

| Agente | Modelo | Ferramentas próprias |
|---|---|---|
| `module-builder` | opus | `.claude/tools/fig.py` (MCP do Figma Desktop) |
| `content-editor` | sonnet | WP-CLI local, `cwebp`, arquivo de imagens fora do tema |
| `qa-reviewer` | sonnet | `.claude/tools/qa-check.mjs` (varrimento de larguras via CDP) |

Links para páginas que ainda não existem ficam com `#`.

---

## Convenções de escrita de código

Vivem em `.claude/rules/` e são vinculativas para código novo:

| Ficheiro | Cobre |
|---|---|
| `php.md` | escaping (`ghe_text()`), campos ACF, links com `target`, template parts, `$args` |
| `sass.md` | layout no PHP, colunas da grelha, `@apply`, tipografia, especificidade |
| `js.md` | um só bundle, onde entra um slider/animação, enqueue, build |
| `editor-content.md` | safelist do Tailwind, imagens do editor, CF7 |
| `figma.md` | a grelha (1170 / 12 col / 30.5px) e tags de título |

### PHPDoc (obrigatório em ficheiros novos)
```php
<?php
/**
 * Short description of what this file does.
 *
 * @package grand-hotel-europe
 * @subpackage Section
 * @since 1.1.0
 */
```
`@subpackage`: `Core` (functions/header/footer/index) · `Template` (templates de raiz e `page-templates/`) · `Section` (secções em `template-parts/`) · `Component` (partes pequenas reutilizáveis) · `Module` (sliders, acordeões) · `Functionality` (`inc/`) · `Helpers` (`inc/helpers.php`, template tags). Todas as funções com docblock, `@param` e `@return`.

### Semântica HTML
- Um `<h1>` por página (o hero); `<h2>` por secção; `<h3>` dentro da secção; overtitle = `<p class="overtitle">` (ver `figma.md`).
- `<section>` só com heading próprio; senão `<div>`.
- `alt` sempre; `loading="lazy"` por omissão, `eager` + `fetchpriority="high"` só no hero.
- Schema só pela API do Yoast — nunca microdata.

### i18n
- Strings traduzíveis com o text domain `grand-hotel-europe`.
- A string fonte segue o Figma, na língua em que lá está; sem texto no Figma,
  **alemão suíço (de-CH)**, formal (Sie), com **`ss`, nunca `ß`**.
- EN traduz-se no WPML String Translation.

---

## Versionamento & Changelog

**SemVer**. O `style.css` está em `1.0` e ainda não há `CHANGELOG.md`: a
primeira entrega com o método novo é a **1.1.0** (helpers, Local JSON,
`.claude/`) e cria o changelog ([Keep a Changelog](https://keepachangelog.com/),
entradas em inglês).

| Alteração | Incremento |
|---|---|
| Correcção / ajuste pequeno | PATCH |
| Secção, template ou funcionalidade nova | MINOR |
| Mudança estrutural / incompatível | MAJOR |

No fim de cada tarefa: sugerir a entrada do `CHANGELOG.md`, o `Version:` do
`style.css` (sincronizados) e a mensagem de commit `vX.Y.Z: summary` — ou
correr `/release`.

---

## NOTES.txt

Notas para rever no fim, na raiz do tema (criar quando aparecer a primeira):
**A. Regras para o starter**, **B. Decisões por confirmar** (desvios ao Figma,
textos sem origem no design — com quem confirma), **C. Erros no Figma**. Com
data, na sessão em que o caso aparece, e dizê-lo na resposta.

## Plugins
Não acrescentar plugins. Não duplicar o que o stack já faz: cache/minify/lazyload
é do WP Rocket, hardening do SG Security, schema do Yoast, SVG do Safe SVG.
