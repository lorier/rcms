<?php

add_action( 'wp_enqueue_scripts', 'kickstart_fonts_scripts' );


// Enqueue fonts
function kickstart_fonts_scripts() {
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
    wp_enqueue_style( 'google-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic', array(), CHILD_THEME_VERSION );
      wp_enqueue_style( 'montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700', array(), CHILD_THEME_VERSION );

    wp_enqueue_script( 'kickstart-responsive-menu', get_stylesheet_directory_uri() . '/js/responsivemenu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
    $output = array(
        'mainMenu' => __( 'Menu', 'no-sidebar' ),
        'subMenu'  => __( 'Menu', 'no-sidebar' ),
    );
    wp_localize_script( 'kickstart-responsive-menu', 'KickstartL10n', $output );
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'rcms_enqueue_stickynav_script' );
function rcms_enqueue_stickynav_script() {
    wp_enqueue_script( 'sample-sticky-menu', get_stylesheet_directory_uri() . '/js/stickynav.js', array( 'jquery' ), '1.0.0' );
    wp_enqueue_script( 'core', get_stylesheet_directory_uri() . '/js/core.js', array( 'jquery' ), '1.0.0' );

}

// Enqueue Backstretch script and prepare images for loading
add_action( 'wp_enqueue_scripts', 'kickstart_enqueue_backstretch_scripts' );
function kickstart_enqueue_backstretch_scripts() {

    // Load scripts only if custom background or featured image is being used

    // If we're on a page with no featured image or background image, leave
    if ( is_page() && ! has_post_thumbnail() && ! get_background_image() ) {
        return;
    }

    // If we're not on a page and there's no background image, leave
    if ( ! is_page() && ! get_background_image() ) {
        return;
    }

    wp_enqueue_script( 'kickstart-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.js', array( 'jquery' ), '2.0.4' );
    wp_enqueue_script( 'kickstart-backstretch-set', get_stylesheet_directory_uri() . '/js/backstretch-set.js' , array( 'kickstart-backstretch' ), CHILD_THEME_VERSION );

    wp_localize_script( 'kickstart-backstretch-set', 'KickstartBackStretchImg', array( 'src' => str_replace( 'http:', '', get_background_image() ) ) );

    if ( is_home() ) {
        wp_localize_script( 'kickstart-backstretch-set', 'KickstartBackStretchImg', array( 'src' => str_replace( 'http:', '', get_background_image() ) ) );
    }
    else if ( has_post_thumbnail() ) {
        $image = array( 'src' => has_post_thumbnail() ? genesis_get_image( array( 'format' => 'url' ) ) : '' );
        wp_localize_script( 'kickstart-backstretch-set', 'KickstartBackStretchImg', $image );
    }
    else {
        wp_localize_script( 'milton-backstretch-set', 'KickstartBackStretchImg', array( 'src' => str_replace( 'http:', '', get_background_image() ) ) );
    }

}


