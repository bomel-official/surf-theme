<?php 

$mainpage_id = (int)get_option( 'page_on_front' );
    
$contacts = get_field('contacts', $mainpage_id);
$networks = get_field('links', $mainpage_id);

?>
<section class="first" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/default/i-1.jpg);">
    <div class="container">
        <header class="header">
            <div class="logo-block">
                <a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/logo.png" alt="logo" class="logo"></a>
                <div class="social-media">
                    <a href="<?php echo $networks['ig'] ?>" class="network-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/ig-icon.png" alt="insagram icon" width="32" height="32"></a>
                    <a href="<?php echo $networks['fb'] ?>" class="network-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/fb-icon.png" alt="facebook icon" width="34" height="33"></a>
                    <a href="<?php echo $networks['pt'] ?>" class="network-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/pt-icon.png" alt="pinterest icon" width="34" height="34"></a>
                </div>
            </div>
            <?php wp_nav_menu( array( 
                'theme_location' => 'header-footer-menu', 
                'container_class' => 'nav' ) );
            ?>
            <div class="phone-block">
                <a href="tel:<?php echo $contacts['phone'] ?>" class="to-phone-link">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/default/black-phone.png" alt="phone icon" class="phone-icon" width="28" height="28">
                    <span class="phone-number">
                        <?php echo $contacts['phone'] ?>
                    </span>
                </a>
            </div>
            <div class="account-buttons">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/default/user-icon.png" alt="user icon" class="user-icon" width="27" height="27">
                <?php if (is_user_logged_in()) { ?>
                    <a href="<?php echo get_permalink( get_page_by_path( pll__('Ярлык лк') ) ); ?>"><button class="line-btn"><?php pll_e('Мой аккаунт') ?></button></a>
                <?php } else { ?>
                    <a href="<?php echo wp_login_url(); ?>"><button class="line-btn"><?php pll_e('Войти') ?></button></a>
                    <a href="<?php echo wp_registration_url(); ?>"><button class="line-btn"><?php pll_e('Регистрация') ?></button></a>
                <?php } ?>
            </div>
        </header>
        <?php get_search_form(); ?>
    </div>
</section>