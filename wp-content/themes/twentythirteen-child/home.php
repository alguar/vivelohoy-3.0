<?php

get_header('enfoque'); ?>

<?php 
	$args = array(
			'post_type' => array( 'post', 'enfoque' ),
			'posts_per_page' => 1,
			'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
			'page' => ( get_query_var('page') ) ? get_query_var('page') : 1
		);
	$the_query = new WP_Query( $args );
?>
<div id="primary" class="content-area" style="height:100%">
	<div class="boxSep">

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<header class="enfoque-header">
			<div class="post-in-loop" style="padding:0 20px">
			    <a href="<?php the_permalink() ?>" rel="bookmark" accesskey="s" style="color: #FFF !important;">
					<h1 class="enfoque-title"><?php echo get_the_title(); ?></h1>
			    </a>
				<div class="enfoque-author-link">
			        Por<?php _e( '', 'twentythirteen-child'); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			            <?php echo get_author_name( get_the_author_meta( 'ID' ) ); ?>
			        </a>
			    </div>
			    <div class="enfoque-category-link">
			        <?php
			            $category = get_the_category();
			            if ( $category[0] ) { ?>
			                <span class="category-en">en<?php _e( '', 'twentythirteen-child'); ?> </span>
			                <a href="<?php echo get_category_link( $category[0]->term_id ); ?>">
			                    <?php echo $category[0]->cat_name; ?>
			                </a><?php
			            }
			        ?>
			    </div>
			    <div class="enfoque-timestamp">
			        <?php echo relativeTime(get_the_time('U'), ' m/j/y g:ia'); ?>
			    </div>
			    <div class="post-excerpt">
				    <?php the_excerpt(); ?>
				</div>
			</div>
		</header>
		<div class="imgLiquidFill imgLiquid">
			<?php
				if ( 'enfoque' === get_post_type() || 'patrocinado' === get_post_type() ) {
					$image_id = get_field( 'main_image' );
				} else {
					$image_id = get_post_thumbnail_id();
				}
				$medium_image = wp_get_attachment_image_src( $image_id , 'medium' );
				$medium_image = $medium_image[0];
				$large_image = wp_get_attachment_image_src( $image_id, 'large' );
				$large_image = $large_image[0];
				$full_image = wp_get_attachment_image_src( $image_id, 'full' );
				$full_image = $full_image[0];
			?>
			<img
				class="data-img no-lazy"
				src="<?php echo get_stylesheet_directory_uri() . "/assets/images/1x1.png"; ?>"
				data-sml="<?php echo $medium_image; ?>"
				data-med="<?php echo $large_image; ?>"
				data-lrg="<?php echo $full_image; ?>"
			>
		</div>

<?php endwhile; // end of the loop ?>
<style>
	div.left a,
	div.right a {
		color: #FFF !important;
		border: none; 
		font-size: 400%;
	}
</style>
<div class="left" style="position: fixed; top: 50%; left: 1%;">
	<!-- going left should go to past posts -->
	<?php
		// next_posts_link refers to posts in the past 
		next_posts_link( '&lt;', $the_query->max_num_pages );
	?>
</div>
<div class="right" style="position: fixed; top: 50%; left: 90%;">
	<!-- going right should go to future posts -->
	<?php
		// previous_posts_link refers to posts in the future 
		previous_posts_link( '&gt;' );
	?>
</div>

<?php wp_reset_postdata(); ?>
	</div>
</div>

<?php get_footer(); ?>