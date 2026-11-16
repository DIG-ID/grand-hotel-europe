# PHP — convenções de escrita

> Padrões concretos de "como escrevemos secções". Complementa (não repete) as
> secções de PHPDoc, Semântica e i18n do `CLAUDE.md`.
>
> Prefixo `ghe_`, text domain `grand-hotel-europe`.
>
> **Código novo segue estas regras.** O código existente do tema ainda não as
> segue (echo sem escaping, `<h3>` como título de secção, `pl-*` para alinhar) —
> não copiar padrões de um template antigo só porque está ao lado. Ao tocar num
> ficheiro antigo, corrigir o que se tocou (boy-scout), sem reescrever o resto.

### PHP — output & escaping
- Sempre `<?php echo ?>` — **nunca** `<?= ?>`.
- Escaping por tipo: `esc_url()` (URLs/`href`/`src`), `esc_attr()` (atributos), `ghe_text()` (texto escrito no admin), `esc_html()` (texto do tema), `wp_kses_post()` (HTML rico de ACF/editor).
- **Nunca `the_field()` nem `echo get_field()` sem escaping** — é como está nos templates antigos (`hotel/philosophy.php`); numa secção nova, ler para uma variável e imprimir com a função certa.
- Imagens de media library: `wp_get_attachment_image( $id, 'full', false, array( 'class' => '...' ) )` — nunca montar `<img>` à mão quando há attachment ID.
- **Todo o campo de texto aceita HTML inline.** Campos `text` e `textarea` (e sub-campos de repeaters, títulos e excertos de posts) imprimem-se com `ghe_text()` (`inc/helpers.php`), nunca com `esc_html()`:
  ```php
  echo ghe_text( $foo_title );
  ```
  Deixa passar `<br>` (com `class`, para as quebras por breakpoint), `<strong>`, `<b>`, `<em>`, `<i>`, `<span class>`, `<sup>`, `<sub>` e `<a href target rel class>` — a lista está em `ghe_text_allowed_html()` (filtrável). Tudo o resto é removido. `esc_html()` imprimiria um `<br>` como texto; `wp_kses_post()` abriria a porta a imagens e blocos num campo de uma linha. Ver `editor-content.md`.
  - `esc_html()` fica para o que **não** se escreve num campo: strings do tema, rótulos de botões (links ACF), valores montados no código.
  - Um valor de campo que vá para um **atributo** (`aria-label`, texto `sr-only`) passa por `wp_strip_all_tags()` antes do `esc_attr()` / `esc_html()`.
  - Campos `wpautop` / WYSIWYG continuam com `wp_kses_post()`.
  - O PHPCS conhece a função (`customEscapingFunctions` no `phpcs.xml.dist`).

### PHP — acesso a campos ACF
```php
// Single com fallback
$image_id = get_field( 'hero_image' ) ?: get_post_thumbnail_id( $post_id );

// Link (devolve array) — validar antes de usar
$button = get_field( 'section_foo_button' );
if ( $button ) :
	$link_url    = $button['url'];
	$link_title  = $button['title'];
	$link_target = $button['target'] ?: '_self';
endif;

// Repeater
if ( have_rows( 'section_foo_items' ) ) :
	while ( have_rows( 'section_foo_items' ) ) :
		the_row();
		$sub = get_sub_field( 'title' );
	endwhile;
endif;

// Group (devolve array) — usar ! empty() para evitar notices
$group  = get_field( 'section_group_name' );
$img_id = ( $group && ! empty( $group['image'] ) ) ? $group['image'] : null;
```

**Link — ler SEMPRE o `target`.** O campo Link guarda `url`, `title` e `target`. Ler
só o `url` deita os outros fora e **não avisa**: o editor liga o "Open link in a new
tab", o valor fica guardado, e a página ignora-o.

```php
$foo_target = ( is_array( $foo_link ) && ! empty( $foo_link['target'] ) ) ? $foo_link['target'] : '';
// O rel anda sempre com o target — sem noopener a página aberta fica com window.opener.
echo '_blank' === $foo_target ? ' target="_blank" rel="noopener noreferrer"' : '';
```

**Naming ACF (secções novas):** snake_case com o prefixo da secção —
`section_{nome}_title`, `section_{nome}_button`, `section_{nome}_items`. Os campos
antigos do tema não têm prefixo (`intro_title`, `philosophy_quote`) — **não os
renomear**: o conteúdo em produção depende desses nomes.

**Clone:** clonar sempre o **grupo**, nunca um repeater dentro dele — um repeater
clonado guarda uma referência composta que o `have_rows()` não resolve, e o admin
continua a mostrar os valores enquanto a página não desenha nada.

**Nomes de variáveis:** o PHPCS rejeita `$title`, `$tag`, `$link` e outros globais
reservados do WordPress como variáveis locais num template. Prefixar com uma
abreviatura da secção — `$foo_title`, `$cta_link`.

**Nunca declarar funções dentro de um template part.** O `modules/section-intro.php`
declara `theme_resolve_field()` lá dentro: se o template for incluído duas vezes
na mesma página, é um fatal error. Funções vão para `inc/helpers.php`, com
`if ( ! function_exists() )`.

### PHP — template parts & hooks
- Toda a secção via `get_template_part()`:
  ```php
  get_template_part( 'template-parts/modules/section', 'foo' );   // secção reutilizável
  get_template_part( 'template-parts/pages/hotel/foo' );         // secção só de uma página
  ```
- **Onde colocar o ficheiro da secção** (decidir por reutilização):
  - Secção **reutilizada em ≥2 páginas/templates** → `template-parts/modules/` (PHP) + estilo em `_modules/` (SASS).
  - Secção **presa a uma só página** → `template-parts/pages/{página}/` (PHP) + estilo em `_pages/` (SASS).
- Um módulo recebe o contexto por `$args`, nunca o assume: `post_id` (para ler das Options numa archive) e `prefix` (para o mesmo módulo servir duas secções da mesma página). Ler com `ghe_module_field()`:
  ```php
  $foo_title = ghe_module_field( 'section_foo_title', $args );
  ```
  (Os módulos antigos usam `get_query_var( 'options_prefix' )` para cair nas Options — não repetir esse padrão em código novo; passar `post_id => 'option'` nos `$args`.)
- Uma secção sai cedo quando não tem conteúdo (`return`), em vez de desenhar uma secção vazia.
- Hooks: `function ghe_nome() { ... } add_action( 'hook', 'ghe_nome' );` — prefixo `ghe_` em funções novas (as antigas usam `theme_`; não renomear).

### PHP — dois erros a evitar
1. **Body text de ACF textarea (`new_lines: wpautop`) já vem em `<p>`** — nunca voltar a envolver em `<p>` (cria `<p><p>` inválido e perde as classes Tailwind). Usar `<div>`:
   ```php
   // ERRADO: <p class="text-darker pb-10"><?php echo wp_kses_post( $body ); ?></p>
   <div class="pb-10"><?php echo wp_kses_post( $body ); ?></div>
   ```
2. **Cor de texto** — as classes de tipografia (`.title-secondary`, `.title-small`, `.overtitle`) não trazem cor. Definir a cor **no container**, para os filhos (incl. `<p>` do wpautop) herdarem:
   ```php
   <div class="bg-darker text-cream section-foo__text"> ... </div>
   ```
   Tokens de cor do GHE (`tailwind.config.js`): `darker` `#25211E`, `dark` `#333333`, `dark-2` `#222222`, `gold` `#A7986E`, `cream` `#F8F5F0`.

### Lint
`npm run php:lint` ainda não funciona neste projecto (o script chama um `phpcs`
global que não existe e passa `--standard=WordPress` por cima do
`phpcs.xml.dist`; o `composer.json` não traz o PHPCS nem o WPCS). Até isso
estar resolvido: `php -l` em cada ficheiro tocado e rever à mão contra estas
regras. Quando funcionar, correr só nos ficheiros tocados — no tema inteiro dá
centenas de erros no código antigo.
