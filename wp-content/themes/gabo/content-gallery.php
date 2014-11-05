<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package WordPress
 * @subpackage Gabo
 * @since Gabo 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" style="text-align:center">
		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
		<div class="author-cat" style="margin:0">

					By <?php the_author_posts_link(); ?> in <?php $category = get_the_category(); if($category[0]){ echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; } ?> <?php the_time('m/j/y g:i A') ?>

				<?php edit_post_link( __( 'Edit', 'gabo' ), '<span class="edit-link">', '</span>' ); ?>

		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( is_single() || ! get_post_gallery() ) : ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gabo' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gabo' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		<?php else : ?>
			<?php echo get_post_gallery(); ?>
		<?php endif; // is_single() ?>
	</div><!-- .entry-content -->


</article><!-- #post -->