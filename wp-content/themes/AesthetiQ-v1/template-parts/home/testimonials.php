<?php 
    $unique = get_template_directory_uri() . '/assets/images/profile-icons/unique.png';

    $args = [
        'post_type' => 'testimonial',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ];

    $testimonials = new WP_Query($args);
?>

<?php if ( $testimonials->have_posts() ) { ?>
<section id="testimonials-section" class="pb-5 mb-5">
    <h1 class="header p-5">Testimonials</h1>
    <div class="container-fluid">
        <div id="myCarousel" class="carousel1 slide px-0" data-ride="carousel" data-interval="5000" data-pause="false">
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">

                <?php 
                    $i = 0;
                    while ( $testimonials->have_posts() ) : $testimonials->the_post();
                    has_post_thumbnail() ? $thumbnailUrl = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') : $thumbnailUrl = $unique;

                    if ($i % 3 == 0) { ?>
                        <div class="item carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="row justify-content-center d-flex align-items-center">
                    <?php }
                ?>
                        
                            <div class="col-lg-4 pb-4">
                                <div class="testimonial-wrapper">
                                    <div class="testimonial">
                                        <?php echo get_field('message'); ?>
                                    </div>
                                    <div class="media">
                                        <div class="media-left d-flex mr-3">
                                            <img src="<?php echo $thumbnailUrl; ?>" />
                                        </div>
                                        <div class="media-body">
                                            <div class="overview">
                                                <b><?php echo get_field('full_name'); ?></b>
                                                <div class="details">
                                                    <?php echo get_the_date(); ?>
                                                </div>
                                                <div class="star-rating">
                                                    <ul class="list-inline">
                                                        <?php $rating = get_field('rating'); ?>
                                                        <?php for ($x = 0; $x < $rating; $x ++) { ?>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php 
                        if ($i % 3 == 2) {
                            echo '</div></div>';
                        }

                        $i++;
                    ?>

                    <?php endwhile; wp_reset_postdata(); ?>

            </div>
        </div>
    </div>
</section>
<?php } ?>