<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <style>
        .menu-area {
            position: static;
        }

        .mega-area {
            position: absolute;
            width: 100%;
            left: 0;
            right: 0;
            padding: 15px;
            /* background-color: #f8f9fa; */
        }

        .scrollable-menu {
            height: auto;
            max-height: 568px;
            overflow-x: hidden;
        }

        .dropdown-item {
            padding: 5px 0;
            color: #A9A9A9;
        }

        .close-mega-one {
            cursor: pointer;
        }

        /* hover effect */

        .dropdown:after {
            content: " ";
            position: absolute;
            /* bottom: -12px; */
            /* left: 0; */
            width: 100%;
            height: 12px;
            background: transparent;
        }

        .dropdown>.dropdown-menu {
            /* top: 200%; */
            /* transition: 0.3s all ease-in-out; */
        }

        .dropdown:hover > .dropdown-menu {
            display: block !important;
        }

        .dropdown>.dropdown-toggle:active {
        /*Without this, clicking will make it sticky*/
            /* pointer-events: none; */
        }

    </style>
</head>

<body <?php body_class(); ?>>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-header" style="border-bottom: 1px solid #9C908A;">
        <div class="container-fluid">
            <h1 class="pb-2 ml-md-0 ml-sm-3 ml-0 mr-3 pl-md-5">
                <a href="<?php echo site_url(); ?>" class="navbar-brand">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/logo/brown-logo.png'; ?>" id="no-lazy-load" width="200" />
                </a>
            </h1>
            <button class="navbar-toggler my-2" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-lg-2 ml-0" id="navbarCollapse">
                <div class="d-flex flex-column w-100 align-items-lg-end align-items-start">
                    <ul class="navbar-nav flex-row pt-3 nav-text-sm order-lg-1 order-2">
                        <li class="nav-item px-2 px-lg-0">
                            <a class="nav-link py-0 pr-0" href="https://www.facebook.com/AesthetiQph" target="_blank">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 px-lg-0">
                            <a class="nav-link py-0 pr-0" href="https://www.instagram.com/aesthetiqph" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item px-2 px-lg-0">
                            <span class="nav-link py-0 pr-0">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                        </li>
                        
                        <li class="nav-item pl-0 pl-lg-2">
                            <?php $args = [
                                'theme_location' => 'footer_contact',
                                'container'      => false, // add div container
                                'menu_class'     => 'list-unstyled' // ul class
                            ];

                            if (has_nav_menu('footer_contact')) {
                                wp_nav_menu($args);
                            } ?>
                        </li>

                        <li class="nav-item px-2">
                            <span class="nav-link py-0 pr-0">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </li>
                        
                        <li class="nav-item pr-3">
                            <?php $args = [
                                'theme_location' => 'header_schedules',
                                'container'      => false, // add div container
                                'menu_class'     => 'list-unstyled' // ul class
                            ];

                            if (has_nav_menu('header_schedules')) {
                                wp_nav_menu($args);
                            } ?>
                        </li>
                    </ul>

                    <!-- primary navigation -->
                    <!-- <php get_template_part('template-parts/header/primary-nav'); ?> -->
                    <?php get_template_part('template-parts/header/custom-primary-nav'); ?>

                </div>
            </div>
        </div>
    </nav>