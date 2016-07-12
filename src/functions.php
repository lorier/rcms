<?php

add_action( 'genesis_setup', 'rcms_load_includes', 15 );
function rcms_load_includes() {
    foreach ( glob( dirname( __FILE__ ) . '/rcms/*.php' ) as $file ) { include $file; }
}

// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Set Localization (do not remove)
load_child_theme_textdomain( 'lean-kickstart', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'lean-kickstart' ) );


// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Reality Check Mystery Shopping' );
define( 'CHILD_THEME_URL', 'http://rcms.com' );
define( 'CHILD_THEME_VERSION', '0.0.1' );


