<?php

// Allow for uploading a custom header image.
define('NO_HEADER_TEXT', true );
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/logo.gif'); // %s is the template dir uri
define('HEADER_IMAGE_WIDTH', 235);
define('HEADER_IMAGE_HEIGHT', 227);
function header_style() { ?><style type="text/css">/* #header_wrapper { background-image: url(<?php //header_image() ?>); } */</style><?php } // Commented out because the header background image isn't being used anymore.
function admin_header_style() { }
add_custom_image_header('header_style', 'admin_header_style');

?>