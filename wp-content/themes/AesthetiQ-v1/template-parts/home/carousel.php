<div id="carousel" class="carousel slide carousel-fade" data-pause="false">
    <ol class="carousel-indicators">
        <?php
        $args = [
            'post_type' => 'banner',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ];

        $banners = new WP_Query($args);

        while ($banners->have_posts()) {
            $banners->the_post();
            $index = $banners->current_post;
            ?>

            <li data-target="#carousel" data-slide-to="<?php echo $index ?>" <?php if ($index == 0) echo 'class="active"' ?>></li>

        <?php }
        wp_reset_postdata(); ?>
    </ol>
    <div class="carousel-inner" role="listbox">

        <?php
        $args = [
            'post_type' => 'banner',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ];

        $banners = new WP_Query($args);

        while ($banners->have_posts()) {
            $banners->the_post();
            $index = $banners->current_post;
            $bannerImage_2000x550 = get_field('banner_image')['sizes']['2000x550'];
            $bannerImage_1400x550 = get_field('banner_image')['sizes']['1400x550'];
            $bannerImage_800x550 = get_field('banner_image')['sizes']['800x550'];
            $bannerImage_600x550 = get_field('banner_image')['sizes']['600x550'];
            ?>

            <div class="carousel-item <?php if ($index == 0) echo 'active' ?>">
                <picture>
                    <source srcset="<?php echo $bannerImage_2000x550; ?>" media="(min-width: 1400px)">
                    <source srcset="<?php echo $bannerImage_1400x550; ?>" media="(min-width: 769px)">
                    <source srcset="<?php echo $bannerImage_800x550; ?>" media="(min-width: 577px)">
                    <img srcset="<?php echo $bannerImage_600x550; ?>" alt="responsive image" class="d-block img-fluid">
                </picture>
            </div>

        <?php }
        wp_reset_postdata(); ?>
    </div>
</div>