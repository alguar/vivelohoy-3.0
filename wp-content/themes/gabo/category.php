<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Gabo
 * @since Gabo  1.0
 */

get_header('category'); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main" style="margin: 0 auto">

		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php include_once("home-loop.php") ?>

			<?php
		        if (function_exists(custom_pagination)) {
		        	custom_pagination($custom_query->max_num_pages,"",$paged);
		        }
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>