<?php

if (property_exists(get_queried_object(), 'term_id')) {
    function page_assets() {
        wp_enqueue_style( 'spot-styles', get_template_directory_uri() . '/assets/css-min/spot.css' );
        wp_enqueue_style( 'category-styles', get_template_directory_uri() . '/assets/css-min/category.css' );
        wp_enqueue_style( 'header-first-screen-styles', get_template_directory_uri() . '/assets/css-min/header-first-screen.css' );
    }
    
    add_action( 'wp_enqueue_scripts', 'page_assets' );
    
    get_header();
    
    $cat = get_post();
    
    $term_condition = get_term_by('slug', $post->post_name, 'product_cat');
    $term = $term_condition ? $term_condition : get_term_by('slug', $post->post_name, 'product_tag');
    
        get_sidebar('header-first-screen');
        ?>
    
    <?php if ($term->taxonomy == 'product_cat') { ?>
        <section class="cat-content" id="cat-content">
    		<div class="container">
    			<div class="headings">
    				<h1 class="page-heading"><?php echo $cat->post_title; ?></h1>
    			</div>
    			<form class="filters-block" method="GET" action="<?php echo get_home_url(); ?>/#cat-content">
    				<div class="filters">
    				    <input type="hidden" name="s" value="">
    				    
    				    <?php
                            $tags = get_tags( array(
                                'taxonomy'      => 'from_where',	
                        		'hide_empty'    => true, 
                        		'object_ids'    => null,
                        		'orderby' => 'count', 
                        		'order' => 'DESC',
                        	));
                            
                        if ($tags && ! is_wp_error($tags)) {?>
        					<div class="filter">
        						<label for="from_where" class="filter-label">camera view</label>
        						<select name="from_where" id="from_where" class="shooting-type">
        						    <option selected disabled value> -- select -- </option>
        						    <?php foreach ($tags as $tag) { ?>
        							    <option value="<?php echo $tag->slug ?>" class="type"><?php echo $tag->name ?></option>
        							<?php } ?>
        						</select>
        					</div>
    					<?php } ?>
    					
    					<?php
                            $locations = get_terms(array(
                                'taxonomy'      => 'product_tag',	
                        		'orderby'       => 'id',
                        		'order'			=> 'DESC', 
                        		'hide_empty'    => true, 
                        		'object_ids'    => null
                            ));
                            
                        if ($locations && ! is_wp_error($locations)) {?>
        					<div class="filter">
        						<label for="spot" class="filter-label">spot</label>
        						<select name="spot" id="spot" class="shooting-type">
        						    <option selected disabled value> -- select -- </option>
        						    <?php foreach ($locations as $location) { ?>
        							    <option value="<?php echo $location->slug ?>" class="type"><?php echo $location->name ?></option>
        							<?php } ?>
        						</select>
        					</div>
    					<?php } ?>
    					<div class="filter">
    						<label for="date" class="filter-label">date</label>
    						<input type="date" id="date" name="date"
                               value=""
                               min="2020-01-01" max="<?php echo date("Y-m-d");  ?>">
    					</div>
    					<div class="filter from">
    						<label for="time_from" class="filter-label">time from</label>
    						<input type="time" step="60" id="time_from" name="time_from"
                               value="">
    					</div>
    					<div class="filter">
    						<label for="time_to" class="filter-label">to</label>
    						<input type="time" step="60" id="time_to" name="time_to"
                               value="<?php echo $search_time_to ?>">
    					</div>
    				</div>
    				<button class="custom-fill-btn">&check;</button>
    			</form>
    			<?php
    			    $images = new WP_Query(array(
    					'post_type' 	=> 'product',
    					'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'orderby'        => 'ID',
                        'order'          => 'DESC',
    					'tax_query' => array(
    					    array(
    						    'taxonomy' 	=> 'product_cat',
    						    'field'    => 'slug',
    						    'terms' 	=> $cat->post_name
    					    )
    					)
    				));
    				
    			?>
    			
    			<div class="images">
    				<ul class="images-list">
            			<?php while ( $images->have_posts() ) : $images->the_post(); ?>
                            <li class="image-element">
        						<a href="<?php the_permalink() ?>" class="to-image-link <?php echo $cat->post_name; ?>">
        							<div class="image" style="background-image: url(<?php the_post_thumbnail_url('medium-large'); ?>)"></div>
        						</a>
        						<span class="filename"><?php the_title() ?></span>
        					</li>
                        <?php endwhile; wp_reset_postdata(); ?>
    				</ul>
    				<div class="buttons-block">
    				    <?php if (is_user_logged_in()) { ?>
                            <a href="<?php echo get_permalink( get_page_by_path( pll__('Ярлык загрузить') ) ); ?>">
        					    <button class="fill-btn red">upload</button>
        					</a>
                        <?php } else { ?>
                            <a href="<?php echo wp_login_url(); ?>">
        					    <button class="fill-btn red">upload</button>
        					</a>
                        <?php } ?>
    				</div>
    			</div>
    		</div>
    	</section>  
    <?php } else if ($term->taxonomy == 'product_tag') { ?>
        <section class="content">
    			<div class="container">
    				<h1 class="page-heading"><?php echo $term->name ?></h1>
    				<div class="spot-content-block">
    					<div class="left">
    						<div class="buttons-block">
    							<a href="<?php echo get_home_url() ?>/?s=&spot=<?php echo $term->slug ?>&type=video"><button class="fill-btn green">video</button></a>
    							<a href="<?php echo get_home_url() ?>/?s=&spot=<?php echo $term->slug ?>&type=photo"><button class="fill-btn blue">photo</button></a>
    						</div>
    						<div class="location-image">
    							<div class="image-block" style="background-image: url(<?php echo get_field('img', $term) ? get_field('img', $term)['url'] :  get_template_directory_uri() . '/assets/images/default/spot-2.jpg' ; ?>)"></div>
    						</div>
    					</div>
    					<div class="right">
    						<h3 class="block-heading">About <?php echo $term->name ?></h3>
    						<div class="about-text"><?php echo term_description($term->ID, 'product_tag') ? term_description($term->ID, 'product_tag') : 'Ultra-consistent “Ulu’s” is the focal point of Balinese surfing thanks to it’s ability to handle any size swell from small to large and spread the biggest of crowds across a wide playing field of reef. It’s sectioning, hollow walls always produce great waves, starting with faster, high tide, occasional tuck-ins up at Temples that lead down to the muscular, steep drops of <br><br>
    
    The Peak that offers open face with hollow pockets directly in front of the famous cave. It can sometimes jump the deadspot and barrel through to the start of the Racetrack, which twists and bends the wailing walls in an ever increasing race against the falling curtain. <br><br>
    
    When swells exceed the 8-10ft mark, <br><br>
    
    Outside Corner will rumble into life, with heavy, thick-lipped sections at low tide for experts on sturdy pintails. Main hazard is the crowd, followed by the reef and the constant higher tide sweep that requires aiming for a spot well south of the cave to come in.<br><br>
    
    Blow it and you’ll paddle another 15min circuit.</div>' ; ?></div>
    					</div>
    				</div>
    			</div>
    		</section>
    <?php }
    
    get_footer();
} else {
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
						<h2 class="page-heading">Личный кабинет</h2>
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
};
