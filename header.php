<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bonjour_theme
 */

?>
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
    <body>
        <div class="root">