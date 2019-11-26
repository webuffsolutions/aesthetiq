<?php get_header(); ?>

<div class="mt-5 pt-5"></div>

<section id="our-signature-treatments" class="py-5">
    <h1 class="header p-5">Locations</h1>

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

    <div class="container">
        <!-- west ave -->
        <div class="row px-md-5 px-0 pb-4">
            <div class="col-md-6">
                <div class="card border-0">
                    <img class="card-img-top border-bottom-green" src="http://localhost/wordpress/aesthetiq/wp-content/uploads/2019/11/west-location-600x400.jpg" />
                    <div class="card-body px-0">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pt-lg-4 pt-0">
                    <h3 class="text-gold-brown font-weight-bold">WEST AVE.</h3>
                    <p>68 WEST AVE CARBAL BLDG. QUEZON CITY</p>
                    <p>(02) 371-29-31 / (02) 373-56-23</p>
                    <p>
                        Monday-Friday <br />
                        10AM - 6PM
                    </p>
                    <p>
                        Saturday-Sunday <br />
                        10AM - 5PM
                    </p>

                    <a href="https://goo.gl/maps/J1uZ2gX2jVW97ayv9" target="_blank" class="text-dark underline font-weight-bold">
                        <u>View on Google Maps</u>
                    </a>
                </div>
            </div>
        </div>
        <!-- ./ west ave -->

        <!-- visayas ave -->
        <div class="row px-md-5 px-0 pb-4">
            <div class="col-md-6">
                <div class="card border-0">
                    <img class="card-img-top border-bottom-green" src="http://localhost/wordpress/aesthetiq/wp-content/uploads/2019/11/visayas-location-600x400.jpg" />
                    <div class="card-body px-0">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pt-lg-4 pt-0">
                    <h3 class="text-gold-brown font-weight-bold">VISAYAS AVE.</h3>
                    <p>33 VISAYAS AVE, JADE PLACE, QUEZON CITY</p>
                    <p>(02) 920-57-66 / (02) 288-25-79 / 09985936201</p>
                    <p>
                        Monday-Friday <br />
                        10AM - 7PM
                    </p>
                    <p>
                        Saturday-Sunday <br />
                        10AM - 6PM
                    </p>

                    <a href="https://goo.gl/maps/6cNg8YZZdM8n9dLz5" target="_blank" class="text-dark underline font-weight-bold">
                        <u>View on Google Maps</u>
                    </a>

                </div>
            </div>
        </div>
        <!-- ./ visayas ave -->

        <!-- marilao -->
        <div class="row px-md-5 px-0">
            <div class="col-md-6">
                <div class="card border-0">
                    <img class="card-img-top border-bottom-green" src="http://localhost/wordpress/aesthetiq/wp-content/uploads/2019/11/marilao-location-600x400.jpg" />
                    <div class="card-body px-0">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pt-lg-4 pt-0">
                    <h3 class="text-gold-brown font-weight-bold">MARILAO</h3>
                    <p>2/F SM CITY MARILAO, BULACAN</p>
                    <p>(044) 711-32-73 / (044) 913-93-15 / 09985936202</p>
                    <p>
                        Monday-Friday <br />
                        10AM - 7PM
                    </p>
                    <p>
                        Saturday-Sunday <br />
                        10AM - 6PM
                    </p>
                    <a href="https://g.page/sm-city-marilao?share" target="_blank" class="text-dark underline font-weight-bold">
                        <u>View on Google Maps</u>
                    </a>
                </div>
            </div>
        </div>
        <!-- ./ marilao -->
    </div>
</section>

<div class="pb-5"></div>

<!-- banners -->
<?php get_template_part('template-parts/banner-1'); ?>
<?php get_template_part('template-parts/banner-2'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>