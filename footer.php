<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bonjour_theme
 */

$mainpage_id = (int)get_option( 'page_on_front' );
    
$contacts = get_field('contacts', $mainpage_id);
$networks = get_field('links', $mainpage_id);

?>
			<footer class="footer">
                <div class="container">
                    <div class="top">
                        <div class="logo-block">
                            <a href="<?php echo get_home_url(); ?>"><img class="logo" src="<?php echo get_template_directory_uri() ?>/assets/images/default/logo.png" alt="logo"></a>
                        </div>
                        <?php wp_nav_menu( array( 
                            'theme_location' => 'header-footer-menu', 
                            'container_class' => 'nav' ) );
                        ?>
                        <?php if (is_user_logged_in()) { ?>
                            <a href ="<?php echo get_permalink( get_page_by_path( 'spots' ) ); ?>">
                                <button class="fill-btn"><?php pll_e('Исследовать') ?></button>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>">
        					    <button class="fill-btn"><?php pll_e('Исследовать') ?></button>
        					</a>
                        <?php } ?>
                    </div>
                    <div class="bottom">
                        <div class="email-block">
                            <a href="mailto:<?php echo $contacts['email'] ?>" class="to-email-link">
                                <img width="48" height="35" src="<?php echo get_template_directory_uri() ?>/assets/images/default/email-icon.png" alt="email icon">
                                <span class="email-adress">
                                    <?php echo $contacts['email'] ?>
                                </span>
                            </a>
                        </div>
                        <div class="social-media">
                            <a href="<?php echo $networks['ig'] ?>" class="network-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/ig-icon.png" alt="insagram icon" width="32" height="32"></a>
                            <a href="<?php echo $networks['fb'] ?>" class="network-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/fb-icon.png" alt="facebook icon" width="34" height="33"></a>
                            <a href="<?php echo $networks['pt'] ?>" class="network-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/default/pt-icon.png" alt="pinterest icon" width="34" height="34"></a>
                        </div>
                        <div class="phone-block">
                            <a href="tel:<?php echo $contacts['phone'] ?>" class="to-phone-link">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/default/phone-wa-icon.png" alt="phone icon" class="phone-icon" width="35" height="35">
                                <span class="phone-number">
                                    <?php echo $contacts['phone'] ?>
                                </span>
                            </a>
                        </div>
                        <div class="account-buttons">
                            <?php if (is_user_logged_in()) { ?>
			                    <a href="<?php echo get_permalink( get_page_by_path( pll__('Ярлык лк') ) ); ?>"><button class="line-btn"><?php pll_e('Мой аккаунт') ?></button></a>
			                <?php } else { ?>
			                    <a href="<?php echo wp_login_url(); ?>"><button class="line-btn"><?php pll_e('Войти') ?></button></a>
			                    <a href="<?php echo wp_registration_url(); ?>"><button class="line-btn"><?php pll_e('Регистрация') ?></button></a>
			                <?php } ?>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <?php wp_footer(); ?>
    </body>
</html>