<?php
    $terms = get_terms([
        'taxonomy' => 'product_category', 
        'hide_empty' => false
    ]);

    $productCategory = [];

    $i = 0;
    foreach ($terms as $term) {
        $productCategory[$i]['term_id'] = $term->term_id;
        $productCategory[$i]['name'] = $term->name;
        $productCategory[$i]['slug'] = $term->slug;
        $i++;
    }
?>

<div class="list-group sticky">
    <div id="myGroup" class="d-none d-md-block">
        <a href="#!" class="list-group-item list-group-item-action border-0 pb-1 all-products" onclick="clickProductCategory(event);" data-parent="#menu">ALL PRODUCTS</a>
        <?php
        foreach ($productCategory as $cat) {
            ?>
            <span class="list-group-item list-group-item-action d-flex justify-content-between border-0 pb-1 <?php echo $cat['slug']; ?>" data-parent="#menu">
                <a href="#!" class="mr-5 text-decoration-none text-dark text-uppercase" data-id="<?php echo $cat['slug']; ?>" onclick="clickProductCategory(event);"><?php echo $cat['name']; ?></a>
                <i class="fas fa-caret-down" data-toggle="collapse" data-target="#<?php echo $cat['slug']; ?>" aria-expanded="false" aria-controls="<?php echo $cat['slug']; ?>"></i>
            </span>

            <div id="<?php echo $cat['slug']; ?>" class="sublinks collapse <?php echo $cat['slug']; ?>-collapse">

                <!-- products under taxonomy -->
                <?php
                    $args = [
                        'post_type' => 'product',
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                        'tax_query' => [
                            [
                                'taxonomy' => 'product_category',
                                'field' => 'slug',
                                'terms' => $cat['slug']
                            ]
                        ]
                    ];

                    $products = new WP_Query($args);

                    while ($products->have_posts()) {
                        $products->the_post();
                        $index = $products->current_post;
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
            <option value="all-products">All Products</option>
            <?php foreach ($productCategory as $cat) { ?>
                <option value="<?php echo $cat['slug']; ?>">
                    <?php echo $cat['name']; ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>