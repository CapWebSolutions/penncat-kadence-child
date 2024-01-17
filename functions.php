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

  

function add_id_to_links_script() {
    ?>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
        function addIdToLinks() {
            var links = document.querySelectorAll(\'a[href*="https://api.leadconnectorhq.com/widget/form/VHNpmgrC5JUoLkP1ptkx"]\');
            links.forEach(function(link) {
                link.setAttribute("id", "get-free-quote-link");
            });
            var buttons = document.querySelectorAll(\'button[href*="https://api.leadconnectorhq.com/widget/form/VHNpmgrC5JUoLkP1ptkx"]\');
            buttons.forEach(function(button) {
                button.setAttribute("id", "get-free-quote-link");
            });
        }
        addIdToLinks();
        document.addEventListener("ajaxComplete", addIdToLinks);
        });
    </script>
    <?php
}

function add_fa_event_tracker() {
    ?>
    <script>
        window.addEventListener('load', (event) => {
        document.getElementById('get-free-quote-link').addEventListener('click', () => {
            fathom.trackEvent('Get free quote link clicked');
        });
        });
    </script>
    <?php
}
    
add_action('wp_footer', __NAMESPACE__ . '\add_id_to_links_script');
add_action('wp_footer', __NAMESPACE__ . '\add_fa_event_tracker' );


function penncat_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\penncat_add_woocommerce_support' );

// add_action( 'after_setup_theme', __NAMESPACE__ . '\penncat_add_block_template_part_support' );
// function penncat_add_block_template_part_support() {
//     add_theme_support( 'block-template-parts' );
// }