<?php

/* Shortcodes */


// Override regular expression parsing limits. Too many shortcodes in
// a post will make PHP stop regex-evaluating that post.
ini_set('pcre.recursion_limit', 20000000);
ini_set('pcre.backtrack_limit', 10000000);


// [clear]
// To create a block whose CSS clears all floated elements.
function clear_shortcode() {
  return '<div style="clear: both;"></div>';
}
add_shortcode('clear', 'clear_shortcode');


// [pullquote]enclosed content[/pullquote]
// Enclosing.
function pullquote_shortcode($atts, $content = null) {
  return '<div class="pullquote">$content</div>';
}
add_shortcode('pullquote', 'pullquote_shortcode')

?>