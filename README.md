# Kirby Sidenotes

Tufte-style sidenotes for [Kirby](https://getkirby.com). Write footnotes as a
KirbyText tag — on wide screens they appear in the page margin next to your
text (as popularized by [Edward Tufte's books](https://edwardtufte.github.io/tufte-css/)
and tufte-css), on small screens they fall back to indented note blocks in the
text flow. No JavaScript, no build step.

## Installation

**Composer (recommended)**

```bash
composer require mxmlnbln/kirby-sidenotes
```

**Manual**

Download or clone this repository into `site/plugins/sidenotes`.

## Usage

Write sidenotes directly in any KirbyText field:

```
The ceremony was postponed.(fn: Litprom announced the postponement in
October 2023; see [The Guardian](https://www.theguardian.com/...).)
```

`(sidenote: …)` works as an alias for `(fn: …)`. Markdown-style links
`[label](url)` inside the note are converted to anchors. Notes are numbered
automatically per page and rendered as:

```html
<sup class="sidenote-ref" id="sidenote-ref-1"><a href="#sidenote-1">1</a></sup>
<small class="sidenote" id="sidenote-1" role="note">…</small>
```

## Styling

Include the default stylesheet in your template — Kirby serves plugin assets
automatically:

```php
<?= css('media/plugins/mxmlnbln/sidenotes/sidenotes.css') ?>
```

Then theme it with CSS custom properties on your prose container (or `:root`):

```css
.prose {
  --sidenote-accent: #b7222b;   /* numbers, rules, link underlines */
  --sidenote-color: #666;       /* note text color */
  --sidenote-font-size: 0.78rem;
  --sidenote-width: 13rem;      /* width of the margin column */
  --sidenote-gap: 3rem;         /* gap between text and notes */
}
```

The margin layout activates at a viewport width of 1280px and places notes in
the right margin of your text column via a negative margin. Your text column
therefore needs at least `--sidenote-width + --sidenote-gap` of free space to
its right (a centered `max-width` column inside a wider page works out of the
box). Below 1280px, notes render as indented blocks with a colored rule.

Prefer your own styles? Skip the stylesheet and target `.sidenote-ref`,
`.sidenote` and `.sidenote-number` yourself.

## Notes & limitations

- Numbering is per rendered page (one running counter, also across multiple
  KirbyText fields on the same page).
- Avoid literal `)` inside the note text — it ends the KirbyText tag. Use
  the HTML entity `&#41;` if you need one.
- Words followed by a colon that match KirbyText attribute names (like
  `text:` or `title:`) inside a note can confuse the tag parser.

## License

[MIT](LICENSE.md)
