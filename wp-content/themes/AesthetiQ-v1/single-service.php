<?php get_header(); ?>

<style>
    .list-group-item.active {
        background-color: #5e4b45 !important;
        border-color: #5e4b45 !important;
    }

    .list-group-item.active a {
        color: #fff !important;
    }

    .list-group-item.child-active {
        background-color: #c28269 !important;
        border-color: #c28269 !important;
        color: #fff !important;
    }

    @media only screen and (min-width: 1200px) {
        div.sticky {
            position: -webkit-sticky !important;
            /* Safari */
            position: sticky !important;
            top: 140px !important;
        }
    }

    .card-img-left {
        color: #fff;
        height: 250px;
        background: var(--image-url);
        background-repeat: no-repeat !important;
        background-size: cover;
    }
</style>

<div class="mt-5 pt-5"></div>

<?php $logo = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg'; ?>

<?php 

    has_post_thumbnail() ? $mainThumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), '300x300') : $mainThumbnailUrl = $logo; 
    get_field('other_image_1') ? $otherImage1 = get_field('other_image_1') : $otherImage1 = $logo;
    get_field('other_image_2') ? $otherImage2 = get_field('other_image_2') : $otherImage2 = $logo;
    get_field('other_image_3') ? $otherImage3 = get_field('other_image_3') : $otherImage3 = $logo;

    // for other services
    $termList = get_the_terms(get_the_ID(), 'service_category'); 
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

<section id="our-signature-treatments" class="py-5">
    <h1 class="header p-5 mb-5">Our Services</h1>

    <div class="container">
        <div class="row px-md-5 px-0">
            <div class="col-md-4 pb-4 pr-md-5 sticky">
                <?php get_template_part('template-parts/our-services/left-navigation'); ?>
            </div>

            <div class="col-md-8 pl-md-5">
                <div id="services-content"></div>
                <div id="single-service-content">
                    <div class="card border-0 mb-5">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" data-lightbox="roadtrip" data-title="<?php the_content(); ?>">
                                    <div class="card-img-left border-bottom-green-thin" style="--image-url: url(<?php echo $mainThumbnailUrl; ?>)">
                                    </div>
                                </a>

                                <div class="d-flex justify-content-start mt-2">

                                    <?php if(get_field('other_image_1')) { ?>
                                    <a href="<?php echo $otherImage1; ?>" class="pr-2" data-lightbox="roadtrip" data-title="<?php the_content(); ?>">
                                        <img src="<?php echo $otherImage1; ?>" class="scale-down rounded" height="77" width="77" />
                                    </a>
                                    <?php } ?>
                                    
                                    <?php if(get_field('other_image_2')) { ?>
                                    <a href="<?php echo $otherImage2; ?>" class="pr-2" data-lightbox="roadtrip" data-title="<?php the_content(); ?>">
                                        <img src="<?php echo $otherImage2; ?>" class="scale-down rounded" height="77" width="77" />
                                    </a>
                                    <?php } ?>
     
                                    <?php if(get_field('other_image_3')) { ?>
                                    <a href="<?php echo $otherImage3; ?>" class="pr-2" data-lightbox="roadtrip" data-title="<?php the_content(); ?>">
                                        <img src="<?php echo $otherImage3; ?>" class="scale-down rounded" height="77" width="77" />
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

                    <!-- book appointment -->
                    <div class="row mb-5">
                        <div class="mx-auto">
                            <a href="<?php echo site_url('book-your-appointment'); ?>" class="btn btn-lg bg-pink px-5 pt-3 rounded-0 text-white border-white text-uppercase">
                                <i class="fas fa-play fa-sm pl-2"></i> BOOK APPOINTMENT
                            </a>
                        </div>
                    </div>
                    <!-- ./ book appointment -->

                    <!-- other services -->
                    <div class="row">
                        <div class="px-2 pt-5 pb-2 font-weight-bold">
                            <h3>OTHER SERVICES</h3>
                        </div>
                    </div>

                    <div class="row no-gutters">
                                        
                        <?php 
                        
                            $args = [
                                'post_type' => 'service',
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'post__not_in' => [get_the_ID()],
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'service_category',
                                        'field' => 'slug',
                                        'terms' => $termArr
                                    ]
                                ]
                            ];
                    
                            $otherServices = new WP_Query($args);
                            
                            while ($otherServices->have_posts()) {
                                $otherServices->the_post();
                                has_post_thumbnail() ? $thumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), '600x450') : $thumbnailUrl = $logo;
                                
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

<?php get_template_part('template-parts/single-service/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>