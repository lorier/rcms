<?php

add_theme_support( 'genesis-footer-widgets', 4 );


// Unregister sidebars
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar-alt' );

// Register widget areas
genesis_register_sidebar( array(
    'id'          => 'home-top',
    'name'        => __( 'Home Top', 'lean-kickstart' ),
    'description' => __( 'This is the top section of the homepage.', 'lean-kickstart' ),
) );

genesis_register_sidebar( array(
    'id'          => 'before-footer',
    'name'        => __( 'Before Footer Widgets (Twitter)', 'lean-kickstart' ),
    'description' => __( 'Works well with the Genesis Latest Tweets plugin.', 'lean-kickstart' ),
) );
genesis_register_sidebar( array(
    'id'          => 'footer-social',
    'name'        => __( 'After Footer Widgets (Social)', 'lean-kickstart' ),
    'description' => __( 'Designed to work with the Simple Social Icons widget.', 'lean-kickstart' ),
) );

// Add widget for the sitemap and privacy policy
genesis_register_sidebar( array(
	'id'          => 'footer_legal_links',
	'name'        => __( 'Footer Legal Links', 'lean-kickstart' ),
	'description' => __( 'These are the links below the legal text in the footer', 'lean-kickstart' ),
) );
add_action('genesis_footer', 'rcms_output_legal_links_widget', 10);
function rcms_output_legal_links_widget(){
	genesis_widget_area( 'footer_legal_links', array( 'before' => '<div class="legal-links">', 'after' => '</div>') );
}


// Side navigation menus

// Services
genesis_register_sidebar( array(
	'id'            => 'services-sidebar',
	'name'          => __( 'Services Sidebar', 'lean-kickstart' ),
	'description'   => __( 'This is the side navigation for Services', 'lean-kickstart' ),
) );


// Expertise
genesis_register_sidebar( array(
	'id'            => 'expertise-sidebar',
	'name'          => __( 'Expertise Sidebar', 'lean-kickstart' ),
	'description'   => __( 'This is the side navigation for Expertise', 'lean-kickstart' ),
) );


// Expertise
genesis_register_sidebar( array(
	'id'            => 'exam-sidebar',
	'name'          => __( 'Your Exam Sidebar', 'lean-kickstart' ),
	'description'   => __( 'This is the side navigation for Client Exams', 'lean-kickstart' ),
) );

add_action('genesis_sidebar', 'rcms_output_services_sidebar', 10);
function rcms_output_services_sidebar(){
	if ( is_page_template('page-services.php') ){
		genesis_widget_area( 'services-sidebar', array( 'before' => '<div class="side-menu">', 'after' => '</div>') );
	} else if ( is_page_template('page-expertise.php') ){
		genesis_widget_area( 'expertise-sidebar', array( 'before' => '<div class="side-menu">', 'after' => '</div>') );
	} else if ( is_page_template('page-exam.php') ){
		genesis_widget_area( 'exam-sidebar', array( 'before' => '<div class="side-menu">', 'after' => '</div>') );
	}
}

