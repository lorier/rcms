<?php


// Register the Third Nav menu
add_action( 'init', 'rcms_register_portal_menu' );
function rcms_register_portal_menu() {
	register_nav_menu( 'portal-menu' ,__( 'Portal Navigation Menu' ));
}

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background
// add_theme_support( 'custom-background', array( 'wp-head-callback' => 'kickstart_background_callback' ) );

// Move menu to Header Right and remove the wrap div
remove_action( 'genesis_after_header','genesis_do_nav' ) ;
add_action( 'genesis_header_right','genesis_do_nav' );
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

// Unregister secondary navigation menu
// add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

// Unregister alternate layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Add custom background callback for background color
function kickstart_background_callback() {
    if ( ! get_background_color() ) {
        return;
    }
    printf( '<style>body { background-color: #%s; }</style>' . "\n", get_background_color() );
}

// Add support for 5-column footer widgets
// add_theme_support( 'genesis-footer-widgets', 4 );

// Add post formats
add_theme_support( 'post-formats', array( 'aside', 'status', 'quote' ) );

// Add excerpt support for pages, because pages deserve excerpts too
add_post_type_support( 'page', 'excerpt' );

// Image sizes
add_image_size( 'post_featured', 480, 290, true );
add_image_size( 'post_medium', 400, 218, true );
add_image_size( 'post_large', 573, 285, true );

// Allow shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'the_content_more_link', 'kickstart_read_more_link' );
// Modify the WordPress read more link
function kickstart_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">' . __( 'Read More', 'lean-kickstart' ) . '</a>';
}


//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
// add_action( 'genesis_header', 'rcms_secondary_nav', 1 );



add_action('genesis_header', 'rcms_subnav_portal_logins', 0);
function rcms_subnav_portal_logins(){

	$portals = wp_nav_menu( array( 
		'items_wrap'     => '<ul class="wrap"><span class="portal-title">Portal Login:</span>%3$s</ul>',
		'theme_location' => 'third-menu', 
		'container_class' => 'portal-logins genesis-nav-menu blah',
		'container_id'	=> 'portal-logins'		
		) );

	echo $portals;
}

// Customize the legal text
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	$output = '<p> &copy; Copyright ';
	$output .= date('Y');
	$output .= ' RCMS. All Rights Reserved.';
	echo $output;

}

// Remove Page Titles
add_action('genesis_before', 'rcms_remove_post_title');
function rcms_remove_post_title(){

	add_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
	
	if ( is_home() ){
	  	remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
	} 
	else if ( is_page() ){
		remove_action( 'genesis_entry_header', 'genesis_do_post_title');
	}
}
//Add ACF blocks 
add_action('genesis_after_header', 'rcms_add_header_text',15 );
function rcms_add_header_text(){
	$header_title = get_field('header_title');
	$header_subtitle = get_field('header_subtitle');
	if(is_front_page() && !empty($header_title) ){
		$output = '<div class="hero"><div class="wrap">';
		$output .= '<div class="hero-text ">';
		$output .= '<div class="hero-title">'.$header_title.'</div>';
		if(!empty($header_subtitle)){
			$output .= '<div class="hero-subtitle">'.$header_subtitle.'</div>';
		}
		$output .= '</div></div></div>';
		echo $output;
	}

}

// Enable shortcode use in widgets
add_filter('widget_text', 'do_shortcode');

// Add banner containers and titles
add_action('genesis_after_header', 'rcms_banner_strip' );
function rcms_banner_strip(){
	if ( !is_front_page() ){
		global $post;
		$output = '<div class="banner-strip"><h1 class="banner-title">';
		if ( is_page() ){
			$output .= get_the_title( $post ).'</h1></div>';
		}
		else if ( is_404() ){
			$output .= 'Page Not Found</h1></div>';
		}
		else if ( is_search() ) {
			$output .= 'Search Results</h1></div>';
		}
		else if ( is_home() || is_single() || is_archive() ){
			global $post;
			$title = apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title );
			$output .=  $title . '<br><span class="blog-subtitle">News, Insights & Opinions</span></h1></div>';
		} 
		else { //for all other possible options so the page layout doesn't break
			$output .= get_the_title( $post ).'</h1></div>';
		}
		echo $output;
	}
}
// Add "now viewing" to tag pages 
add_action('genesis_before_loop', 'rcms_add_tag_title');

function rcms_add_tag_title(){
	if (is_tag()){
		echo '<p class="tag-title">Viewing items tagged:</p>';
	}
}
// Change pagination button text 
add_filter( 'genesis_prev_link_text', 'rcms_review_prev_link_text' );
function rcms_review_prev_link_text() {
        $prevlink = 'Newer Posts';
        return $prevlink;
}
add_filter( 'genesis_next_link_text', 'rcms_review_next_link_text' );
function rcms_review_next_link_text() {
        $nextlink = 'Older Posts';
        return $nextlink;
}
// Change post meta text
add_filter( 'genesis_post_meta', 'rcms_post_meta_filter' );
function rcms_post_meta_filter($post_meta) {
if ( !is_page() ) {
	$post_meta = '[post_tags before="Tagged: "] [post_comments] [post_edit]';
	return $post_meta;
}}

// add_action('genesis_after_content', 'rcms_add_sidebar_to_single');
function rcms_add_sidebar_to_single(){
	global $post;
	if (is_singular($post)){
		genesis_do_sidebar();
	}
}
add_filter('get_the_archive_title', 'rcms_add_tag_leader_text');

function rcms_add_tag_leader_text($title){
	echo 'filter called';
	$prefix = '';
	if ( is_tag() ) {
		// $prefix = '<p>Viewing posts tagged:</p>';
		$title = single_tag_title( '<p>Viewing posts tagged:</p>', false );
	}
	return $title;
}
// remove genesis favicon
remove_action('genesis_meta', 'genesis_load_favicon');

add_filter( 'genesis_pre_load_favicon', 'rcms_favicon_filter' );
function rcms_favicon_filter( $favicon_url ) {
	$base = get_stylesheet_directory_uri();
	return  esc_url($base) . 'images/favicon.ico';
}

add_filter( 'genesis_post_info', 'rcms_post_info_filter' );
function rcms_post_info_filter($post_info) {
	if ( !is_page() ) {
		$post_info = '[post_date] by [post_author_posts_link]';
		return $post_info;
	}
}

// Move post info above the post title
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 8 );


add_action ( 'genesis_before_footer', 'kickstart_before_footer', 5 );
// Add the 'before footer' widget area (before the erm, footer)
function kickstart_before_footer() {
    genesis_widget_area( 'before-footer', array(
        'before' => '<section class="before-footer"><div class="wrap">',
        'after'  => '</div></section>',
    ) );
}
add_action ( 'genesis_before_footer', 'kickstart_footer_social', 15 );
// Add the 'footer social' widget area
function kickstart_footer_social() {
    genesis_widget_area( 'footer-social', array(
        'before' => '<section class="footer-social"><div class="wrap">',
        'after'  => '</div></section>',
    ) );
}

add_filter( 'genesis_search_text', 'kickstart_search_text' );
// Customize search form input box text
function kickstart_search_text( $text ) {
    $search_text = __( 'Search', 'lean-kickstart' );

    return $search_text;
}

add_filter( 'genesis_search_button_text', 'kickstart_search_button_text' );
// Customize search form input button text
function kickstart_search_button_text( $text ) {
    $searchbutton_text = __( 'Go', 'lean-kickstart' );

    return $searchbutton_text;
}

add_action( 'genesis_after_entry', 'kickstart_single_next_prev', 5 );
// Next / previous post links
function kickstart_single_next_prev() {
    // Only show on single pages
    if( !is_single() ) {
        return;
    }

    $previouspost_text =  __( 'Previous Post', 'lean-kickstart' );
    $nextpost_text     =  __( 'Next Post', 'lean-kickstart' );

    echo '<div class="archive-pagination pagination">';
        previous_post_link( '<div class="pagination-previous alignleft">%link</div>', $previouspost_text );
        next_post_link( '<div class="pagination-next alignright">%link</div>', $nextpost_text );
    echo '</div>';
}

add_action('wp_head', 'rcms_favicons' );
function rcms_favicons(){
    $blog_url = esc_url( get_stylesheet_directory_uri() ); 
    echo 
<<<EOT
    <link rel="apple-touch-icon" sizes="57x57" href="$blog_url/images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="$blog_url/images/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="$blog_url/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="$blog_url/images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="$blog_url/images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="$blog_url/images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="$blog_url/images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="$blog_url/images/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="$blog_url/images/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="$blog_url/images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="$blog_url/images/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="$blog_url/images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="$blog_url/images/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="$blog_url/images/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="$blog_url/images/manifest.json">
    <link rel="mask-icon" href="$blog_url/images/safari-pinned-tab.svg" color="#4a0c70">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="images/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">
EOT;
}
