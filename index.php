<?php if ( have_posts() ) : 
			while ( have_posts() ) :
				the_post();?>

				<div><?php the_title() ?></div>
    
	    	<?php endwhile;

		endif;
		?>