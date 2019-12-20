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

<div class="list-group">
    <div id="myGroup" class="d-none1 d-md-block1" style="display: none;">
        <a href="#!" class="list-group-item list-group-item-action border-0 pb-1 all-services" onclick="clickCategory(event);" data-parent="#menu">ALL SERVICES</a>
        <?php
        foreach ($serviceCategory as $cat) {
            ?>
            <span class="list-group-item list-group-item-action d-flex justify-content-between border-0 pb-1 <?php echo $cat['slug']; ?>" data-parent="#menu">
                <a href="#!" class="mr-5 text-decoration-none text-dark text-uppercase" data-id="<?php echo $cat['slug']; ?>" onclick="clickCategory(event);"><?php echo $cat['name']; ?></a>
                <i class="fas fa-caret-down" data-toggle="collapse" data-target="#<?php echo $cat['slug']; ?>" aria-expanded="false" aria-controls="<?php echo $cat['slug']; ?>"></i>
            </span>

            <div id="<?php echo $cat['slug']; ?>" class="sublinks collapse <?php echo $cat['slug']; ?>-collapse">

                <!-- services under taxonomy -->
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

                    <a href="<?php echo the_permalink(); ?>" class="list-group-item list-group-item-action border-0 pb-1 bg-gray text-uppercase <?php echo $index === 0 ? 'child-active1' : ''; ?>"><?php the_title(); ?></a>

                <?php }
                    wp_reset_postdata();
                    ?>
            </div>

        <?php } ?>
    </div>

    <div id="display-on-mobile" class="d-block d-md-none">
        <select name="selectDropdownCategory" id="selectDropdownCategory" class="form-control">
            <option value="all-services">All Services</option>
            <?php foreach ($serviceCategory as $cat) { ?>
                <option value="<?php echo $cat['slug']; ?>">
                    <?php echo $cat['name']; ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>