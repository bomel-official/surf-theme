<?php
/*
Template Name: Шаблон страницы личного кабинета
Template Post Type: page
*/
function page_assets() {
    wp_enqueue_style( 'personal-cabinet-styles', get_template_directory_uri() . '/assets/css-min/personal-cabinet.css' );
    wp_enqueue_style( 'header-part-styles', get_template_directory_uri() . '/assets/css-min/header-part.css' );
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/bf39e79e09.js', 
    array(), false, true);
    wp_enqueue_script('iputs-user-admin', get_template_directory_uri() . '/assets/js-min/inputs-user-admin.js', 
            array(), false, true);
};

add_action( 'wp_enqueue_scripts', 'page_assets' );

acf_form_head();

get_header();

the_post();

            get_sidebar('header-part');
            ?>
			<section class="personal-cabinet-content">
				<div class="left">
					<div class="cabinet-options">
						<h2 class="page-heading"><?php pll_e('Личный кабинет') ?></h2>
						<?php wp_nav_menu( array( 
                            'theme_location' => 'my-account-menu',
                            'container'=> false
                            ));
                        ?>
					</div>
				</div>
				<div class="right">
					<div class="section-top">
						<div class="current-option"><?php the_title(); ?></div>
						<?php   $current_user = wp_get_current_user();
        						$avatar_url = (get_field('user_avatar', 'user_' . $current_user->ID)) ? get_field('user_avatar', 'user_' . $current_user->ID)['url']: null;
                                $first_name = get_field('user_first_name', 'user_' . $current_user->ID);
                                $last_name = get_field('user_last_name', 'user_' . $current_user->ID);
                                $user_stage = get_field('user_stage', 'user_' . $current_user->ID);
                                $country = get_field('user_country', 'user_' . $current_user->ID);
						if ($first_name | $last_name) { ?>
    						<div class="profile-block">
    							<div class="left">
    								<div class="name online"><?php echo $first_name ?> <?php echo $last_name ?></div>
    								<div class="country"><?php echo $country ?></div>
    							</div>
    							<?php if ($avatar_url) { ?>
    							    <div style="background-image: url(<?php echo $avatar_url ?>)" alt="" class="user-avatar"></div>
    							<?php } else { ?>
    							    <div style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/default/default-user-img.jpg)" alt="" class="user-avatar"></div>
    							<?php } ?>
    						</div>
						<?php } ?>
					</div>
					<div class="content">
						<div class="form-content active">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>

<?php
get_footer();
