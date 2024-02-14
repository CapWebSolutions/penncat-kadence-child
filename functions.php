<?php

namespace Penncat;

/**
 * Enqueue child styles.
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/style.css', array(), 100 );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\child_enqueue_styles' ); 

/**
 * Add custom functions here
 */

add_post_type_support( 'testimonial', 'excerpt' );


// Add custom query variable for 'product_line'
// Used to display product lines and related taxonomies
function custom_query_vars($query_vars) {
    $query_vars[] = 'product_line';
    return $query_vars;
}
add_filter('query_vars', __NAMESPACE__ . '\custom_query_vars');

function penncat_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\penncat_add_woocommerce_support' );
