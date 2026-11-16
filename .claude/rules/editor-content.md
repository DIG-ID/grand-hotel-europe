# Conteúdo vindo do editor

Regras para tudo o que **não está no código**: markup escrito num campo ACF, um
formulário do Contact Form 7, uma imagem carregada na media library. Todas
falham em silêncio.

---

## 1. O Tailwind nunca lê a base de dados

O Tailwind gera CSS a partir dos ficheiros que o `content` do
`tailwind.config.js` manda ler (`.php` do tema). **Nunca lê a base de dados.**
Uma classe escrita num campo ACF, num formulário do CF7 ou no editor do
WordPress não existe no CSS compilado, e não há erro nenhum a avisar.

Qualquer classe que viva na base de dados tem de estar no `safelist`. **O GHE
ainda não tem nenhum** — criar quando for preciso:

```js
// tailwind.config.js
safelist: [
  'hidden',
  'md:hidden',
  'md:inline',
  'xl:hidden',
  'xl:inline',
],
```

O GHE já tem uma excepção feita à mão: `.color-gold` em `_base-styles.sass`,
para texto dourado escrito em campos ACF (`<span class="color-gold">`). Usar
essa em vez de `text-gold` num campo.

### Quebras de linha responsivas nos títulos

| Onde quebra | Markup |
|---|---|
| Só mobile (< 768px) | `<br class="md:hidden">` |
| Só tablet (768–1279px) | `<br class="hidden md:inline xl:hidden">` |
| Tablet e mobile (< 1280px) | `<br class="xl:hidden">` |
| Todos os tamanhos | `<br>` |

**Pôr sempre um espaço de um dos lados do `<br>`** — nos tamanhos em que fica
`display:none`, é esse espaço que separa as palavras. Só funciona com o
`safelist` acima e com o campo impresso por `ghe_text()` (ver `php.md`).

---

## 2. Imagens carregadas pelo editor dimensionam-se pelo ficheiro

`h-auto` numa imagem vinda da media library entrega o tamanho a quem fez o
upload. **Dar sempre uma altura fixa por breakpoint** (ou `aspect-*` +
`object-cover`) a imagens que têm de ficar consistentes:

```php
'class' => 'w-full h-[300px] md:h-[420px] xl:h-[560px] object-cover',
```

Logos (parceiros, selos): dimensionar por **altura**, não por largura.

---

## 3. O Contact Form 7 injecta markup dentro do fluxo

O CF7 insere o aviso de validação (`.wpcf7-not-valid-tip`) **dentro** do
`.wpcf7-form-control-wrap`. Em fluxo normal, um campo que falha empurra tudo
para baixo. Tirar do fluxo quando há folga entre campos (≥ 24px):

```sass
.wpcf7-form-control-wrap
  @apply relative
.wpcf7-not-valid-tip
  @apply absolute left-0 top-full
```

O template do formulário vive no plugin, não no tema: as classes que usa têm
de estar **declaradas no SASS do tema** (`_components/_forms.sass`), com o
template copiado num comentário no topo do parcial.

No GHE o CF7 só carrega nos templates listados em `ghe_page_has_cf7_form()`
(`functions.php`). **Um formulário numa página nova = acrescentar o template a
essa função**, senão o form aparece sem JS nem CSS do plugin.

---

## 4. O CF7 traz as suas próprias strings traduzidas

O locale escolhido decide o tratamento e a ortografia: `de_DE` é informal (du);
`de_CH` é formal e usa ortografia suíça (**`ss`, nunca `ß`**). Num hotel em
Luzern, `de_CH`. Corrigir o locale, não as strings uma a uma.
