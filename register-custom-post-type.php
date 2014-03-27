<?php

// Register custom post type.
//
// Documentation: http://codex.wordpress.org/Function_Reference/register_post_type
// Generator: http://generatewp.com/post-type/

function add_custom_post_type() {

  $labels = array(
    'name'                => 'Post Types',
    'singular_name'       => 'Post Type',
    'menu_name'           => 'Post Type',
    'parent_item_colon'   => 'Parent Item:',
    'all_items'           => 'All Items',
    'view_item'           => 'View Item',
    'add_new_item'        => 'Add New Item',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit Item',
    'update_item'         => 'Update Item',
    'search_items'        => 'Search Item',
    'not_found'           => 'Not found',
    'not_found_in_trash'  => 'Not found in Trash',
  );

  $args = array(
    'label'               => 'post_type',
    'description'         => 'Post Type Description',
    'labels'              => $labels,
    'supports'            => array('title', 'editor'),
    'taxonomies'          => array('category', 'post_tag'),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => '', // Get the name from here: http://melchoyce.github.io/dashicons/
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );

  register_post_type('post_type', $args);

}
add_action('init', 'custom_post_type', 0);

?>
