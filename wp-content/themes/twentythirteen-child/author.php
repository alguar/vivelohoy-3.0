<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				/*
				 * Queue the first post, that way we know what author
				 * we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">	
				<div style="overflow: overlay">	
					<div style="float: left; margin-right:10px"><?php echo get_avatar( get_the_author_meta('email'), '120' ); ?></div>	
					<div style="float: left">
						<h1 style="margin:0"><?php printf('<span class="vcard">' . get_the_author() . '</span>' ); ?>
						</h1>
						<p style="font-family: 'Helvetica', Helvetica, Arial, 'Lucida Grande', sans-serif;}">
							<?php the_author_meta('description'); ?>
							<br>
							<?php 
							
								$google_profile = get_the_author_meta( 'google_profile' );
								if ( $google_profile && $google_profile != '' ) {
									echo '<a href="' . esc_url($google_profile) . '" rel="author"><span class="genericon genericon-googleplus"></span></a>';
								}
								
								$twitter_profile = get_the_author_meta( 'twitter_profile' );
								if ( $twitter_profile && $twitter_profile != '' ) {
									echo '<a href="' . esc_url($twitter_profile) . '"><span class="genericon genericon-twitter"></a>';
								}
								
								$facebook_profile = get_the_author_meta( 'facebook_profile' );
								if ( $facebook_profile && $facebook_profile != '' ) {
									echo '<a href="' . esc_url($facebook_profile) . '"><span class="genericon genericon-facebook"></span></a>';
								}
								
								$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
								if ( $linkedin_profile && $linkedin_profile != '' ) {
									echo '<a href="' . esc_url($linkedin_profile) . '"><span class="genericon genericon-linkedin-alt"></span></a>';
								}
							?>
							<a href="mailto:<?php echo get_the_author_meta('user_email'); ?>"><?php the_author_meta('user_email'); ?></a>
						</p>
					</div>
				</div>	
			</header>
			<hr>

			<!-- TOP LEADERBOARD AD -->	
			<div id="topleaderboard-post">
				<iframe id="http://ad.doubleclick.net/adi/trb.vivelohoy2/hp;tile=1;ptype=sf;pos=1;sz=728x90;u=%s;ord=%s" height="90" width="728" vspace="0" hspace="0" marginheight="0" marginwidth="0" align="center" frameborder="0" scrolling="no" src="http://ad.doubleclick.net/adi/trb.vivelohoy2/hp;tile=1;ptype=sf;pos=1;sz=728x90;u=http://www.vivelohoy.com/;ord=86950313"></iframe>
			</div>
			<!-- TOP LEADERBOARD AD -->


			<?php
				/*
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<div style="overflow: hidden;">			
				<!-- Start of the Loop -->
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<?php if ('gallery' === get_post_format($post->ID)) : ?>
					<div class="excerpt-post clearfix">
						<div style="float: left"><a href="<?php the_permalink() ?>" rel="bookmark" accesskey="s"><?php $image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
							$imgurl=$image[0];
						 	?><img style="padding-right:10px; width:368px" src="<?php echo $imgurl;?>"></a>
						</div>
						<div class="author-meta" style="margin: 0 20px 0 0">
							<h3 id="post-<?php the_ID(); ?>" style="display: inline">
								<a href="<?php the_permalink() ?>" rel="bookmark" accesskey="s"><?php the_title(); ?></a>
							</h3><br>
							<h6 style="display: inline; color: #808080;font-weight: 400;letter-spacing: 0.06em;}">
								<?php $category = get_the_category(); 
								if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>
							</h6>
							<br>
							
								<?php the_excerpt(); ?>
							
						</div>
					</div>
				<?php else : // if get_post_format() is not 'gallery' ?>
					<?php if ( $post->post_excerpt ) : // If there is an explicitly defined excerpt ?>
					<div class="excerpt-post clearfix">
						<div style="float: left"><a href="<?php the_permalink() ?>" rel="bookmark" accesskey="s"><?php $image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
							$imgurl=$image[0];
						 	?><img style="padding-right:10px; width:368px" src="<?php echo $imgurl;?>"></a>
						</div>
						<div class="author-meta" style="margin: 0 20px 0 0">
							<h3 id="post-<?php the_ID(); ?>" style="display: inline">
								<a href="<?php the_permalink() ?>" rel="bookmark" accesskey="s"><?php the_title(); ?></a>
							</h3><br>
							<h6 class="author-cat" style="display: inline; color: #808080;font-weight: 400;letter-spacing: 0.06em;}">
								<?php $category = get_the_category(); 
								if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>
							</h6>
							<br>
							
								<?php the_excerpt(); ?>
							
						</div>
					</div>
					<?php else : // If there is not an explictly defined excerpt ?>
					<div class="excerpt-post clearfix">
						<h2 id="post-<?php the_ID(); ?>">
							<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>
					</div><!-- end of excerpt-post -->
					<?php endif; // End the excerpt vs. content "if" statement ?>
				<?php endif; // End gallery vs standard statement ?>
				<?php endwhile; // End while ( have_posts() ) ?>
				<?php endif; // End if ( have_posts() ) ?>
			<!--end Loop -->
			</div> <!-- End div style="overflow: hidden;" -->


			<?php twentythirteen_paging_nav(); ?>

			<?php else : // If not have_posts() for the whole author page ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; // End if ( have_posts() ) for the whole author page ?>
			<!-- BOTTOM LEADERBOARD AD -->	
				<div id="bottomleaderboard-post">
					<iframe id="http://ad.doubleclick.net/adi/trb.vivelohoy2/hp;tile=1;ptype=sf;pos=1;sz=728x90;u=%s;ord=%s" height="90" width="728" vspace="0" hspace="0" marginheight="0" marginwidth="0" align="center" frameborder="0" scrolling="no" src="http://ad.doubleclick.net/adi/trb.vivelohoy2/hp;tile=1;ptype=sf;pos=1;sz=728x90;u=http://www.vivelohoy.com/;ord=86950313"></iframe>
				</div>
			<!-- BOTTOM LEADERBOARD AD -->
			
			

<?php get_footer(); ?>