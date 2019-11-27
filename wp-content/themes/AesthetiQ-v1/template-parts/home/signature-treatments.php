<?php 
    $wishProImg = get_template_directory_uri() . '/assets/images/home/1200x1200-Wishpro.jpg';
    $hydraGlowFacialImg = get_template_directory_uri() . '/assets/images/home/1200x1200-Hydraglow-Facial.jpg';
    $indibaImg = get_template_directory_uri() . '/assets/images/home/1200x1200-Indiba.jpg';

    $args = [
        'post_type' => 'service',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => [
            [
                'taxonomy' => 'service_category',
                'field' => 'term_id',
                'terms' => [13]
            ]
        ]
    ];

    $services = new WP_Query($args);
?>

<section id="our-signature-treatments" class="py-5">
    <h1 class="header p-5 mb-5">Our Signature Treatments</h1>
    <div class="container-fluid">
        <div class="row">

            <?php 
                while ($services->have_posts()) {
                    $services->the_post();
                    $index = $services->current_post;
            ?>

            <div class="col-md-4 pb-4">
                <div class="card text-white">
                    <img class="card-img border-bottom-green" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), '1200x1200'); ?>" />
                </div>

                <div class="d-flex">
                    <div class="mx-auto mt-4">
                        <a href="<?php the_permalink(); ?>" class="btn btn-lg btn-outline-aq-brown pb-0">
                            LEARN MORE
                        </a>
                    </div>
                </div>
            </div>

            <?php } wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<section id="fall-for-the-feel-section">
    <div class="container-fluid">
        <div class="row px-md-5">
            <div class="w-100">
                <?php the_content(); ?>
            </div>
            <div class="px-3 pb-5 pt-2 text-aq-brown">
                <?php echo get_field('signature_treatments_description'); ?>
            </div>
        </div>
    </div>
</section>