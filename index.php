<?php

/**
 * Kirby Sidenotes
 *
 * Tufte-style sidenotes for Kirbytext. Notes are placed in the page margin
 * on wide screens and fall back to inline note blocks on small screens.
 *
 * Usage in Kirbytext:
 *
 *   Some claim in your text.(fn: Source or comment, with an optional
 *   [markdown link](https://example.org).)
 *
 * `(sidenote: …)` works as an alias for `(fn: …)`.
 *
 * @author  mxmln
 * @license MIT
 * @link    https://github.com/mxmln/kirby-sidenotes
 */

if (function_exists('mxmln_sidenote_html') === false) {
    function mxmln_sidenote_html(Kirby\Text\KirbyTag $tag): string
    {
        static $counter = 0;
        $n = ++$counter;

        $text = trim($tag->value);

        // Convert markdown-style links [label](url) into anchors
        $text = preg_replace(
            '/\[([^\]]+)\]\(([^)\s]+)\)/',
            '<a href="$2" target="_blank" rel="noopener">$1</a>',
            $text
        );

        return '<sup class="sidenote-ref" id="sidenote-ref-' . $n . '">'
             .   '<a href="#sidenote-' . $n . '" aria-label="Sidenote ' . $n . '">' . $n . '</a>'
             . '</sup>'
             . '<small class="sidenote" id="sidenote-' . $n . '" role="note">'
             .   '<a class="sidenote-number" href="#sidenote-ref-' . $n . '" aria-hidden="true">' . $n . '</a> '
             .   $text
             . '</small>';
    }
}

Kirby::plugin('mxmln/sidenotes', [
    'tags' => [
        'fn' => [
            'html' => fn ($tag) => mxmln_sidenote_html($tag),
        ],
        'sidenote' => [
            'html' => fn ($tag) => mxmln_sidenote_html($tag),
        ],
    ],
]);
