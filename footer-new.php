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
                <div class="footer__flex">
                    <div class="footer__left">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images//logo.svg" alt="" class="footer__logo">
                        <p class="footer__description">Another description of the company and its idea. Something fairly short and professional, between 3-4 lines of text. Just a placeholder text is here for now to understand how it looks.</p>
                        <div class="footer__social">
                            <a href="<?php echo $networks['ig'] ?>" class="footer__social-item">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/instagram.svg" alt="">
                            </a>
                            <a href="<?php echo $networks['fb'] ?>" class="footer__social-item">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/facebook.svg" alt="">
                            </a>
                            <a href="<?php echo $networks['tw'] ?>" class="footer__social-item">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/twitter.svg" alt="">
                            </a>
                        </div>
                    </div>
                    <nav class="footer__menu">
                        <h3 class="footer__title">Company</h3>
                        <ul class="footer__menu-items">
                            <?php wp_nav_menu( array( 
                                'theme_location' => 'header-footer-menu', 
                                'items_wrap' => '%3$s',
                                'container' => '' ) );
                            ?>
                        </ul>
                    </nav>
                    <div class="footer__mail">
                        <h3 class="footer__title">Get In touch</h3>
                        <a class="footer__mail-flex" href="mailto:<?php echo $contacts['email'] ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/footer-email-icon.svg" alt="" class="footer__mail-icon">
                            <p><?php echo $contacts['email'] ?></p>
                        </a>
                    </div>
                </div>
                <div class="footer__bottom flex">
                    <div class="footer__privacy">© 2021 Surf-Video. All Rights Reserved.</div>
                    <div class="footer__auth">
                        <?php if (is_user_logged_in()) { ?>
                            <a href="<?php echo site_url( 'base-profile' ); ?>" class="small-fill-button">my account</a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>" class="small-fill-button">login</a>
                            <a href="<?php echo wp_registration_url(); ?>" class="small-line-button">sign up</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <?php wp_footer(); ?>
</body>
</html>