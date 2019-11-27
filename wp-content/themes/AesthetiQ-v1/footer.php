<?php wp_footer(); ?>
<?php $footerLogo = get_template_directory_uri() . '/assets/images/logo/brown-logo.png'; ?>

<footer class="page-footer bg-header">
    <div class="container text-center text-md-left py-2">
        <div class="row">
            <div class="col-md-12 my-5 pl-md-0">
                <a href="<?php echo site_url(); ?>" class="navbar-brand">
                    <img src="<?php echo $footerLogo; ?>" id="no-lazy-load" width="200" />
                </a>
            </div>
        </div>

        <div class="row">
            <!-- OUR TEAM -->
            <div class="col-md-4 mt-md-0 mr-auto mb-2 text-white px-5 px-md-0">
                <h5 class="font-weight-bold">OUR TEAM</h5>
                <?php $args = [
                    'theme_location' => 'footer_our_team',
                    'container'      => false, // add div container
                    'menu_class'     => 'list-unstyled' // ul class
                ];

                if (has_nav_menu('footer_our_team')) {
                    wp_nav_menu($args);
                } ?>
            </div>

            <!-- Menu -->
            <div class="col-md-2 mt-md-0 mb-2 text-white py-3 py-md-0">
                <h5 class="font-weight-bold">Menu</h5>
                <?php $args = [
                    'theme_location' => 'footer_menu',
                    'container'      => false, // add div container
                    'menu_class'     => 'list-unstyled', // ul class
                    'add_li_class'   => 'nav-item px-2' // custom arg [function = additionalClassOnListItem()]
                ];

                if (has_nav_menu('footer_menu')) {
                    wp_nav_menu($args);
                } ?>
            </div>

            <!-- Contact -->
            <div class="col-md-2 col-4 mt-md-0 mr-auto mb-2 text-white py-3 py-md-0">
                <h5 class="font-weight-bold">Contact</h5>
                <?php $args = [
                    'theme_location' => 'footer_contact',
                    'container'      => false, // add div container
                    'menu_class'     => 'list-unstyled' // ul class
                ];

                if (has_nav_menu('footer_contact')) {
                    wp_nav_menu($args);
                } ?>
            </div>

            <!-- Legal -->
            <div class="col-md-2 col-4 mt-md-0 mr-auto mb-2 py-3 py-md-0">
                <h5 class="text-white font-weight-bold">Legal</h5>

                <?php $args = [
                    'theme_location' => 'footer_legal',
                    'container'      => false, // add div container
                    'menu_class'     => 'list-unstyled' // ul class
                ];

                if (has_nav_menu('footer_legal')) {
                    wp_nav_menu($args);
                } ?>
            </div>
        </div>

        <div class="row mt-2 px-md-0 px-5">
            <div class="col-md-12 pl-0">
                <p class="text-white">
                    © <?php echo date('Y') .' '. get_bloginfo('name'); ?>. | Powered by
                    <a href="https://webuffsolutions.com" target="_blank" class="text-decoration-none text-white font-weight-bold cera-pro">
                        WeBuff Solutions
                    </a>
                </p>
            </div>
        </div>

    </div>
</footer>

</body>

</html>