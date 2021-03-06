<?php
/**
 * Template Name: Thumbnail View
 * 
 */
?>

<?php get_header('home'); ?>


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main" style="max-width:960px">

<?php global $ADS_ENABLED; if ( $ADS_ENABLED ) : ?>
      <div id="top-leaderboard" class="adslot leaderboard" data-width="728" data-height="90" data-pos="1"></div>
<?php endif; // End if ( $ADS_ENABLED ) ?>
  
		  <div class="thumb-container">
			 
        <?php 
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $custom_args = array(
        'post_type' => 'post',
        'posts_per_page' => 14,
        'paged' => $paged
        );
        $custom_query = new WP_Query( $custom_args ); 
        ?>
 
        <?php if ( $custom_query->have_posts() ) : ?>


        <!-- the loop -->
        <?php while ( $custom_query->have_posts() ) : $custom_query->the_post();
  			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnail' );
  			$url = $thumb['0'];
  			?>
        
		    <div id="thumb-view">    
		      <a href="<?php the_permalink() ?>" rel="bookmark" accesskey="s"><div class="thumb-loop" style="background-image: url(<?php echo $url; ?>)"></div></a>  
          <div style="min-height: 76px; background:rgba(0, 0, 0, 0.76);margin: 0 1px">  
            <div class="thumb-cat">
             <?php 
              $category = get_the_category(); 
              if($category[0]){
              echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
              }
              ?>
             <div id="social-home">
              <a style="margin-right: 5px" class="twitter_link" href="http://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>" target="_blank"><span class="genericon genericon-twitter" style="margin-top: 0"></a>
              <a style="margin-right: 5px" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><span class="genericon genericon-facebook" style="margin-top: 0"></span></a>   
              </div>
              <h5 id="post-<?php the_ID(); ?>" class="thumb-heading">
              <a style="color:#fff; font-size:16px" href="<?php the_permalink() ?>" rel="bookmark" accesskey="s"><?php echo balanceTags(wp_trim_words( get_the_title(), $num_words = 11, $more = null ), true); ?></a>
              </h5>
            </div>
            
            <br>
          </div>    
        </div>

        <?php endwhile; ?>
        <!-- end of the loop -->
      
   		</div><!-- end of thumb container --> 
      <?php
        if (function_exists(custom_pagination)) {
          custom_pagination($custom_query->max_num_pages,"",$paged);
        }
      ?>

			<?php else : ?> 
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?> <!-- end if ( $custom_query->have_posts() ) : -->
<?php global $ADS_ENABLED; if ( $ADS_ENABLED ) : ?>      
      <div id="bottom-leaderboard" class="adslot leaderboard" data-width="728" data-height="90" data-pos="4"></div> 
<?php endif; // End if ( $ADS_ENABLED ) ?>
    </div><!-- #content -->
	</div><!-- #primary -->

	<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>