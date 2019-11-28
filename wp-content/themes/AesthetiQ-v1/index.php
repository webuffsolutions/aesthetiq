<?php 
    get_header(); 
    global $wp;
?>

<div class="mt-5 pt-5"></div>

<section id="our-signature-treatments" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-5">
                <h1>Page <span class="font-weight-bold">"<?php echo basename(home_url( $wp->request )); ?>"</span> not found.</h1>
                <p>
                    <a href="<?php echo site_url(); ?>" class="text-dark">
                        Back to Home
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
