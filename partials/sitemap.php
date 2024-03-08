<?php
/**
 * Build HTML Sitemap
 *
 * This file creates a shortcode to display a HTML/visual sitemap on any post or page.
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/penncat-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2023, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

get_header();

// Add preferred internal Kadence block pattern page header to page template file
block_template_part( 'html-title' );

echo '<div class="sitemap-container"><div class="page-container">';
  echo '<h2 class="sitemap-heading">Pages</h2>';
  echo '<ul>';
    // Display all pages as parent/child
    wp_list_pages( array( 
        'exclude' => '',
        'title_li' => '',
    ) );
  echo '</ul></div>';

  echo '<div class="category-container">';
    echo '<h2 class="sitemap-heading">Posts by Category</h2>';
    // 102 -> ShowOnFront
    $args = array(
      'exclude' => '102',
      'hide_empty' => true,
    );
    $cats = get_categories( $args );
    foreach ($cats as $cat) {
      echo '<h3 class="sitemap-heading3">' . $cat->cat_name . '</h3>';
      echo '<ul>';
      query_posts('posts_per_page=-1&cat=' . $cat->cat_ID);
      while(have_posts()) {
        the_post();
        $category = get_the_category();
        // Display post by category, excluding duplicates
        // if ($category[0]->cat_ID == $cat->cat_ID) {
          echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        // }
      }
      echo '</ul>';
    }
  echo '</div>';
  

  echo '<div class="opt-container">
    <h2 class="sitemap-heading">Other Post Types</h2>';
    // Display all other post types not listed above
    foreach( get_post_types( array('public' => true) ) as $post_type ) {
      if ( in_array( $post_type, array('post','page','attachment', 'kadence_element') ) ) {
        continue;
      }
      
      $pt = get_post_type_object( $post_type );

      echo '<div class="opt-h3-container">';
        echo '<h3 class="sitemap-heading3">' . $pt->labels->name . '</h3>';
        echo '<ul>';
          query_posts('post_type=' . $post_type . '&posts_per_page=-1');
          while( have_posts() ) {
            the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
          }
        echo '</ul>';
      echo '</div>';
    }
  echo '</div>';

  // echo '<div class="author-container"><h2 class="sitemap-heading">Authors</h2>';
  // echo '<ul>';
  // wp_list_authors( array(
  //   'exclude_admin' => true
  // ) );
  // echo '</ul></div>';

echo '</div>';
