<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo("name"); ?><?php wp_title(' | '); ?></title>
    <meta name="description" content="<?php  bloginfo('description'); ?>">
    <?php wp_head(); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Lekton:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
</head>


<body <?php body_class(); ?>>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <header>
                    <!--navbar bootstrap-->
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <div class="logo-container">
                                <a class="navbar-brand font-logo logo" href="<?php echo home_url(); ?>">Fuerza
                                    invisi<span class="strong-gray">b</span><span class="md-gray">l</span><span
                                        class="light-gray">e</span></a>

                            </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto flex-row">
                                    <?php 
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
        
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_class' => 'navbar-nav ms-auto',
          'menu' => 'navbarSupportedContent',
          'walker' => new  bootstrap_5_wp_nav_menu_walker(),
        )); ?>
                                </ul>

                            </div>
                        </div>
                    </nav>

                    <!--fin navbar bootstrap-->

                </header>
            </div>

        </div>