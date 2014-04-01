<?php

// TODO: Clean up and generalize.

// Help: http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types

// Remove the default 'Date' column from the post list and replace it with the start_date field.

// Register the column
function start_date_column_register( $columns ) {
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "start_date" => "Date"
  );
  return $columns;
}
add_filter("manage_edit-event_columns", "start_date_column_register");

// Display the column content
function start_date_column_display( $column_name, $post_id ) {
  if ( 'start_date' != $column_name )
    return;

  $start_date = get_post_meta($post_id, 'start_date', true);
  if ( !$start_date )
    $start_date = '<em>undefined</em>';

  print(date("F d, Y", strtotime($start_date)));
}
add_action( 'manage_posts_custom_column', 'start_date_column_display', 10, 2 );

// Register the column as sortable
function start_date_column_register_sortable( $columns ) {
  $columns['start_date'] = 'start_date';

  return $columns;
}
add_filter( 'manage_edit-event_sortable_columns', 'start_date_column_register_sortable' );

function start_date_column_orderby( $vars ) {
  if ( isset( $vars['orderby'] ) && 'start_date' == $vars['orderby'] ) {
    $vars = array_merge( $vars, array(
      'meta_key' => 'start_date',
      'orderby' => 'meta_value'
    ) );
  }

  return $vars;
}
add_filter( 'request', 'start_date_column_orderby' );

?>