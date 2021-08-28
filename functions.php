<?php

// ========= Link all styles and scrips =========

function my_login_styles() {
    wp_enqueue_style( 'montserrat-google-font', 'https://fonts.googleapis.com/css?family=Montserrat:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=cyrillic,cyrillic-ext,latin,latin-ext,vietnamese' );
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css-min/login.min.css'); 
	wp_enqueue_style( 'base-custom-login', get_stylesheet_directory_uri() . '/assets/css-min/base.min.css');
	wp_enqueue_style( 'base-custom-login', get_stylesheet_directory_uri() . '/assets/css-min/fonts.min.css');
}

function my_login_logo() { 
	?> <style type="text/css">
        #login h1 a .logo-img, .login h2 a .logo-img {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default/logo.png);
        }
        body.login {
        	background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default/log-1.webp);
        }
    </style> <?php 
}

function my_login_logo_url_title() {
    return 'surf video';
}

function base_assets() {
    if ( is_page_template( 'page-index.php' ) ) {

        wp_enqueue_style( 'redesign-styles', get_template_directory_uri() . '/assets/css-min/styles.min.css' );
        wp_enqueue_style( 'owl-styles', get_template_directory_uri() . '/assets/libs-min/owl.carousel.min.css' );
        
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
        wp_enqueue_script( 'owl-scripts', get_template_directory_uri() . '/assets/libs-min/owl.carousel.min.js', array('jquery'), false, true);
    } else {
        wp_enqueue_style( 'montserrat-google-font', 'https://fonts.googleapis.com/css?family=Montserrat:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=cyrillic,cyrillic-ext,latin,latin-ext,vietnamese' );
        wp_enqueue_style( 'fira-sans-google-font', 'https://fonts.googleapis.com/css?family=Fira+Sans:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese' );
        wp_enqueue_style( 'normalize-styles', get_template_directory_uri() . '/assets/css-min/normalize.min.css' );
        wp_enqueue_style( 'base-styles', get_template_directory_uri() . '/assets/css-min/base.css' );
        wp_enqueue_style( 'fonts-styles', get_template_directory_uri() . '/assets/css-min/fonts.min.css' );
        wp_enqueue_script( 'disable-right-click', get_template_directory_uri() . '/assets/js-min/disable-right-click.js', array(), false, true);
    }
}

add_action( 'wp_enqueue_scripts', 'base_assets' );

add_filter( 'login_headertitle', 'my_login_logo_url_title' );

add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_action( 'login_enqueue_scripts', 'my_login_styles' );

// ^^^^^^^^^^^ Link all styles and scrips ^^^^^^^^^^^

function wc_empty_cart_redirect_url() {
	return home_url( '/' );
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

remove_action( 'woocommerce_register_form', 'dokan_seller_reg_form_fields' );

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
unset($fields['billing']['billing_first_name']);
unset($fields['billing']['billing_last_name']);
unset($fields['billing']['billing_company']);
unset($fields['billing']['billing_address_1']);
unset($fields['billing']['billing_address_2']);
unset($fields['billing']['billing_city']);
unset($fields['billing']['billing_postcode']);
unset($fields['billing']['billing_country']);
unset($fields['billing']['billing_state']);
unset($fields['order']['order_comments']);
unset($fields['account']['account_username']);
unset($fields['account']['account_password-2']);
return $fields;
}

function wpb_custom_new_menu() {
    register_nav_menu('header-footer-menu',__( 'Header-Footer menu' ));
    register_nav_menu('my-account-menu',__( 'My account menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

show_admin_bar(false);


function html5_search_form( $form ) { 
     $form = '<form role="search" method="get" class="search-form" id="search-form" action="' . home_url( '/' ) . '" >
     <div>
         <input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="Search" />
         <button id="searchsubmit" class="submit">
			<img src="'. get_stylesheet_directory_uri() .'/assets/images/default/search-icon.png" alt="search icon" class="search-icon">
		 </button>
     </div>
     </form>';
     return $form;
}

add_filter( 'get_search_form', 'html5_search_form' );

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
 
function my_deregister_styles() {
  wp_deregister_style( 'acf' );
  wp_deregister_style( 'acf-field-group' );
  wp_deregister_style( 'acf-global' );
  wp_deregister_style( 'acf-input' );
  wp_deregister_style( 'acf-datepicker' );
}


add_filter( 'lostpassword_url',  'wdm_lostpassword_url', 10, 0 );
function wdm_lostpassword_url() {
    return site_url('/wp-login.php?action=lostpassword');
}
 
// ========= Shortcodes for custom page content =========

pll_register_string('Change password', 'Сменить пароль');
pll_register_string('edit', 'Редактировать');
pll_register_string('my account', 'Мой аккаунт');
pll_register_string('explore', 'Исследовать');
pll_register_string('Cameras', 'Камеры');
pll_register_string('Drones', 'Дроны');
pll_register_string('Lenses', 'Объективы');
pll_register_string('sign up', 'Регистрация');
pll_register_string('log in', 'Войти');
pll_register_string('Personal area', 'Личный кабинет');
pll_register_string('My account slug', 'Ярлык лк');
pll_register_string('Delete slug', 'Ярлык удаления');
pll_register_string('Upload slug', 'Ярлык загрузить');
pll_register_string('Dashboard slug', 'Ярлык консоли');
pll_register_string('Set withwraw settings', 'Настройки способов вывода');
pll_register_string('Copyright', 'Правообладатель');


 
function base_profile_shortcode() {
    if( isset( $_GET['action'])) {
        $action = $_GET['action']; 
    } else {
        $action = null;
    }
    
    if ($action == 'edit'){
        return acf_form(array(
            'instruction_placement' => 'field',
            'fields'  => array('user_avatar', 'user_stage', 'user_first_name', 'user_last_name', 'user_country', 'user_phone'),
            'post_id' => 'user_' . get_current_user_id(),
            'html_after_fields' => '<div class="acf-field acf-field-number">
                                        <div class="acf-label">
                                        <label>' . pll__('Change password') . '</label></div>
                                        <div class="acf-input">
                                        <div class="acf-input-wrap"><a href="' . wp_lostpassword_url() . '" class="small-fill-btn">' . pll__('Change password') . '</a></div></div>
                                        </div>', 
            'return' => get_permalink( get_page_by_path( 'base-account' ) ), 
            'submit_value' => 'save', 
            'label_placement' => 'left', 
            'uploader' => 'basic'
        ));
    } else if ($action == null) {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $user_info = get_userdata($current_user->ID);
            $avatar_url = (get_field('user_avatar', 'user_' . $current_user->ID)) ? get_field('user_avatar', 'user_' . $current_user->ID)['url'] : get_template_directory_uri() . '/assets/images/default/default-user-img.jpg';
            $first_name = get_field('user_first_name', 'user_' . $current_user->ID);
            $last_name = get_field('user_last_name', 'user_' . $current_user->ID);
            $user_stage = get_field('user_stage', 'user_' . $current_user->ID) ? get_field('user_stage', 'user_' . $current_user->ID) : 0;
            $country = get_field('user_country', 'user_' . $current_user->ID);
            $phone = get_field('user_phone', 'user_' . $current_user->ID);
            $year = 'лет';
            
            switch ($user_stage) {
                case 1:
                    $year = 'год';
                    break;
                case 2:
                    $year = 'года';
                    break;
                case 3:
                    $year = 'года';
                    break;
                case 4:
                    $year = 'года';
                    break;
            }
            
            
            $user_fullname_block = ($first_name | $last_name) ? '<div class="field name">'.
                                                    				 $first_name . ' ' . $last_name
                                                    		     .'</div>' : '';
            $user_country_block = ($country) ? '<div class="field country">'.
                    				$country
                    			.'</div>' : '';
            $user_phone_block = ($phone) ? '<div class="field phone">'.
                    				$phone
                    			.'</div>' : '';
            
            $content = '<div class="base-profile active">
    			<div style="background-image: url(' . $avatar_url .')" alt="" class="user-avatar"></div>'.
    			$user_fullname_block
    			.'<div class="field nickname">'.
    				$user_info->user_nicename
    			.'</div>'.
    			$user_country_block
    			.'<div class="field email">'.
    				$user_info->user_email
    			.'</div>'.
    			$user_phone_block
    			.'<div class="field exp">
    				Опыт: '. $user_stage .' '. $year .'
    			</div>
    			<a href="'. get_permalink( get_page_by_path( 'base-account' ) ) .'?action=edit">
        			<button class="fill-btn">
        				' . pll__('Редактировать') . '
        			</button>
        		</a>
    		</div>';
        } else {
          $content = do_shortcode('[wpuf_profile type="registration" id="101"]');  
        };
		
		echo $content;
    }
}

add_shortcode('base_profile', 'base_profile_shortcode'); 

   
function products_bought_by_curr_user() {
   
    // GET CURR USER
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;
   
    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_is_paid_statuses() ),
    ) );
   
    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    if ( ! $customer_orders ) return '<div class="wpuf-info wpuf-restrict-message">No purchased products</div>';
    $product_ids = array();
    foreach ( $customer_orders as $customer_order ) {
        $order = wc_get_order( $customer_order->ID );
        $items = $order->get_items();
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;
        }
    }
    $product_ids = array_unique( $product_ids );
    $product_ids_str = implode( ",", $product_ids );
    
    if (empty($product_ids)) {
        return '<div class="wpuf-info wpuf-restrict-message">No purchased products</div>';
    }
    return do_shortcode("[products ids='$product_ids_str']");
   
};

add_shortcode( 'my_purchased_products', 'products_bought_by_curr_user' );

function products_published_by_curr_user() {
   
    // GET CURR USER
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;
   
    $products = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'product',
        'author'      => $current_user->ID,
    ) );
   
    if ( ! $products ) return '<div class="wpuf-info wpuf-restrict-message">No published products</div>';
    $product_ids = array();
    foreach ( $products as $product ) {
        $product_ids[] = $product->ID;
    }
    $product_ids_str = implode( ",", $product_ids );
    
    return do_shortcode("[products ids='$product_ids_str']");
   
};

add_shortcode( 'my_products', 'products_published_by_curr_user' );

function wallet_shortcode() {
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;
    
    $balance = get_user_meta($current_user->ID, '_current_woo_wallet_balance', true);
    if (!$balance) {
        $balance = '0.00';
    };
    
    return '<p>ВСЕГО СРЕДСТВ</p>
			<div class="green"><label for="withdraw-amount" class="dokan-w3 dokan-control-label">
                '. esc_html_e( 'Withdraw Amount', 'dokan-lite' ) .'
            </label></div>
			<div class="buttons-block">
			    <a>
			        <button class="small-fill-btn">top up</button>
			    </a>
			    <a href="' . get_permalink( get_page_by_path( 'base-account/withdraw' ) ) . '">
				    <button class="small-fill-btn red">withwraw</button>
				</a>
			</div>';
};

add_shortcode('wallet', 'wallet_shortcode'); 

function favourite_places_shortcode() {
   
    // GET CURR USER
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;
   
    $products = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'product',
        'author'      => $current_user->ID,
    ) );
   
    if ( ! $products ) return '<div class="wpuf-info wpuf-restrict-message">No favourite places</div>';
    $product_ids = array();
    foreach ( $products as $product ) {
        $places = get_the_terms ( $product->ID, 'product_tag' ); 
        $place = array_shift($places);
        $places_ids[] = $place->term_id;
    }
    
    $content = '<div class="images">
					<ul class="images-list">';
    
    $places_ids = array_unique( $places_ids );
    foreach ($places_ids as $places_id) {
        $term = get_term( $places_id, 'product_tag' );
        $term_img_link = get_field('img', $term) ? get_field('img', $term)['url'] :  get_template_directory_uri() . '/assets/images/default/spot-2.webp';
        $content = $content . '<li class="image-element">
									<a href="' . get_term_link( $term, 'product_tag' ) . '" class="to-image">
										<div class="image" style="background-image: url(' . $term_img_link . ')"></div>
									</a>
									<span class="filename">' . $term->name . '</span>
								</li>';
    };
    
    $content = $content . '     <li class="image-element">
									<a href="' . get_permalink( get_page_by_path( 'base-account/upload-mediafile' ) ) .'" class="to-image new-element">
										<div class="image" style="background-image: url(' . get_template_directory_uri() . '/assets/images/default/i-9.jpg)"></div>
									</a>
								</li>
							</ul>
						</div>';
    
    return $content;
};

add_shortcode( 'favourite_places', 'favourite_places_shortcode' );

function equipment_shortcode() {
    // GET CURR USER
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;
    $content = '<div class="images">
					<ul class="images-list">';
    
    $content = '<div class="images">
    	<ul class="images-list">
    		<li class="image-element">
        		<div class="to-image">
        			<div class="image" style="background-image: url(' . get_template_directory_uri() . '/assets/images/default/camera.jpg)"></div>
        		</div>
        		<span class="equipment filename">' . pll__('Камеры') . ' <input type="checkbox" data-input_id="acf-field_5f74561a65a0c"></span>
        	</li>
        	<li class="image-element">
        		<div class="to-image">
        			<div class="image" style="background-image: url(' . get_template_directory_uri() . '/assets/images/default/dron.jpg)"></div>
        		</div>
        		<span class="equipment filename">' . pll__('Дроны') . ' <input type="checkbox" data-input_id="acf-field_5f74565265a0e"></span>
        	</li>
        	<li class="image-element">
        		<div class="to-image">
        			<div class="image" style="background-image: url(' . get_template_directory_uri() . '/assets/images/default/objective.jpg)"></div>
        		</div>
        		<span class="equipment filename">' . pll__('Объективы') . ' <input type="checkbox" data-input_id="acf-field_5f74563f65a0d"></span>
        	</li>
        </ul>
        <div class="buttons-block">
			<button id="acf-equipment-save" class="small-fill-btn">save</button>
        </div>
    </div>'. acf_form(array(
            'form_attributes' => array('class' => 'hidden-form'),
            'fields' => array('is_camera', 'is_objective', 'is_dron'),
            'post_id' => 'user_' . get_current_user_id(),
            'return' => get_permalink( get_page_by_path( 'base-account/equipment' ) ), 
            'submit_value' => 'save', 
            'label_placement' => 'left',
        ));
    
    return $content;
};

add_shortcode( 'equipment', 'equipment_shortcode' );