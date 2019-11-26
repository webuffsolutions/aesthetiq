<section id="about-us-section" class="bg-header my-5">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4 text-white align-self-center">
                <div class="quarter-border-bottom pb-3">
                    <h1 class="text-uppercase display-5">About Us</h1>
                </div>
                <p class="text-white">
                    <?php echo get_field('about_us_description'); ?>
                </p>
            </div>

            <div class="col-md-8">
                <div class="row px-0 px-md-5 pb-4">
                    <div class="col-md-12">
                        <img src="<?php echo get_field('about_us_image_1')['sizes']['700x300']; ?>" class="img-fluid" />
                    </div>
                </div>
                <div class="row px-0 px-md-5">
                    <div class="col-md-6 pb-4">
                        <img src="<?php echo get_field('about_us_image_2')['sizes']['700x300']; ?>" class="img-fluid" />
                    </div>
                    <div class="col-md-6 pb-4">
                        <img src="<?php echo get_field('about_us_image_3')['sizes']['700x300']; ?>" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>