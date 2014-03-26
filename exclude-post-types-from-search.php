<?php

function exclude_post_types_from_search($query) {
  // E.g.: exclude pages from search results.
  if ($query->is_search)
    $query->set('post_type', 'page');
  return $query;
}
add_filter('pre_get_posts', 'exclude_post_types_from_search');

?>