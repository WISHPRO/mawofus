function include_page($slug) {
  $args = array(
    'name'        => $slug,
    'post_type'   => 'page',
    'post_status' => 'publish',
    'numberposts' => 1
  );

  $post = get_posts($args);

  if ($post)
    echo wpautop($post[0]->post_content);
  else
    echo "Page with slug &lsquo;$slug&rsquo; not found.";
}
