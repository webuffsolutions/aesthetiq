<?php 

    $terms = get_terms([
        'taxonomy' => 'service_category', 
        'hide_empty' => false,
        'exclude' => [13] // exclude featured signature treatments
    ]);

    $serviceCategory = [];

    $i = 0;
    foreach ($terms as $term) {
        $serviceCategory[$i]['term_id'] = $term->term_id;
        $serviceCategory[$i]['name'] = $term->name;
        $serviceCategory[$i]['slug'] = $term->slug;
        $i++;
    }

?>

<ul class="navbar-nav order-lg-2 order-1">
    <li class="nav-item px-2">
        <a href="<?php echo site_url(); ?>" class="nav-link hover-link">
            Home
        </a>
    </li>

    <li class="nav-item px-2 dropdown menu-area">
        <!-- web -->
        <a href="<?php echo site_url('our-services'); ?>" class="nav-link dropdown-toggle d-lg-block d-none" aria-haspopup="true" aria-expanded="false">
            Our Services
        </a>

        <!-- mobile -->
        <a href="#!" class="nav-link dropdown-click dropdown-toggle d-lg-none d-inline" aria-haspopup="true" aria-expanded="false">
            Our Services
        </a>

        <!-- <div class="no-hover-effect d-inline d-lg-none ml-2">
            <a href="<php echo site_url('our-services'); ?>" class="text-gold-brown">| Go to page</a>
        </div> -->
        
        <div class="dropdown-menu mega-area scrollable-menu mt-md-n2 mt-2" aria-labelledby="navbarDropdownMenuLink">
            <div class="container">
                <div class="row pt-md-4 pt-0">
                    <?php foreach ($serviceCategory as $cat) { ?>
                        <div class="col-sm-6 col-lg-4 pb-4">
                            <h5 class="font-weight-bold"><?php echo $cat['name']; ?></h5>

                            <?php 

                                $args = [
                                    'post_type' => 'service',
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'service_category',
                                            'field' => 'slug',
                                            'terms' => $cat['slug']
                                        ]
                                    ]
                                ];

                                $services = new WP_Query($args);
                            
                                while ($services->have_posts()) {
                                    $services->the_post();
                                    $index = $services->current_post;
                            ?>

                            <a href="<?php echo the_permalink(); ?>" class="dropdown-item">
                                <?php the_title(); ?>
                            </a>

                            <?php }
                                wp_reset_postdata();
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </li>

    <!-- <li class="nav-item px-2">
        <a href="<?php echo site_url('our-products'); ?>" class="nav-link hover-link">
            Our Products
        </a>
    </li> -->

    <li class="nav-item px-2">
        <a href="<?php echo site_url('about-us'); ?>" class="nav-link hover-link">
            About Us
        </a>
    </li>

    <li class="nav-item px-2">
        <a href="<?php echo site_url('locations'); ?>" class="nav-link hover-link">
            Locations
        </a>
    </li>

    <li class="nav-item px-2">
        <a href="<?php echo site_url('book-your-appointment'); ?>" class="nav-link hover-link">
            Book Your Appointment
        </a>
    </li>

</ul>