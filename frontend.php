<?php

// RSS feed links.
automatic_feed_links();


// Allow for post thumbnails.
add_theme_support('post-thumbnails');


// Stop Wordpress from putting spurious paragraph tags all over the place.
remove_filter('the_content',  'wpautop');
remove_filter('the_excerpt',  'wpautop');


// Change excerpt length.
function change_excerpt_length($length) {
  return 25;
}
add_filter('excerpt_length', 'change_excerpt_length');


// Change the excerpt 'more...' link. E.g., change the bracketed fake
// ellipsis to a real ellipsis without brackets.
function change_excerpt_more_link($more) {
  return '&hellip;';
}
add_filter('excerpt_more', 'change_excerpt_more_link');


// Disable automatic inline gallery styles.
function remove_gallery_inline_css($css) {
  return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter('gallery_style', 'remove_gallery_inline_css');


// Add page slug as nav item ID.
function nav_id_filter( $id, $item ) {
  return 'nav-'.sanitize_title($item->title);
}
add_filter( 'nav_menu_item_id', 'nav_id_filter', 10, 2 );


// Add page slug as body class, and include the page parent.
function my_body_classes($classes, $class='') {
  global $wp_query;

  $post_id = $wp_query->post->ID;

  if(is_page($post_id )){
    $page = get_page($post_id);
    //check for parent
    if($page->post_parent>0){
      $parent = get_page($page->post_parent);
      $classes[] = 'page-'.sanitize_title($parent->post_title);
    }
    $classes[] = 'page-'.sanitize_title($page->post_title);
  }

  if(in_category('Blog'))
    $classes[] = 'category-blog';

  if(in_category('Press'))
    $classes[] = 'category-press';
  return $classes;// return the $classes array
}
add_filter('body_class','my_body_classes');

?>