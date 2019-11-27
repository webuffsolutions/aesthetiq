<?php get_header(); ?>
<?php 
    $unique = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg'; 
    $logo = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg';
?>

<div class="mt-5 pt-5"></div>

<!-- about us -->
<section id="about-us" class="pt-5">
    <h1 class="header p-5 mb-4">About Us</h1>
    <div class="container-fluid">
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
<!-- ./ about us -->

<!-- global partners -->
<?php
    $args = [
        'post_type' => 'global_partner',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ];

    $globalPartners = new WP_Query($args);
?>

<?php if ($globalPartners->found_posts) { ?>
<section id="global-partners">
    <h1 class="header p-5">Global Partners</h1>

    <div class="container-fluid">
        <div class="row justify-content-center">

            <?php 

            while ($globalPartners->have_posts()) {
                $globalPartners->the_post();
                $index = $globalPartners->current_post;
                has_post_thumbnail() ? $thumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') : $thumbnailUrl = $logo;
                ?>

                <div class="col-6 col-lg-3 pb-5 text-center">
                    <img src="<?php echo $thumbnailUrl; ?>" width="120" />
                </div>

            <?php }
            wp_reset_postdata(); ?>

        </div>
    </div>
</section>
<?php } ?>
<!-- ./ global partners -->

<!-- loyalty program partners -->
<?php
    $args = [
        'post_type' => 'loyalty_partner',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ];

    $loyaltyProgramPartners = new WP_Query($args);
?>

<?php if ($loyaltyProgramPartners->found_posts) { ?>
<section id="loyalty-program-partners">
    <h1 class="header p-5">Loyalty Program Partners</h1>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php

            while ($loyaltyProgramPartners->have_posts()) {
                $loyaltyProgramPartners->the_post();
                $index = $loyaltyProgramPartners->current_post;
                has_post_thumbnail() ? $thumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') : $thumbnailUrl = $logo;
                ?>

                <div class="col-6 col-lg-3 pb-5 text-center">
                    <img src="<?php echo $thumbnailUrl; ?>" width="120" />
                </div>

            <?php }
            wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php } ?>
<!-- ./ loyalty program partners -->

<div class="pb-5 mb-5"></div>

<!-- banners -->
<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>