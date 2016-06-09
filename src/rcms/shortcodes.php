<?php

// Remove for produt

// add_shortcode( 'clients-button', 'rcms_clients_button_shortcode' );
function rcms_clients_button_shortcode($atts, $content = null) {
    
    $a = shortcode_atts( array(
        'title' => 'Clients',
        'subtitle' => 'Create an Online Account',
        'link' => ''
        // ...etc
    ), $atts );

    $link =  $a['link']; 

     $short = '<a class="clients-button" target="_blank" href="';
     $short .= esc_url( $link );
     $short .= '"><div><h3>';
     $short .= $a['title'];
     $short .= '</h3>';
     $short .= '<p>';
     $short .= $a['subtitle'];
     $short .= '</p></div></a>';

     return $short;
}


// Linked Panel
// Location: Bottom of Mystery Shopping Page
// [linked-panel lin_url=""]
// [/linked-panel]
// Add Shortcode
add_shortcode( 'linked-panel', 'rcms_linked_panel' );

function rcms_linked_panel( $atts , $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'link_url' => '',
        ),
        $atts,
        'linked-panel'
    );
    $link = $atts['link_url'];

    $short = '<a class="linked-panel" href="';
    $short .= get_site_url().esc_url($link);
    $short .= '">';
    $short .= $content;
    $short .= '</a>';

    return $short;

}
// orange Panel
// [orange-panel]
// [/orange-panel]
add_shortcode( 'orange-panel', 'rcms_orange_panel' );
function rcms_orange_panel( $atts , $content = null ) {
    $atts = shortcode_atts(
        array(
            'class' => ''
        ),
        $atts,
        'orange-panel'
    );
    $class = $atts['class'];

    $short = '<div class="orange-panel ';
    $short .= esc_attr( $class );
    $short .= '">';
    $short .= do_shortcode($content);
    $short .= '</div>';

    return $short;
}

// Blue Panel
// [blue-panel]
// [/blue-panel]
add_shortcode( 'blue-panel', 'rcms_blue_panel' );
function rcms_blue_panel( $atts , $content = null ) {
        $atts = shortcode_atts(
        array(
            'class' => ''
        ),
        $atts,
        'blue-panel'
    );
    $class = $atts['class'];

    $short = '<div class="blue-panel ';
    $short .= esc_attr( $class );
    $short .= '">';
    $short .= do_shortcode($content);
    $short .= '</div>';

    return $short;
}

// white Panel
// [white-panel]
// [/white-panel]
add_shortcode( 'white-panel', 'rcms_white_panel' );
function rcms_white_panel( $atts , $content = null ) {
    $atts = shortcode_atts(
        array(
            'class' => ''
        ),
        $atts,
        'white-panel'
    );
    $class = $atts['class'];

    $short = '<div class="white-panel ';
    $short .= esc_attr( $class );
    $short .= '">';
    $short .= do_shortcode($content);
    $short .= '</div>';

    return $short;
}

//CTA button
//[cta-button link_text="" link_url="" class=""]
//
add_shortcode('cta-button', 'rcms_cta_button' );
function rcms_cta_button( $atts, $content = null ){
      $atts = shortcode_atts(
        array(
            'link_text' => 'Sign Up',
            'link_url' => '',
            'class' => ''
        ),
        $atts,
        'cta-button'
    );
    $link = $atts['link_url'];
    $link_text = $atts['link_text'];
    $class = $atts['class'];

    $short = '<a href="';
    $short .= esc_url($link);
    $short .= '" class="';
    $short .= esc_attr($class);
    $short .= '">';
    $short .= $link_text;
    $short .= '</a>';

    return $short;
}

// add_shortcode( 'sign-up-band', 'rcm_sign_up' );