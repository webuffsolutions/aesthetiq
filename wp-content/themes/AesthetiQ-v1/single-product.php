<?php get_header(); ?>

<div class="mt-5 pt-5"></div>

<?php 

    $logo = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg';
    $logo600x450 = get_template_directory_uri() . '/assets/images/logo/auto-draft-3-600x450.jpg';

    has_post_thumbnail() ? $mainThumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), '600x450') : $mainThumbnailUrl = $logo; 
    has_post_thumbnail() ? $fullImgUrl = get_the_post_thumbnail_url(get_the_ID(), 'full') : $fullImgUrl = $logo;

    get_field('other_image_1') ? $otherImage1 = get_field('other_image_1') : $otherImage1 = $logo;
    get_field('other_image_2') ? $otherImage2 = get_field('other_image_2') : $otherImage2 = $logo;
    get_field('other_image_3') ? $otherImage3 = get_field('other_image_3') : $otherImage3 = $logo;

    // for other products
    $termList = get_the_terms(get_the_ID(), 'product_category'); 
    $types ='';
    $termArr = [];

    if ($termList) {
        foreach($termList as $term) {
            if ($term->term_id !== 13) {
                $types .= $term->name.', ';
                $termArr[] = $term->slug;
            }
        }
    }

    $typesz = rtrim($types, ', ');
?>

<section class="py-5">
    <h1 class="header p-5 mb-5">Our Products</h1>

    <div class="container-fluid">
        <div class="row px-md-5 px-0">
            <div class="col-md-4 pb-4 pr-md-5 sticky">
                <?php get_template_part('template-parts/our-products/left-navigation'); ?>
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-7">
                <div id="products-content"></div>
                <div id="single-product-content">
                    <div class="card border-0 mb-5">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <a href="<?php echo $fullImgUrl; ?>" data-lightbox="roadtrip" data-title="">
                                    <div class="card-img-left border-bottom-green-thin" style="--image-url: url(<?php echo $mainThumbnailUrl; ?>);">
                                    </div>
                                </a>

                                <div class="d-flex justify-content-start mt-2">

                                    <?php if(get_field('other_image_1')) { ?>
                                    <a href="<?php echo $otherImage1; ?>" class="pr-2" data-lightbox="roadtrip" data-title="">
                                        <img src="<?php echo $otherImage1; ?>" class="scale-down rounded" height="70" width="70" />
                                    </a>
                                    <?php } ?>
                                    
                                    <?php if(get_field('other_image_2')) { ?>
                                    <a href="<?php echo $otherImage2; ?>" class="pr-2" data-lightbox="roadtrip" data-title="">
                                        <img src="<?php echo $otherImage2; ?>" class="scale-down rounded" height="70" width="70" />
                                    </a>
                                    <?php } ?>
     
                                    <?php if(get_field('other_image_3')) { ?>
                                    <a href="<?php echo $otherImage3; ?>" class="pr-2" data-lightbox="roadtrip" data-title="">
                                        <img src="<?php echo $otherImage3; ?>" class="scale-down rounded" height="70" width="70" />
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-12 col-md-7" style="min-height: 200px;">
                                <span class="card-block">
                                    <h1 class="card-title text-gold-brown font-weight-bold pt-md-0 pt-4">
                                        <?php the_title(); ?>
                                    </h1>
                                    <p style="color: #A9A9A9;"><?php echo $typesz; ?></p>
                                    <p><?php the_content(); ?></p>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- other products -->
                    <div class="row">
                        <div class="px-2 pt-5 pb-2 font-weight-bold">
                            <h3>OTHER PRODUCTS</h3>
                        </div>
                    </div>

                    <div class="row no-gutters">
                                        
                        <?php 
                        
                            $args = [
                                'post_type' => 'product',
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'post__not_in' => [get_the_ID()],
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'product_category',
                                        'field' => 'slug',
                                        'terms' => $termArr
                                    ]
                                ]
                            ];
                    
                            $otherProducts = new WP_Query($args);
                            
                            while ($otherProducts->have_posts()) {
                                $otherProducts->the_post();
                                has_post_thumbnail() ? $thumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), '600x450') : $thumbnailUrl = $logo600x450;
                                
                        ?>

                        <div class="col-md-4 col-6 pr-1">
                            <figure class="figure">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                    <img src="<?php echo $thumbnailUrl; ?>" class="figure-img img-fluid mb-0"/>
                                    <figcaption class="figure-caption bg-pink text-white px-2 pb-1 pt-2">
                                        <?php the_title(); ?>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>

                        <?php } wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/single-product/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>