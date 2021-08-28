<?php
function page_assets() {
    wp_enqueue_style( 'index-styles', get_template_directory_uri() . '/assets/css-min/product.css' );
    wp_enqueue_style( 'header-first-screen-styles', get_template_directory_uri() . '/assets/css-min/black-header.css' );
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/bf39e79e09.js', 
    array(), false, true);
}

add_action( 'wp_enqueue_scripts', 'page_assets' );

get_header();

$product = wc_get_product( get_the_ID() );

            get_sidebar('black-header');
            ?>
            <style>
                header .logo-block .social-media {
                    display: none;
                }
            </style>
            <div class="general-watermark" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/default/watermark.png)"></div>
            <section class="content">
    			<div class="container">
    				<div class="headings-block">
    					<div class="filters">
    					    <?php $from_term = get_term(wc_get_product_term_ids( $product->get_id(), 'from_where' )[0]);
                                $str = preg_replace("/^(\w+\s)/", "", $from_term->name);
    					    ?>
    						<div class="filter">
    							<div class="filter-name">from</div>
    							<div class="filter-value"><?php echo $str ?></div>
    						</div>
    						<?php $spot = get_term(wc_get_product_term_ids( $product->get_id(), 'product_tag' )[0]) ?>
    						<div class="filter">
    							<div class="filter-name">spot</div>
    							<div class="filter-value"><?php echo $spot->name ?></div>
    						</div>
    						<div class="filter">
    							<div class="filter-name">date</div>
    							<div class="filter-value"><?php echo $product->get_date_created()->format ('d-m-Y'); ?></div>
    						</div>
    						<div class="filter">
    							<div class="filter-name">time</div>
    							<div class="filter-value"><?php echo $product->get_date_created()->format ('h:i'); ?></div>
    						</div>
    					</div>
    					<?php $type = get_term(wc_get_product_term_ids( $product->get_id(), 'product_cat' )[0]) ?>
    					<div class="categories">
    						<div class="spot"><?php echo $spot->name ?></div>
    						<div class="type"><?php echo $type->name ?></div>
    					</div>
    				</div>
    				<div class="product-content">
    				    <?php 
    				    $files = $product->get_downloads();
    				    $file = array_shift($files);
    				    $fileexc = pathinfo($file['name'], PATHINFO_EXTENSION);
    				    
    				    if (in_array($fileexc, array('jpg', 'jpeg', 'gif', 'png', 'bmp'))) { ?>
        					<div class="full-size-image">
        						<img src="<?php echo $file['file']; ?>" alt="" class="main-image">
        						<div class="watermark" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/default/watermark.png)"></div>
        					</div>
    					<?php } else if (in_array($fileexc, array('avi', 'divx', 'flv', 'mov', 'ogv', 'mkv', 'mp4', 'm4v', 'divx', 'mpg', 'mpeg', 'mpe'))) { ?>
        					<div class="video-container">
            					<video id="main-video" width="100%" src="<?php echo $file['file']; ?>" controls controlsList="nodownload nofullscreen" disablePictureInPicture playsInline webkit-playsInline>
                                Your browser does not support the video tag.
                                </video>
                                <div id="watermark" class="watermark" style="background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/default/watermark.png)"></div>
                            </div>
                        <?php } ?>
                        <?php
                        if (is_user_logged_in()) { 
                            $current_user = wp_get_current_user();
                        } else {
                            $current_user->ID = -1;
                        };
                       
                        if ( 0 == $current_user->ID ) return;
                       
                        // GET USER ORDERS (COMPLETED + PROCESSING)
                        $customer_orders = get_posts( array(
                            'numberposts' => -1,
                            'meta_key'    => '_customer_user',
                            'meta_value'  => $current_user->ID,
                            'post_type'   => wc_get_order_types(),
                            'post_status' => array_keys( wc_get_is_paid_statuses() ),
                        ) );
                       
                        $is_product_bought = false;
                        
                        foreach ( $customer_orders as $customer_order ) {
                            $order = wc_get_order( $customer_order->ID );
                            $items = $order->get_items();
                            foreach ( $items as $item ) {
                                $product_id = $item->get_product_id();
                                if ($product_id == $product->get_id()) {
                                    $is_product_bought = true;
                                }
                            }
                        }
                        $author_id = get_post_field( 'post_author', $product->get_id() );
                        
                        $product_post = get_post( $product->get_id() );
				        $autor_id = $product_post->post_author;
				        $autor_info = get_userdata($autor_id);
				        $author_avatar = (get_field('user_avatar', 'user_' . $autor_id)) ? get_field('user_avatar', 'user_' . $autor_id)['url'] : get_template_directory_uri() . '/assets/images/default/default-user-img.jpg';
    					
                        
                        if ($is_product_bought || $author_id==$current_user->ID) {?>
                            <div id="after-payment" class="after-payment about-image active">
                                <div class="author-info">
        					        <div class="author-profile">
        					            <div class="avatar" style="background-image: url(<?php echo $author_avatar ?>);"></div>
        					            <div class="name">Сopyright holder: <span class="username"><?php echo $autor_info->user_nicename ?></span></div>
        					            <div class="rating">0.0 <i class="fas fa-star"></i></div>
        					        </div>
        					        <div class="post-date">Published: <?php echo $product->get_date_modified()->format ('d-m-Y'); ?></div>
        					    </div>
        					    <div class="product-description">
        						    <?php echo $product->get_short_description(); ?>
        						</div>
        					    <div class="cta-block">
        					        <?php if ($author_id==$current_user->ID) { ?>
        					            <form method="POST" action="<?php echo get_permalink( get_page_by_path( pll__('Ярлык удаления') ) ); ?>">
        					                <input type="hidden" value="<?php echo $product->get_id() ?>" name="product_id">
        					                <input type="hidden" value="<?php echo pll_home_url() ?>" name="home">
        					                <button class="small-fill-btn danger">delete</button>
        					            </form>
        					        <?php } ?>
        							<a download href="<?php echo $file['file']; ?>" class="download">
        							    <button class="small-fill-btn red">download</button>
        							</a>
        						</div>
        					</div>
    					<?php } else { ?>
        					<div id="before-payment" class="about-image before-payment">
        					    <div class="author-info">
        					        <div class="author-profile">
        					            <div class="avatar" style="background-image: url(<?php echo $author_avatar ?>);"></div>
        					            <div class="name">Сopyright holder: <span class="username"><?php echo $autor_info->user_nicename ?></span></div>
        					            <div class="rating">0.0 <i class="fas fa-star"></i></div>
        					        </div>
        					        <div class="post-date">Published: <?php echo $product->get_date_modified()->format ('d-m-Y'); ?></div>
        					    </div>
        					    <div class="product-description">
        						    <?php echo $product->get_short_description(); ?>
        						</div>
        						<div class="cta-block">
        							<div class="price"><?php echo $product->get_price() . ' ' . get_woocommerce_currency(); ?></div>
        							<div class="procced-to-payment-block">
            							<?php if (is_user_logged_in()) { ?>
            							    <a href="<?php echo get_home_url('/'); ?>/checkout/?add-to-cart=<?php echo $product->get_id() ?>"><button id="pay" class="small-fill-btn">proceed to payment</button></a>
            							<?php } else { ?>
            							    <a href="<?php echo wp_login_url() ?>"><button id="pay" class="small-fill-btn">proceed to payment</button></a>
            							<?php } ?>
            							<div class="payment-description">
                						    download of this material will be available immediately after payment
                						</div>
        							</div>
        						</div>
        					</div>
    					<?php } ?>
    				</div>
    			</div>
    		</section>
    		<script>
    		    
    		</script>
<?php
get_footer();
