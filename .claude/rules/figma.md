# Figma → código

O MCP do Figma devolve **posições absolutas num canvas** — não é grid-aware.
Não devolve colunas, nem gutters, nem espaçamentos entre componentes: a coluna
tem de ser calculada à mão a partir dos pixéis.

## A grelha deste projecto

É isto que define o `.theme-container` e o `.theme-grid` em
`assets/sass/_base-styles.sass`:

```sass
.theme-container
  @apply px-6 md:px-16 xl:px-0 mx-auto w-full xl:max-w-[1170px]
.theme-grid
  @apply grid grid-cols-2 md:grid-cols-6 xl:grid-cols-12 gap-x-5 xl:gap-x-[30.5px]
```

| Breakpoint | Container | Colunas | Gutter | Coluna | Margens | Tailwind |
|---|---|---|---|---|---|---|
| Desktop (≥1280) | 1170 | 12 | 30.5px | 69.54px | (canvas − 1170) / 2 | `xl:grid-cols-12 xl:gap-x-[30.5px]` |
| Tablet (768–1279) | canvas − 128 | 6 | 20px | (container − 100) / 6 | 64px | `md:grid-cols-6 gap-x-5` |
| Mobile (<768) | canvas − 48 | 2 | 20px | (container − 20) / 2 | 24px | `grid-cols-2 gap-x-5` |

**Canvas por confirmar**: o repo não guarda o link do Figma. No primeiro frame
de cada breakpoint, ler a largura do canvas e preencher aqui (desktop: com um
canvas de 1440, margem 135px; tablet 834 → coluna 84.3px; mobile 393 → coluna
162.5px). Se o container desenhado não der 1170px, avisar antes de construir.

**Espaço horizontal entre colunas, cards e slides = o gutter da grelha**
(20px até tablet, 30.5px em desktop), mesmo quando o Figma desenha outro valor
— a regra é a consistência. Vale para grelhas próprias das secções e para o
`spaceBetween` dos sliders Swiper. Anotar no comentário do SASS o valor
original ("30.5px — 32 in Figma").

## Achar a coluna de um elemento

```
unidade = largura_da_coluna + gutter          (desktop: 69.54 + 30.5 = 100.04)
coluna N começa em x = margem_esquerda + (N − 1) × unidade
col = floor((element_left_px − margem_esquerda) / unidade) + 1
```

Exemplo desktop num canvas de 1440: col 1 em x 135, col 2 em 235, col 7 em
735.2, col 12 termina em 1305.

## Workflow

1. **Um breakpoint de cada vez** — desktop, confirmar, depois tablet, depois mobile.
2. **Uma secção de cada vez** — usar o node URL da secção, não o da página inteira.
3. Pedir sempre **screenshot + variáveis** junto com o design context.
4. Confirmar com **screenshot + grid overlay** depois de construir.
5. Cruzar com o `tailwind.config.js` e o `_typography.sass` para reutilizar
   tokens (cores, fontes, classes de título) em vez de inventar valores.

## Limitações a aceitar cedo

- Máscaras e formas recortadas do Figma **não se replicam** em HTML/CSS — simplificar para crops rectangulares. As molduras douradas nos cantos das fotos já existem: `.framed__*` (`_img-corners.sass`).
- O layout absoluto do Figma não mapeia 1:1 para um grid CSS responsivo.
- Valores para breakpoints intermédios são **interpolados** — escrever isso no comentário.
- Os números do frame podem não fechar: tratar a medida como tecto e deixar o CSS ceder.

## Tags de título: a tag segue a estrutura, a classe segue o Figma

O Figma diz o **aspecto** de cada título — isso dá a **classe** (`.title-small`).
A **tag** segue a estrutura da página, não o estilo:

- `<h1>`: um por página (o hero).
- `<h2>`: o título de **cada secção**, a intro incluída. Um título de secção com
  aspecto de H3 é `<h2 class="title-small">`.
- `<h3>`: títulos **dentro** de uma secção (cards, itens de lista, blocos).
- Nunca saltar níveis. Um overtitle (linha pequena por cima do título) **não é
  título**: `<p class="overtitle">`.

O código antigo do GHE faz o contrário (`<h2 class="overtitle">` +
`<h3 class="title-secondary">` na intro, `<h3>` como título de secção na
Philosophy). Numa secção nova, seguir a regra acima; se a página continuar
torta por causa das secções antigas, anotar no `NOTES.txt` em vez de corrigir
as outras sem pedido.

Porquê: com as secções em `<h3>`, um leitor de ecrã que navega por `<h2>` só
encontra a intro — a página parece ter uma secção. O SEO não ganha nada com a
tag a seguir o tamanho.
