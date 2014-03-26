<?php

// A useful place to store information that appears frequently across your site.


/* Example Constants */

define( 'PHONE', '(555) 555-5555' );
define( 'EMAIL', 'me@example.com' );


/* GET Function */

function get_info($constant_name, $as_a = 'number') {

  // Get value of constant after converting the requested constant to
  // uppercase and underscores. This allows 'phone number' to be used
  // instead of only 'PHONE_NUMBER' being acceptable.

  $constant = constant(strtoupper(str_replace(' ', '_', $constant_name)));

  return ($constant);
}

// Usage: echo get_info('PHONE');


/* GET Function with Numbers-as-words Capability. */

// NOTE: This requires the convert_number_to_words.php function, which
//       can be found at lib/convert_number_to_words.php should be
//       include'd/require_once'd in your functions file if you use
//       this function.
//
// This is useful when you have something like "We've been in business
// for nine years" and you want to store that year in a constant so it
// doesn't have to be updated across the site every year.
//
// In order to automate it, you'd want to define the start date and
// then another that constant that is variably defined, like so:

define( 'YEAR_FOUNDED',       '1999'    );
define( 'YEARS_IN_OPERATION', date('Y') - YEAR_FOUNDED);

function get_info($constant_name, $as_a = 'number') {

  // Get value of constant after converting the requested constant to
  // uppercase and underscores. This allows 'phone number' to be used
  // instead of only 'PHONE_NUMBER' being acceptable.

  $constant = constant(strtoupper(str_replace(' ', '_', $constant_name)));

  // Return a number as words (e.g., 'ten' instead of '10') if asked.
  if ($as_a === 'word' || $as_a === 'words')
    $constant = convert_number_to_words($constant);

  return ($constant);
}



/* GET Shortcode */



?>