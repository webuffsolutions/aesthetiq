<?php get_header(); ?>

<?php $logo = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg'; ?>

<!-- <div class="mt-5 pt-5"></div> -->

<section id="our-signature-treatments" class="py-5 mb-5">
    <h1 class="header p-5 mb-5">Our Services</h1>
    <div class="container-fluid">
        <div class="row px-md-5 px-0">
            <div class="col-md-4 pb-4 sticky">
                <?php get_template_part('template-parts/our-services/left-navigation'); ?>
            </div>

            <!-- <div class="col-md-1"></div> -->

            <div class="col-md-8 offset-md-2">
                <div id="services-content"></div>
            </div>
        </div>
    </div>
</section> <!-- banners -->
<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>