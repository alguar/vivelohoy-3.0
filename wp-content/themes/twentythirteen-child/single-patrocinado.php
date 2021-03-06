<?php

/**
 * Patrocinado Post type
 */

get_header('patrocinado');

?>
		<div id="primary" class="content-area" style="height:100%">

			<div class="boxSep" style="margin-top: 45px">
				<header class="enfoque-header">
						<div class="post-in-loop" style="padding:0 20px">
							<h1 class="enfoque-title"><?php echo get_the_title(); ?></h1>
							<div class="enfoque-author-link">
						        Por <a target="_blank" href="<?php echo esc_url( the_author_meta( 'user_url' ) ); ?>">
						            <?php echo get_author_name( get_the_author_meta( 'ID' ) ); ?>
						        </a>
						    </div>
						    <div class="enfoque-category-link">
						        <?php
						            $category = get_the_category();
						            if ( $category[0] ) { ?>
						                <span class="category-en">en </span>
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

    	   				<?php echo wp_get_attachment_image( get_field('main_image'), 'full' ); ?>

					</div>
					<div id="content" class="site-content" role="main" style="text-align: left; padding: 0 10px">
						<article class="patrocinado-footer" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
							<?php the_field('article'); ?>
							</div><!-- .entry-content -->
						</article><!-- #post -->

<?php get_footer('patrocinado'); ?>