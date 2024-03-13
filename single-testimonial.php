<?php

get_header();
global $post;  
$post_id = ( empty( $post->ID ) ) ? get_the_ID() : $post->ID;

// Add preferred internal Kadence block pattern page header to page template file
block_template_part( 'html-title-gear-bg' );

// Get the post meta data
$post_title = get_the_title( $post_id );
$testimonial_company = rwmb_meta( 'penncat_testimonial_company' );
$testimonial_title = rwmb_meta( 'penncat_testimonial_title' );
// Get the post thumbnail URL
$post_thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>
<div class="testimonial-container">
    <div class="testimonial-wrapper">
        <blockquote class="wp-block-quote is-style-default has-theme-palette-8-background-color has-background">
            <?php the_content( $post_id ); ?>
        </blockquote>
        <img src="<?php echo esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr($post_title); ?>">
        <div class="testimonial-meta">
            <h2><?php echo esc_html($post_title); ?></h2>
            <?php echo esc_html($testimonial_company) . ', ' . esc_html($testimonial_title); ?>
        </div>
    </div>
</div>	

<?php

// Add preferred internal Kadence block pattern page footer / CTA to page template file
block_template_part( 'html-request-free-quote-box' );
get_footer();


