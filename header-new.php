<!doctype html>
<html>
    <head>
		<meta name="yandex-verification" content="9f99ee0ddbf75161" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!--=== TITLE ===-->  
	   	<title><?php 
	   		wp_title( '·',       TRUE,              'right' );
			bloginfo( 'name' ); ?>			
		</title>

		<!-- Bebas font -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

	    <!--=== LINK TAGS ===-->
	    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon.png" type="image/png" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon-96.png"/>
	    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
	    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	    <!--=== META TAGS ===-->
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	     
	    <!--=== WP_HEAD() ===-->
	    <?php wp_head(); ?>
    </head>
    <body id="body">
        <div class="surf-video">
        <div class="mobile-menu" id="mobile-menu">
            <div class="mobile-menu__inner">
                <div class="mobile-menu__content">
                    <nav class="mobile-menu__menu">
                        <ul class="mobile-menu__menu-items">
                            <?php wp_nav_menu( array( 
                                'theme_location' => 'header-footer-menu', 
                                'items_wrap' => '%3$s',
                                'container' => '' ) );
                            ?>
                        </ul>
                    </nav>
                    <div class="mobile-menu__auth">
                        <?php if (is_user_logged_in()) { ?>
                            <a href="<?php echo site_url( 'base-profile' ); ?>" class="small-fill-button">my account</a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>" class="small-fill-button">login</a>
                            <a href="<?php echo wp_registration_url(); ?>" class="small-line-button">sign up</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <header class="header">
            <div class="container">
                <div class="header__flex">
                    <div class="header__logo">
                        <a href="/">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//logo.svg" alt="" class="header__logo-img">
                        </a>
                    </div>
                    <div class="header__social">
                        <a href="<?php echo $networks['ig'] ?>" class="header__social-item">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/instagram.svg" alt="">
                        </a>
                        <a href="<?php echo $networks['fb'] ?>" class="header__social-item">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/facebook.svg" alt="">
                        </a>
                        <a href="<?php echo $networks['tw'] ?>" class="header__social-item">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/twitter.svg" alt="">
                        </a>
                    </div>
                    <nav class="header__menu">
                        <ul class="header__menu-items">
                            <?php wp_nav_menu( array( 
                                'theme_location' => 'header-footer-menu', 
                                'items_wrap' => '%3$s',
                                'container' => '' ) );
                            ?>
                        </ul>
                    </nav>
                    <div class="header__auth">
                        <?php if (is_user_logged_in()) { ?>
                            <a href="<?php echo site_url( 'base-profile' ); ?>" class="small-fill-button">my account</a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>" class="small-fill-button">login</a>
                            <a href="<?php echo wp_registration_url(); ?>" class="small-line-button">sign up</a>
                        <?php } ?>
                    </div>
                    <div class="header__burger" id="burger-button">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
        </header>