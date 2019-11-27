<?php get_header(); ?>

<div class="mt-5 pt-5"></div>

<section id="locations" class="pt-5">
    <h1 class="header p-5">Locations</h1>

    <div class="container-fluid">

        <?php
        $args = [
            'post_type' => 'location',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ];

        $locations = new WP_Query($args);

        while ($locations->have_posts()) {
            $locations->the_post();
            $index = $locations->current_post;
            ?>

            <div class="row px-md-5 px-0 pb-4">
                <div class="col-md-6">
                    <div class="card border-0">
                        <img class="card-img-top border-bottom-green" src="<?php the_post_thumbnail_url(get_the_ID(), '600x450'); ?>" />
                        <div class="card-body px-0"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="pt-lg-4 pt-0">
                        <h3 class="text-gold-brown font-weight-bold">
                            <?php the_title(); ?>
                        </h3>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

        <?php }
        wp_reset_postdata(); ?>
    </div>

    <div class="container">
        <div class="row mb-3">
            <div class="w-100">
                <?php
                if (have_posts()) : while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<div class="pb-5"></div>

<!-- banners -->
<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>