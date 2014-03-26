<?php

// Get tags used by posts in a certain category.
// Usage: echo $get_category_tags('monthly_features');

function get_category_tags($category)
{
  global $wpdb;

  $category = strtolower(get_cat_name($category));

  $tags = $wpdb->get_results("
    SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, terms2.slug as tag_slug, null as tag_link
    FROM
      wp_posts as p1
      LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
      LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
      LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

      wp_posts as p2
      LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
      LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
      LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
    WHERE
      t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN '" . $category . "' AND
      t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
      AND p1.ID = p2.ID
    ORDER by tag_name
  ");

  $count = 0;

  foreach ($tags as $tag) {
    $tags[$count]->tag_link = get_tag_link($tag->tag_id);
    $count++;
  }

  $tag_list .= '<ul class="tag-list">';

  foreach ($tags as $tag)
  {
    // If we're currently one of these tag's tag page, add a class to the list item.
    if ($_REQUEST['tag'] == $tag->tag_slug)
      $tag_list .= '<li class="current-tag">';
    else
      $tag_list .= '<li>';

    $tag_list .= '<a href="/' . $category . '/?tag=' . $tag->tag_slug . '">' . $tag->tag_name . '</a></li>';
  }

  return($tag_list);
}

?>