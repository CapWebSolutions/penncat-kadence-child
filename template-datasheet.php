<?php
/*
Template Name: Datasheet Archive
*/
get_header();

// Add preferred internal Kadence block pattern page header to page template file
block_template_part( 'html-title' );

$product_line_terms = get_terms(array(
    'taxonomy' => 'product-line',
    'hide_empty' => false,
));

?>
<div class="datasheet-container">
    <?php
    if (!empty($product_line_terms)) :
        foreach ($product_line_terms as $product_line_term) :
    ?>
            <div class="datasheet-product-line-container">

                <h2 class="datasheet-product-line-title">Product Line: <a href="/product-line/<?php echo $product_line_term->slug; ?>" ><?php echo $product_line_term->name; ?></a></h2>
                <div class="datasheet-manufacturer-container">
                    <?php
                    $manufacturer_terms = get_terms(array(
                        'taxonomy' => 'manufacturer',
                        'hide_empty' => false,
                        'object_ids' => get_objects_in_term($product_line_term->term_id, 'product-line'),
                    ));

                    if (!empty($manufacturer_terms)) :
                        foreach ($manufacturer_terms as $manufacturer_term) :
                    ?>
                            <h3 class="datasheet-manufacturer-title">Manufacturer -> <a href="/manufacturer/<?php echo $manufacturer_term->slug; ?>"><?php echo $manufacturer_term->name; ?></a></h3>
                            <h4 class="datasheet-model-title"><?php echo $product_line_term->name; ?> Models</h4>

                            <?php
                            $model_args = array(
                                'post_type' => 'datasheet',
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'product-line',
                                        'field' => 'term_id',
                                        'terms' => $product_line_term->term_id,
                                    ),
                                    array(
                                        'taxonomy' => 'manufacturer',
                                        'field' => 'term_id',
                                        'terms' => $manufacturer_term->term_id,
                                    ),
                                ),
                            );

                            $models = new WP_Query($model_args);

                            if ($models->have_posts()) :
                            ?>
                                <div class='datasheet-model-entry'>
                                    <ul class="datasheet-model-list">
                                        <?php while ($models->have_posts()) : $models->the_post(); ?>
                                            <li class="datasheet-model-list-entry"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p>No models found for this manufacturer.</p>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No manufacturers found for this product line.</p>
                    <?php endif; ?>
                </div>
            </div><!-- #datasheet-content-area -->
    <?php
        endforeach;
    else :
        echo '<p>No product lines found.</p>';
    endif;
echo '</div>';  //datasheet-container

// Add preferred internal Kadence block pattern page footer / CTA to page template file
block_template_part( 'html-request-free-quote-box' );

get_footer();


