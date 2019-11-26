<?php get_header(); ?>
<?php $unique = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg'; ?>

<div class="mt-5 pt-5"></div>

<!-- about us -->
<section id="about-us" class="pt-5">
    <h1 class="header p-5 mb-4">About Us</h1>
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

        <!-- <div class="row pb-5">
            <div class="col-md-6">
                <div class="card border-0">
                    <img class="card-img-top" src="https://picsum.photos/id/20/700/450" alt="Card image cap">
                    <div class="card-body px-0">
                        <p class="card-text">
                            Industry-seasoned for nearly 20 years, our management and
                            our staff are equipped with customer centered values and are
                            driven to deliver service that is better than the best
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="pb-2">
                    <h1>OUR TEAM</h1>
                    <p>
                        Industry-seasoned for nearly 20 years, our management and
                        our staff are equipped with customer centered values and are
                        driven to deliver service that is better than the best
                    </p>
                </div>

                <h1>AFFORDABILITY AND QUALITY</h1>
                <p>
                    The core distinction of AQ is providing you a defining holistic wellness
                    experience through our wide array of premium quality yet exceptionally affordable
                    services-from minimal non-abrasive facial treatments and relaxing bodyworks to
                    state-of-the-art treatments, keeping ourselves attuneed to the technological
                    trends on beauty and wellness across the globe. <br /><br />

                    AesthetiQ Wellness and Spa is undoubtedly the new respite to escape from the
                    stress of everyday life and the perfect starting point to begin taking care
                    of yourself by refreshing your body, mind, and soul. With Affordability and Quality
                    as our thrust, at AesthetiQ Wellness and Spa, you deserve no shortcuts.
                </p>
            </div>
        </div> -->

        <!-- <div class="row">
            <div class="col-md-6">
                <div class="card border-0">
                    <img class="card-img-top" src="https://picsum.photos/id/48/700/450" alt="Card image cap">
                    <div class="card-body px-0"></div>
                </div>
            </div>

            <div class="col-md-6 align-self-center">
                <div class="pb-2">
                    <h1>OUR ESSENTIAL TREATMENTS</h1>
                    <p>
                        Experience AesthetiQ with these three facial essentials: Peel & Protect,
                        Mask & Moisturize, and Double Cleanse.
                    </p>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!-- ./ about us -->

<!-- global partners -->
<section id="global-partners">
    <h1 class="header p-5">Global Partners</h1>

    <div class="container">
        <div class="row justify-content-center">

            <?php
            $args = [
                'post_type' => 'global_partner',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ];

            $globalPartners = new WP_Query($args);

            while ($globalPartners->have_posts()) {
                $globalPartners->the_post();
                $index = $globalPartners->current_post;
                ?>

                <div class="col-6 col-lg-3 pb-5 text-center">
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" width="120" />
                </div>

            <?php }
            wp_reset_postdata(); ?>

        </div>
    </div>
</section>
<!-- ./ global partners -->

<!-- loyalty program partners -->
<section id="loyalty-program-partners">
    <h1 class="header p-5">Loyalty Program Partners</h1>

    <div class="container">
        <div class="row justify-content-center">
            <?php
            $args = [
                'post_type' => 'loyalty_partner',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ];

            $loyaltyProgramPartners = new WP_Query($args);

            while ($loyaltyProgramPartners->have_posts()) {
                $loyaltyProgramPartners->the_post();
                $index = $loyaltyProgramPartners->current_post;
                ?>

                <div class="col-6 col-lg-3 pb-5 text-center">
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" width="120" />
                </div>

            <?php }
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<!-- ./ loyalty program partners -->

<div class="pb-5"></div>

<!-- banners -->
<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>