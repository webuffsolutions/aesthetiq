<?php get_header(); ?>

<div class="mt-5 pt-5"></div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <section id="our-signature-treatments" class="py-5">
            <h1 class="header p-5"><?php the_title(); ?></h1>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>

<?php endwhile;
endif; ?>

<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>