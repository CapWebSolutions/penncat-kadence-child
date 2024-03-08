<?php

get_header();
global $post;  
$post_id = ( empty( $post->ID ) ) ? get_the_ID() : $post->ID;

// Add preferred internal Kadence block pattern page header to page template file
block_template_part( 'html-title-gear-bg' );
?>
<div class="datasheet-container">
	<div class="datasheet-wrap">
		<div class="datasheet-list">
			<div class="datasheet-item">
                <h2 class="datasheet-title">Model: <?php the_title(); ?></h2>
                <?php $t_product_line = get_the_term_list( $post_id, 'product-line', '', '', '' ); ?>
                <?php $t_manufacturer = get_the_term_list( $post_id, 'manufacturer', '', '', '' ); ?>
                <?php $t_model        = get_the_term_list( $post_id, 'model', '', '', '' ); ?>

                <div class="datasheet-productline">
                <h3 class="datasheet-product-line-title">Product Line: <?php echo  $t_product_line; ?></h2>
                </div>
                <div class="datasheet-manufacturer-container">
                    <h4 class="datasheet-manufacturer-title">Manufacturer -> <?php echo $t_manufacturer; ?></h3>
                </div>
				
                <h5 class="datasheet-model-title">Product Model Downloads</h5>
                <div class='datasheet-model-entry'>
                    <ul class="datasheet-download-list-container">
                    <?php 
                    $files = rwmb_meta( 'penncat_group_product_download_sheets' );
                    foreach ( $files as $file ) :
                        $ds_post_id = $files[0]['penncat_file'][0];
                        echo '<li>' . $file['penncat_download_type'] . '</li>';
                        echo '<a href="' . esc_url(wp_get_attachment_url( $ds_post_id ) ) . '" class="btn-datasheet btn-datasheet-download" download>Download' . '</a>';
                        echo '<a href="' . esc_url(wp_get_attachment_url( $ds_post_id ) ) . '" class="btn-datasheet btn-datasheet-view" >Preview' . '</a>';
                    endforeach;
                    ?>
                    </ul>
                </div>  <!-- // datasheet-model-entry -->
            </div>  <!-- //datasheet-item -->
		</div>
	</div>
</div>	

<?php



// Add preferred internal Kadence block pattern page footer / CTA to page template file
block_template_part( 'html-request-free-quote-box' );
get_footer();


