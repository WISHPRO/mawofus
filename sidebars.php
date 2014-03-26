<?php

// TODO: Clean up, add more example code.

// Register sidebars.
if(function_exists('register_sidebar'))
{
  register_sidebar(array(
    'before_widget' => '<div id="%2$s" class="widget %1$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}

?>