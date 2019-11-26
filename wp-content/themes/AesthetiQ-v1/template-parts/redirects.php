<?php

$currentPageID = get_the_ID();

$args = [
    'post_type' => 'redirect',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'meta_query' => [
        [
            'key' => 'appear_to_pages',
            'value' => '"' . $currentPageID . '"',
            'compare' => 'LIKE'
        ]
    ]
];

$redirects = new WP_Query($args);

while ($redirects->have_posts()) {
    $redirects->the_post();
    $index = $redirects->current_post;

    $redirectButtonLabel = get_field_object('redirect_button_label');
    $redirectPagelink = get_field_object('redirect_page_link');
    $appearToPages = get_field_object('appear_to_pages');
    ?>

    <section id="check-all-our-services-section" class="banner-bg1 py-5" style="--image-url: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), '2000x550'); ?>);">
        <div class="container">
            <div class="row p-5 justify-content-between">
                <h1 class="text-white cera-pro text-center mx-auto mx-md-0">
                    <?php echo get_field('shortcut_description'); ?>
                </h1>
                <div class="mx-auto mx-md-0">
                    <div class="fixed-width-btn">
                        <a href="<?php echo $redirectPagelink['value']; ?>" class="btn btn-lg btn-block bg-orange px-5 pt-3 rounded-0 text-uppercase">
                            <?php echo $redirectButtonLabel['value']; ?>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

<?php }
wp_reset_postdata(); ?>