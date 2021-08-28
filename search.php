<?php
function page_assets() {
    wp_enqueue_style( 'index-styles', get_template_directory_uri() . '/assets/css-min/category.css' );
    wp_enqueue_style( 'header-first-screen-styles', get_template_directory_uri() . '/assets/css-min/header-first-screen.css' );
}

add_action( 'wp_enqueue_scripts', 'page_assets' );

get_header();

$search_text = get_query_var('s');

if( isset( $_GET['from_where'])) {
    $search_from = $_GET['from_where']; 
} else {
    $search_from = null;
}

if( isset( $_GET['date'])) {
    $search_date = $_GET['date']; 
} else {
    $search_date = null;
}

if( isset( $_GET['time_from'])) {
    $search_time_from = $_GET['time_from']; 
} else {
    $search_time_from = null;
}

if( isset( $_GET['time_to'])) {
    $search_time_to = $_GET['time_to']; 
} else {
    $search_time_to = null;
}

if( isset( $_GET['type'])) {
    $search_cat = $_GET['type']; 
} else {
    $search_cat = null;
}

if( isset( $_GET['spot'])) {
    $search_spot = $_GET['spot']; 
} else {
    $search_spot = null;
}
 
    get_sidebar('header-first-screen');
    ?>
            
    <section class="cat-content" id="cat-content">
		<div class="container">
			<div class="headings">
				<h1 class="page-heading"><?php echo $search_cat ? $search_cat : 'search'; ?></h1>
				
				<?php $spot =  get_term_by( 'slug', $search_spot, 'product_tag'); ?>
				<h3 class="location-heading"><?php echo ($search_spot) ? $spot->name : ""; ?></h3>
			</div>
			<form class="filters-block" method="GET" action="<?php echo get_home_url(); ?>/#cat-content">
				<div class="filters">
				    <input type="hidden" name="s" value="<?php echo $search_text ?>">
				    
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
    						    <option <?php echo ($search_from) ? '' : 'selected'; ?> disabled value> -- select -- </option>
    						    <?php foreach ($tags as $tag) { ?>
    						        <?php $is_selected = ($tag->slug == $search_from) ? 'selected' : ''; ?>
    							    <option <?php echo $is_selected ?> value="<?php echo $tag->slug ?>" class="type"><?php echo $tag->name ?></option>
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
    						    <option <?php echo ($search_spot) ? '' : 'selected'; ?> disabled value> -- select -- </option>
    						    <?php foreach ($locations as $location) { ?>
    						        <?php $is_selected = ($location->slug == $search_spot) ? 'selected' : ''; ?>
    							    <option <?php echo $is_selected ?> value="<?php echo $location->slug ?>" class="type"><?php echo $location->name ?></option>
    							<?php } ?>
    						</select>
    					</div>
					<?php } ?>
					<div class="filter">
						<label for="date" class="filter-label">date</label>
						<input type="date" id="date" name="date"
                           value="<?php echo $search_date ?>"
                           min="2020-01-01" max="<?php echo date("Y-m-d");  ?>">
					</div>
					<div class="filter from">
						<label for="time_from" class="filter-label">time from</label>
						<input type="time" step="60" id="time_from" name="time_from"
                           value="<?php echo $search_time_from ?>">
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
			    
			    
			    $args = array(
					'post_type' 	 => 'product',
					'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'ID',
                    'order'          => 'DESC',
                    's'              => $search_text,
					'tax_query' => [
                		'relation' => 'AND',
                		($search_cat) ? [
                			'taxonomy' 	=> 'product_cat',
                			'field'     => 'slug',
						    'terms' 	=> $search_cat
                		] : true,
                		
                		($search_from) ? [
                			'taxonomy'  => 'from_where',
                			'field'     => 'slug',
						    'terms' 	=> $search_from
                		] : true,
                		
                		($search_spot) ? [
                			'taxonomy'  => 'product_tag',
                			'field'     => 'slug',
						    'terms' 	=> $search_spot
                		] : true
                	]
				);
				if ($search_date) {
				    $search_date = getDate(strtotime($search_date));
				    $args['year'] = $search_date['year'];
				    $args['monthnum'] = $search_date['mon'];
                    $args['day'] = $search_date['mday'];
				};
				
				if ($search_time_from) {
				    $values = explode(":", $search_time_from);
				    $args['date_query'] = [
                		[
                			'hour'      => $values[0],
                			'minutes'   => $values[1],
                			'compare'   => '>=',
                		]
                	];
                	
                	if ($search_time_to) {
    				    $values_to = explode(":", $search_time_to);
    				    $args['date_query'] = [
    				        [
                    			'hour'      => $values[0],
                    			'minutes'   => $values[1],
                    			'compare'   => '>=',
                    		],
                    		[
                    			'hour'      => $values_to[0],
                    			'minutes'   => $values_to[1],
                    			'compare'   => '<=',
                    		]
                    	];
                	};
				};
				
				if ($search_time_to) {
				    $values_to = explode(":", $search_time_to);
				    $args['date_query'] = [
                		[
                			'hour'      => $values_to[0],
                			'minutes'   => $values_to[1],
                			'compare'   => '<=',
                		]
                	];
            	};
				
				$images = new WP_Query($args);
			?>
			
			<div class="images">
				<ul class="images-list">
        			<?php while ( $images->have_posts() ) : $images->the_post(); ?>
        			    <?php 
                            $current_types = get_the_terms ( get_the_ID(), 'product_cat' ); 
                            $current_type = array_shift($current_types);
                        ?>
                        <li class="image-element">
    						<a href="<?php the_permalink() ?>" class="to-image-link <?php echo $current_type->name ?>">
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

<?php
get_footer();
