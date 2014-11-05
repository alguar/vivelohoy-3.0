<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
	
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>	
			<?php endwhile; ?>
			<?php gabo_post_nav(); ?>
			
			<script>
			var is_gallery = <?php if ( 'gallery' === get_post_format() ) : ?>true<?php else: ?>false<?php endif; ?>;
			</script>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>