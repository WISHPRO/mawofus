<?php

// Disable visual editor.
add_filter('user_can_richedit', create_function('$a', 'return false;') , 50);


// Remove admin toolbar navigation menu items.
function remove_admin_toolbar_items() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
  $wp_admin_bar->remove_menu('new-media');
  $wp_admin_bar->remove_menu('new-post');
}
add_action('wp_before_admin_bar_render', 'remove_admin_toolbar_items');


// Remove admin sidebar navigation menu items.
function remove_admin_sidebar_items() {
  remove_menu_page('index.php');           // Dashboard
  remove_menu_page('edit.php');            // Posts
  remove_menu_page('edit-comments.php');   // Comments
  remove_menu_page('link-manager.php');    // Links
  remove_menu_page('upload.php');          // Media
  remove_menu_page('options-general.php'); // Settings
  remove_menu_page('tools.php');           // Tools
}
add_action('admin_menu', 'remove_admin_sidebar_items', 999);


// Remove admin dashboard items.
function remove_dashboard_widgets() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


// Create custom admin dashboard item.
function add_custom_dashboard_widget() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget('custom_dashboard_widget', 'TITLE HERE', 'custom_dashboard_html');
}
function custom_dashboard_html() {
  echo '
<div style="font-size: 13px;">
  <p>Here is a custom dashboard widget.</p>
</div>';
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');


// Custom admin toolbar logo.
function customize_toolbar_logo() {
  echo '
  <style type="text/css">
  #header-logo { background-image: url(' . get_bloginfo('template_directory') . '/images/admin-toolbar-logo.png) !important; }
  </style>
  ';
}
add_action('admin_head', 'customize_toolbar_logo');


// Customize admin footer.
function remove_footer_admin () {
  echo '<p>You can say anything you want.</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');


// Remove columns from admin post list.
function remove_columns_from_post_list($columns) {
  unset($columns['date']);
  unset($columns['author']);
  unset($columns['comments']);
  return $columns;
}
function customize_columns() {
  add_filter('manage_pages_columns' , 'remove_columns_from_post_list');
}
add_action('admin_init' , 'customize_columns');


// Remove support for comments, authors, the except, revisions, and dates from pages.
function deactivate_post_type_support() {
  remove_post_type_support('page', 'comments');
  remove_post_type_support('page', 'author');
  remove_post_type_support('page', 'excerpt');
  remove_post_type_support('page', 'revisions');
  remove_post_type_support('page', 'date');
}
add_action('admin_init', 'deactivate_post_type_support');


// Remove admin author fields.
function remove_profile_fields($contactmethods) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  return $contactmethods;
}
add_filter('user_contactmethods', 'remove_profile_fields', 10, 1);


// Add admin author fields.
function add_user_fields($contactmethods) {
  $contactmethods['twitter'] = 'Twitter';
  $contactmethods['facebook'] = 'Facebook';
  return $contactmethods;
}
add_filter('user_contactmethods', 'add_user_fields', 10, 1);

?>