<?php
/*
Template Name: Шаблон главной страницы
Template Post Type: page
*/
function page_assets() {
    wp_enqueue_style( 'index-styles', get_template_directory_uri() . '/assets/css-min/index.css' );
    wp_enqueue_style( 'header-first-screen-styles', get_template_directory_uri() . '/assets/css-min/header-first-screen.css' );
}

add_action( 'wp_enqueue_scripts', 'page_assets' );

get_header();

$page = get_post();

            get_sidebar('header-first-screen');
            ?>
            
            <section class="second">
                <div class="container">
                    <div class="about-us-block">
                        <div class="about-us-text">
                            <?php the_field("about-website-text"); ?>
                        </div>
                        <div class="button-block">
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
                    </div>
                        <?php 
                            $types = get_terms( array(
                        		'taxonomy'      => 'product_cat',	
                        		'orderby'       => 'id',
                        		'order'			=> 'DESC', 
                        		'hide_empty'    => true, 
                        		'object_ids'    => null
                        	) );
                        if ($types && ! is_wp_error($types)) { ?>
                            <div class="our-content-block">
                                <?php foreach ($types as $type) { ?>
                                    <div class="content-category">
                                        <h3 class="block-heading"><?php echo $type->name ?></h3>
                                        <div class="images-preview">
                                            <div class="big-image">
                                                    <?php 
                                                        $images = new WP_Query(array(
                            								'post_type' 	=> 'product',
                            								'posts_per_page' => 1,
                                                            'post_status' => 'publish',
                                                            'orderby'        => 'ID',
                                                            'order'          => 'DESC',
                            								'tax_query' => array(
                            								    array(
                            									    'taxonomy' 	=> 'product_cat',
                            									    'terms' 	=> $type->term_id
                            								    )
                            								)
                            							));
                                                    ?>
                                                    <?php while ( $images->have_posts() ) : $images->the_post(); ?>
                                                        <a href="<?php echo get_term_link($type->term_id, 'product_cat'); ?>" class="to-image-link <?php echo $type->slug ?>">
                        		                    	    <div style="background-image: url(<?php the_post_thumbnail_url('medium_large'); ?>)" alt="photo preview" class="img"></div>
                                                        </a>
                        		                    	<?php break; ?>
                        		                    <?php endwhile; wp_reset_postdata(); ?>
                                            </div>
                                            <?php 
                                                $types_of_shooting = get_terms( array(
                                            		'taxonomy'      => 'from_where',	
                                            		'orderby'       => 'id',
                                            		'order'			=> 'ASC', 
                                            		'hide_empty'    => true, 
                                            		'object_ids'    => null
                                            	) );
                                            if ($types_of_shooting && ! is_wp_error($types_of_shooting)) {?>
                                                <div class="small-images">
                                                    <?php foreach ($types_of_shooting as $type_of_shooting) { 
                                                        
                                                        $images = new WP_Query(array(
                            								'post_type' 	=> 'product',
                            								'posts_per_page' => 1,
                                                            'post_status' => 'publish',
                                                            'orderby'        => 'ID',
                                                            'order'          => 'DESC',
                            								'tax_query' => [
                                                        		'relation' => 'AND',
                                                        		[
                                                        			'taxonomy' 	=> 'product_cat',
                            									    'terms' 	=> $type->term_id
                                                        		],
                                                        		[
                                                        			'taxonomy'  => 'from_where',
                            									    'terms' 	=> $type_of_shooting->term_id
                                                        		]
                                                        	]
                            							));
                                                        ?>
                                                        <?php while ( $images->have_posts() ) : $images->the_post(); ?>
                                                            <div class="small-image">
                                		                    	<a href="<?php echo get_home_url(); ?>/?s=&from_where=<?php echo $type_of_shooting->slug ?>&type=<?php echo $type->slug ?>" class="to-image-link <?php echo $type->slug ?>">
                                                                    <div style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>)" alt="photo preview" class="img"></div>
                                                                </a>
                                                                <div class="category-name"><?php echo $type_of_shooting->name ?></div>
                                                            </div>
                            		                    	<?php break; ?>
                            		                    <?php endwhile; wp_reset_postdata(); ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php
                            $locations = get_terms( 'product_tag', [
                            	'hide_empty' => false,
                            ] );
                            ?>
                            
                        <div class="our-content-block-2">
                            <?php if ($locations && ! is_wp_error($locations)) {?>
                                <div class="content location">
                                    <h3 class="block-heading">choice of location</h3>
                                    <table class="location-table">
                                        <tr class="table-row">
                                            <td class="table-cell location-name"></td>
                                            <?php foreach ($types as $type) { ?>
                                                <td class="table-cell location-<?php echo $type->slug ?>s">
                                                    <a href="<?php echo get_home_url() ?>/?s=&type=<?php echo $type->slug ?>" class="to-image-link">
                                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/default/<?php echo $type->slug ?>-icon.png" alt="photo<?php echo $type->slug ?> icon" class="<?php echo $type->slug ?>-icon">
                                                    </a>
                                                </td>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php foreach ($locations as $location) {?>
                                            <tr class="table-row">
                                                <td class="table-cell location-name"><a href="<?php echo get_term_link($location->term_id, 'product_tag'); ?>"><?php echo $location->name ?></a></td>
                                                <?php foreach ($types as $type) { ?>
                                                    <td class="table-cell location-<?php echo $type->slug ?>s">
                                                        <?php 
                                                            $args = array(
                                                                'post_type' => 'product',
                                                                'post_status' => 'publish',
                                								'tax_query' => [
                                                            		'relation' => 'AND',
                                                            		[
                                                            			'taxonomy' 	=> 'product_cat',
                                									    'terms' 	=> $type->term_id
                                                            		],
                                                            		[
                                                            			'taxonomy'  => 'product_tag',
                                									    'terms' 	=> $location->term_id
                                                            		]
                                                            	]
                                                            );
                                                            $the_query = new WP_Query( $args );
                                                        ?>
                                                        <a href="<?php echo get_home_url() ?>/?s=&spot=<?php echo $location->slug ?>&type=<?php echo $type->slug ?>" class="to-image-link">
                                                            <span class="count-elements"><?php echo $the_query->found_posts; ?></span>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            <?php } ?>
                            <?php
                                $tags_ids = [];
                                $missed_days = 0;
                                while (count($tags_ids) < 2) {
                                    $args = array(
                                        'posts_per_page'    => -1,
                                        'year'              => date('Y',strtotime("-" . $missed_days . " days")),
                                        'monthnum'          => date('m',strtotime("-" . $missed_days . " days")),
                                        'day'               => date('d',strtotime("-" . $missed_days . " days")),
                                        'post_type' => 'product',
                                        'orderby'        => 'ID',
                                        'post_status' => 'publish',
                                        'order'          => 'DESC',
                                        'tax_query' => array(
                                    		array(
                                    			'taxonomy' => 'product_cat',
                                    			'field'    => 'slug',
                                    			'terms'    => 'video'
                                    		)
                                    	)
                                    );
                                    $missed_days +=1;
                                    $images = new WP_Query( $args );
                                    
                                    $current_count = array();
                                    
                                    while ( $images->have_posts() ) : $images->the_post(); 
                                        $terms = get_the_terms( get_the_ID(), 'product_tag' );
                                        if( $terms ){
                                        	$term = array_shift( $terms );
                                            if (array_key_exists($term->term_id, $current_count)) {
                                                $current_count[$term->term_id] += 1;
                                            } else {
                                                $current_count[$term->term_id] = 1;
                                            }
                                        };
        		                    endwhile; wp_reset_postdata();
        		                    arsort($current_count);
        		                    foreach (array_keys($current_count) as $tag_id) {
        		                        array_push($tags_ids, $tag_id);
        		                    };
                                };
                                $tags_ids = array_slice($tags_ids, 0, 2);
                                
                                
                            if ($images && ! is_wp_error($images)) {?>
                                <div class="content top-spot">
                                    <h3 class="block-heading">top spot today</h3>
                                    <div class="top-spots">
                                        <?php foreach ($tags_ids as $tag_id) { ?>
                                            <?php 
                                                $tag = get_term( $tag_id, 'product_tag' );
                                                $args = array(
                                                    'posts_per_page'    => 1,
                                                    'post_type' => 'product',
                                                    'orderby'        => 'ID',
                                                    'post_status' => 'publish',
                                                    'order'          => 'DESC',
                                                    'tax_query' => [ 
                                                        'relations' => 'AND',
                                                        [
                                                            'taxonomy' 	=> 'product_tag',
                                                			'field'     => 'id',
                    									    'terms' 	=> $tag_id
                                                        ],
                                                        [
                                                            'taxonomy' 	=> 'product_cat',
                                                			'field'     => 'slug',
                    									    'terms' 	=> 'video'
                                                        ]
                                                	]
                                                );   
                                                $images = new WP_Query( $args );
                                            ?>
                                            <?php while ( $images->have_posts() ) : $images->the_post(); ?>
                                                <div class="top-spot">
                                                    <h4 class="top-spot-heading">
                                                        <?php echo $tag->name ?>
                                                    </h4>
                                                    <a href="<?php echo get_term_link( (int) $tag_id, 'product_tag');; ?>" class="to-image-link video">
                                                        <div style="background-image: url(<?php the_post_thumbnail_url('medium-large'); ?>)" alt="" class="img"></div>
                                                    </a>
                                                </div>
                		                    <?php endwhile; wp_reset_postdata(); ?>
                                        <?php } ?>
                                    </div>
                                    <div class="button-block">
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
                                </div>
                            <?php } ?>
                        </div>
                </div>
            </section>

<?php
get_footer();
