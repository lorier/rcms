<?php

//* Edit color picker
// http://urosevic.net/wordpress/tips/custom-colours-tinymce-4-wordpress-39/
add_filter( 'tiny_mce_before_init', 'rcms_tiny_mce_customization', 2 );
function rcms_tiny_mce_customization( $init ) {
    //colors
    $default_colours = '
     "000000", "Black",
     "FFFFFF", "White"
     ';
    $custom_colours = '
        "086db8", "RCMS blue",
	  	"f2a33b", "RCMS orange",
		"b2b2b2", "RCMS gray rule",
		"efede9", "RCMS lightest gray"
     ';
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
  
    return $init;
}
