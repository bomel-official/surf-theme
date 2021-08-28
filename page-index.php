<?php
/*
Template Name: Шаблон главной страницы
Template Post Type: page
*/

get_header('new'); 

if (is_user_logged_in()) { 
    $account_url = site_url( 'base-profile');
} else { 
    $account_url = wp_login_url();
} ?>

<!-- Background image urls -->
<style>
    .owl-carousel .owl-nav button.owl-next {
        background-image: url(<?php echo get_template_directory_uri() ?>/assets/images//icons/slider-arrow-icon-right.svg);
    }

    .owl-carousel .owl-nav button.owl-prev {
        background-image: url(<?php echo get_template_directory_uri() ?>/assets/images//icons/slider-arrow-icon-left.svg);
    }

    .owl-carousel.dark .owl-nav button.owl-next {
        background-image: url(<?php echo get_template_directory_uri() ?>/assets/images//icons/slider-arrow-icon-right-white-mobile.svg);
    }

    .owl-carousel.dark .owl-nav button.owl-prev {
        background-image: url(<?php echo get_template_directory_uri() ?>/assets/images//icons/slider-arrow-icon-left-white-mobile.svg);
    }

    @media screen and (min-width: 1441px) {
        .hero {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/Hero-backgrounds-combined@2x.jpg");
        }

        .spam {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/more-to-come-bg-texture-OVERLAY@2x.jpg");
        }

        .surfer__img-surfer {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/section-img-surfer@2x.jpg");
        }

        .surfer__img-filmmaker {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/section-img-filmmaker@2x.jpg");
        }
    }

    @media screen and (max-width: 1440px) {
        .hero {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/Hero-backgrounds-combined.jpg");
        }

        .spam {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/more-to-come-bg-texture-OVERLAY.jpg");
        }

        .surfer__img-surfer {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/section-img-surfer.jpg");
        }

        .surfer__img-filmmaker {
            background-image: url("<?php echo get_template_directory_uri() ?>/assets/images//main/section-img-filmmaker.jpg");
        }
    }
</style>

<main class="content">
    <section class="hero">
        <div class="container">
            <div class="hero__content">
                <h1>
                    CAUGHT SOME WAVES?<br>
                    <span class="thin">WE GOT</span> YOUR RIDE.
                </h1>
                <p>
                    Daily videos shot on most famous surfing spots in Bali by dedicated team of filmmakers. Find yourself now!
                </p>
                <div class="flex">
                    <a href="<?php echo site_url('gallery') ?>" class="big-fill-button">Find your ride</a>
                    <a href="<?php echo $account_url ?>" class="big-line-button">Become A Filmmaker</a>
                </div>
            </div>
        </div>
    </section>
    <section class="benefit">
        <div class="container">
            <div class="slider-wrapper">
                <div class="slider-container">
                    <div class="benefit__flex owl-carousel dark">
                        <div class="benefit__item">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/benefits-icon-placeholder-1.svg" alt="" class="benefit__icon">
                            <div class="benefit__content">
                                <h3 class="benefit__title">Benefit Title</h3>
                                <p class="benefit__description">Short benefit description goes here, as an example placeholder.</p>
                            </div>
                        </div>
                        <div class="benefit__item">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/benefits-icon-placeholder-2.svg" alt="" class="benefit__icon">
                            <div class="benefit__content">
                                <h3 class="benefit__title">Benefit Title</h3>
                                <p class="benefit__description">Short benefit description goes here, as an example placeholder.</p>
                            </div>
                        </div>
                        <div class="benefit__item">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/benefits-icon-placeholder-3.svg" alt="" class="benefit__icon">
                            <div class="benefit__content">
                                <h3 class="benefit__title">FULL RIGHTS ON USAGE</h3>
                                <p class="benefit__description">Purchased content can be used for absolutely any scenario.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="recent">
        <div class="container">
            <h2 class="recent__title">MOST <span class="thin">RECENT</span> CONTENT</h2>
            <p class="recent__description">Whether it’s photo or video you’re after, we work hard to get as many content as possible so that you can find yourself in action.</p>
            <div class="tabs recent__tabs">
                <?php 
                $cats = get_terms( 'product_cat', [
                    'hide_empty' => false,
                ] );
                array_splice( $cats, 0, 0, array((object) array('slug' => 'all-media', 'name' => 'all media') ) );
                ?>
                <div class="tabs__headers-wrapper recent__headers-wrapper">
                    <ul class="tabs__headers recent__headers">
                        <?php foreach ($cats as $cat) { ?>
                            <?php  $active = ($cat->slug == 'all-media') ? 'active' : ''; ?>
                            <li class="tabs__header recent__header <?php echo $active ?>" rel="<?php echo $cat->slug ?>"><?php echo $cat->name ?></li>
                        <?php } ?>
                    </ul>
                </div>

                <?php foreach ($cats as $cat) { ?>
                    <?php $active = ($cat->slug == 'all-media') ? 'active' : ''; 
                    $args = array(
                        'post_type' 	 => 'product',
                        'posts_per_page' => 12,
                        'post_status'    => 'publish',
                        'orderby'        => 'ID',
                        'order'          => 'DESC'
                    );
                    if ($cat->slug != 'all-media') {
                        $args['tax_query'] = [
                            [
                                'taxonomy' 	=> 'product_cat',
                                'field'     => 'slug',
                                'terms' 	=> $cat->slug
                            ]
                        ];
                    }
                    $images = new WP_Query($args); ?>

                    <div class="tabs__content <?php echo $active ?>" id="<?php echo $cat->slug ?>">
                        <div class="slider-wrapper">
                            <div class="slider-container">
                                <ul class="recent__previews owl-carousel">
                                    <?php while ( $images->have_posts() ) : $images->the_post(); ?>
                                        <?php $product = get_product(get_the_ID()) ?>
                                        <li class="recent__preview">
                                            <a href="<?php the_permalink() ?>">
                                                <div class="recent__preview-img">
                                                    <div class="recent__preview-play" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/images//icons/card-play-icon.svg')"></div>
                                                    <img src="<?php the_post_thumbnail_url('medium-large'); ?>" alt="">
                                                </div>
                                                <div class="recent__preview-data flex">
                                                    <h3 class="recent__preview-title"><?php the_title() ?></h3>
                                                    <div class="recent__preview-date flex">
                                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/card-date-icon.svg" alt="" class="recent__preview-date-icon">
                                                        <span class="recent__preview-date-text"><?php echo $product->get_date_created()->format ('d.m.Y'); ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="recent__button">
                <a href="<?php echo site_url('gallery') ?>" class="big-fill-button">VIEW FULL GALLERY</a>
            </div>
        </div>
    </section>
    <section class="surfer">
        <div class="surfer__flex">
            <div class="surfer__img-surfer surfer__img">
            </div>
            <div class="surfer__content surfer__content-right">
                <div class="surfer__for">for surfers</div>
                <h2 class="surfer__heading">
                    <span class="thin">Daily</span> surf videos. <br>
                    filmed just <span class="thin">for you.</span>
                </h2>
                <p class="surfer__description">
                    Short description about what’s good in it for the surfer type of visitor. Explain why they might be interested and what are their benefits, with main shown below.
                </p>
                <ul class="surfer__advantages">
                    <li class="surfer__advantage">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/bulletpoint-tick-icon.svg" alt="" class="surfer__list-icon">
                        <div class="surfer__list-content">
                            <h3 class="surfer__list-heading">analyze mistakes for faster progress</h3>
                            <p class="surfer__list-description">Short benefit description here as an example placeholder.</p>
                        </div>
                    </li>
                    <li class="surfer__advantage">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/bulletpoint-tick-icon.svg" alt="" class="surfer__list-icon">
                        <div class="surfer__list-content">
                            <h3 class="surfer__list-heading">Spend Less time & money on surf content</h3>
                            <p class="surfer__list-description">Short benefit description here as an example placeholder.</p>
                        </div>
                    </li>
                </ul>
                <a href="<?php echo site_url('gallery') ?>" class="big-fill-button">Find your surf video</a>
            </div>
        </div>
        <div class="surfer__flex">
            <div class="surfer__content surfer__content-left">
                <div class="surfer__for">For Photo & Video makers</div>
                <h2 class="surfer__heading">
                    SHOOT <span class="thin">SURF</span> & EARN.<br>
                    <span class="thin">WHENEVER</span> YOU LIKE.
                </h2>
                <p class="surfer__description">
                    Description about what’s good in it for the filmmaker type of visitor. Explain why they might be interested and what are their benefits, with main shown below.
                </p>
                <ul class="surfer__advantages">
                    <li class="surfer__advantage">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/bulletpoint-tick-icon.svg" alt="" class="surfer__list-icon">
                        <div class="surfer__list-content">
                            <h3 class="surfer__list-heading">Earn by doing what you love</h3>
                            <p class="surfer__list-description">Short benefit description here as an example placeholder.</p>
                        </div>
                    </li>
                    <li class="surfer__advantage">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/bulletpoint-tick-icon.svg" alt="" class="surfer__list-icon">
                        <div class="surfer__list-content">
                            <h3 class="surfer__list-heading">Support Surf Culture</h3>
                            <p class="surfer__list-description">Short benefit description here as an example placeholder.</p>
                        </div>
                    </li>
                </ul>
                <a href="<?php echo $account_url ?>" class="big-fill-button">Submit your video</a>
            </div>
            <div class="surfer__img-filmmaker surfer__img">
            </div>
        </div>
    </section>
    <section class="spots">
        <div class="container">
            <h2 class="spots__title">
                <span class="thin">plenty</span> of spots Filmed
            </h2>
            <p class="spots__description">
                Whether it’s photo or video you’re after, we work hard to get as many content as possible so that you can find yourself in action.
            </p>
            <div class="spots__slider-wrapper">
                <div class="slider-wrapper">
                    <div class="slider-container">
                        <ul class="owl-carousel spots__slider">
                            <?php
                            $locations = get_tags( array(
                                'taxonomy'      => 'product_tag',	
                                'hide_empty'    => false,
                            ));
                            
                            foreach ($locations as $term) { ?>
                                <li class="spots__spot">
                                    <a href="<?php echo get_term_link($term->term_id) ?>">
                                        <div class="spots__spot-img">
                                            <img src="<?php echo get_field('img', $term) ? get_field('img', $term)['url'] :  get_template_directory_uri() . '/assets/images/default/spot-2.jpg' ; ?>" alt="">
                                        </div>
                                        <h3 class="spots__spot-title"><?php echo $term->name ?></h3>
                                        <div class="spots__spot-data flex">
                                            <?php 
                                            $args = array(
                                                'post_type' => 'product',
                                                'post_status' => 'published',
                                                'numberposts' => -1,
                                                'tax_query' => [
                                                    'relation' => 'AND',
                                                    [
                                                        'taxonomy' 	=> 'product_cat',
                                                        'field'     => 'slug',
                                                        'terms' 	=> 'video'
                                                    ],
                                                    [
                                                        'taxonomy' 	=> 'product_tag',
                                                        'field'     => 'slug',
                                                        'terms' 	=> $term->slug
                                                    ]
                                                ]
                                            );
                                            $v_num = count( get_posts( $args ) );
                                            ?>
                                            <div class="spots__spot-count flex">
                                                <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/card-video-icon.svg" alt="" class="spots__spot-count-icon">
                                                <span class="spots__spot-count-text"><?php echo $v_num ?> Videos</span>
                                            </div>
                                            <?php 
                                            $args = array(
                                                'post_type' => 'product',
                                                'post_status' => 'published',
                                                'numberposts' => -1,
                                                'tax_query' => [
                                                    'relation' => 'AND',
                                                    [
                                                        'taxonomy' 	=> 'product_cat',
                                                        'field'     => 'slug',
                                                        'terms' 	=> 'photo'
                                                    ],
                                                    [
                                                        'taxonomy' 	=> 'product_tag',
                                                        'field'     => 'slug',
                                                        'terms' 	=> $term->slug
                                                    ]
                                                ]
                                            );
                                            $p_num = count( get_posts( $args ) );
                                            ?>
                                            <div class="spots__spot-count flex">
                                                <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/card-photo-icon.svg" alt="" class="spots__spot-count-icon">
                                                <span class="spots__spot-count-text"><?php echo $p_num ?> Photos</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="spots__button">
                <a href="<?php echo site_url('gallery') ?>" class="big-fill-button">Explore Gallery</a>
            </div>
        </div>
    </section>
    <section class="spam">
        <div class="container">
            <h2 class="spam__title">
                <span class="thin">there’s</span> more to come!
            </h2>
            <p class="spam__description">
                Stay tuned to see more of products added to our website.
            </p>
            <ul class="spam__list">
                <li class="spam__item">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/more-card-icon-placeholder.svg" alt="" class="spam__item-icon">
                    <h3 class="spam__item-heading">Surfing Lessons</h3>
                    <p class="spam__item-description">
                        Short benefit description goes here, as an example placeholder.
                    </p>
                </li>
                <li class="spam__item">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/more-card-icon-placeholder.svg" alt="" class="spam__item-icon">
                    <h3 class="spam__item-heading">Surfing Lessons</h3>
                    <p class="spam__item-description">
                        Short benefit description goes here, as an example placeholder.
                    </p>
                </li>
                <li class="spam__item">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images//icons/more-card-icon-placeholder.svg" alt="" class="spam__item-icon">
                    <h3 class="spam__item-heading">Surfing Lessons</h3>
                    <p class="spam__item-description">
                        Short benefit description goes here, as an example placeholder.
                    </p>
                </li>
            </ul>
            <div class="spam__input-wrapper">
                <div class="spam__input">
                    <input type="email" placeholder="Enter your email" class="spam__input-email">
                    <button class="big-fill-button">Subscribe</button>
                </div>
                <p class="spam__input-guarantee">
                    * We guarantee to not send you any spam - the only emails from us will be related to the new features rolling out to the site.
                </p>
            </div>
        </div>
    </section>
</main>

<?php get_footer('new'); ?>

<script>
    $('.tabs__header').click(function(e){
        e.preventDefault()

        $('.tabs__header').removeClass("active")
        $('.tabs__content').removeClass("active")

        let rel = $(this).attr('rel')
        
        $(this).addClass('active')
        $(this).closest('.tabs').find('#' + rel).addClass('active')
    })

    $(document).ready(function() {
        $('#burger-button').on('click', function(e){
            $('#body').toggleClass('menu-active')
            $(this).toggleClass('menu-active')
            $('#mobile-menu').toggleClass('menu-active')
        })

        $(".benefit__flex").owlCarousel({
            loop: false,
            responsive : {
                0 : {
                    items: 1,
                    nav: true,
                    dots: true,
                },
                500 : {
                    items: 3,
                    nav: false,
                    dots: false,
                },
            }
        });

        $(".recent__previews").owlCarousel({
            loop: true,
            nav: true,
            responsive : {
                0 : {
                    items: 1,
                    dots: true,
                },
                500 : {
                    items: 3,
                    dots: false,
                },
            }
        });

        $(".spots__slider").owlCarousel({
            loop: true,
            nav: true,
            dots: true,
            responsive : {
                0 : {
                    items: 1,
                },
                500 : {
                    items: 4,
                },
            }
        });
    });
</script>
