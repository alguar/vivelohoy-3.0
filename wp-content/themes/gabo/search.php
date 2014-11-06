<?php
/**
 * The template for displaying Search Results pages
 *
 */

get_header('home'); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h2><?php printf( __( 'Search Results for: %s', 'gabo' ), get_search_query() ); ?></h2>
				<hr>
			</header>

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