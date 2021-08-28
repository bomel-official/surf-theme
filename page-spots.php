<?php
/*
Template Name: Шаблон страницы "spots"
Template Post Type: page
*/
function page_assets() {
    wp_enqueue_style( 'index-styles', get_template_directory_uri() . '/assets/css-min/spots.css' );
    wp_enqueue_style( 'header-first-screen-styles', get_template_directory_uri() . '/assets/css-min/black-header.css' );
}

add_action( 'wp_enqueue_scripts', 'page_assets' );

get_header();

$page = get_post();

            get_sidebar('black-header');
            ?>
            
            <?php
                $locations = get_tags( array(
                    'taxonomy'      => 'product_tag',	
            		'hide_empty'    => false,
            	));
        
        if ($locations && ! is_wp_error($locations)) {?>
            <section class="content">
    			<div class="container">
    				<div class="choose-locaction-block">
    					<div class="left">
    						<div class="image-block" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/default/spot-1.jpg);">
    							<h1 class="page-heading">
    								select filming location
    							</h1>
    						</div>
    					</div>
    					<div class="right">
    						<ul class="spots-list">
    						    <?php foreach ($locations as $location) { ?>
    						    
    							    <li class="spot"><a href="<?php echo get_term_link($location->term_id) ?>" class="to-spot"><?php echo $location->name ?></a></li>
    						    <?php } ?>
    						</ul>
    					</div>
    				</div>
    			</div>
    		</section>
		<?php } ?>

<?php
get_footer();
