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
        height: 14rem;
        background: var(--image-url);
        background-repeat: no-repeat !important;
        background-size: cover;
    }
</style>

<?php $logo = get_template_directory_uri() . '/assets/images/logo/login-logo.jpg'; ?>

<div class="mt-5 pt-5"></div>

<section id="our-signature-treatments" class="py-5">
    <h1 class="header p-5 mb-5">Our Services</h1>
    <div class="container">
        <div class="row px-md-5 px-0">
            <div class="col-md-4 pb-4 sticky">
                <?php get_template_part('template-parts/our-services/left-navigation'); ?>
            </div>

            <div class="col-md-8">
                <div id="services-content"></div>
            </div>
        </div>
    </div>
    </div>
</section> <!-- banners -->
<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>