<?php

// TODO: Clean up and generalize.

// Help: http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types

// Remove the default 'Date' column from the post list and replace it with the start_date field.

// Set custom columns for 'Positions' admin.
function change_edit_position_columns($columns) {

  $columns = array(
    'cb'       => $columns['cb'],
    'order'    => 'Order',
    'title'    => 'Position',
    'subtitle' => '',
    'name'     => 'Name',
    'category' => 'Category'
  );

  return $columns;
}
add_filter('manage_position_posts_columns', 'change_edit_position_columns');


// Fill in the custom columns.
function populate_position_columns($column, $post_id) {
  global $post;

  switch($column) {
    case 'order':
      echo $post->menu_order;
      break;

    case 'subtitle':
      echo get_post_meta($post_id, 'position_subtitle', true);
      break;

    case 'name':
      echo get_post_meta($post_id, 'name', true);
      break;

    case 'category':
      echo get_post_meta($post_id, 'category', true);
      break;

    default:
      break;
  }
}
add_action('manage_position_posts_custom_column', 'populate_position_columns', 10, 2);


// Register custom columns as sortable
function register_position_columns_as_sortable($columns) {
  $columns['order']    = 'menu_order';
  $columns['name']     = 'name';
  $columns['category'] = 'category';
  return $columns;
}
add_filter('manage_edit-position_sortable_columns', 'register_position_columns_as_sortable');


// Adjust admin list column widths.
function adjust_position_column_widths() {
    print('
      <style type="text/css">
      .post-type-position .column-order     { width: 10% !important }
      .post-type-position .column-title     { width: 25% !important }
      .post-type-position .column-category  { width: 20% !important }
      .post-type-position .column-position  { width: 50% !important }
      </style>');
}
add_action('admin_head', 'adjust_position_column_widths');


?>