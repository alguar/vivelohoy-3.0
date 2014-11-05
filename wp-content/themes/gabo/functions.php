<?php
global $ADS_ENABLED;
$ADS_ENABLED = true;

/*
This determines which ptype is set in the JavaScript header files for Tribune AdOps ad
insertion. These files are found in ./inc/ads/.
*/
$AD_TAG_DEV = false;

/*
  $content_width is the width of our content as defined in style.css:

    .entry-header,
    .entry-content,
    .entry-summary,
    .entry-meta {
        margin: 0 auto;
        max-width: 860px;
        width: 100%;
    }
 http://wycks.wordpress.com/2013/02/14/why-the-content_width-wordpress-global-kinda-sucks/
*/
$content_width = 860;
	
// Reset theme to only provide video and gallery post formats in addition to Standard (considered no format)
// See http://codex.wordpress.org/Post_Formats#Formats_in_a_Child_Theme
add_action( 'after_setup_theme', 'gabo_post_formats', 11 );
function gabo_post_formats(){
     add_theme_support( 'post-formats', array( 'gallery' ) );
}


// Changing WP Gallery Default Settings
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'custom_gallery');


function custom_gallery($attr) {
	// hard-coding these values so that they can't be broken
	$attr['columns'] = 1;
	$attr['size'] = 'large';
	$attr['link'] = 'none';
	// Let the normal gallery shortcode handler do the rest
	return gallery_shortcode( $attr );
}

// Add Author Links 
function add_to_author_profile( $contactmethods ) {
	
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
  $contactmethods['instagram_profile'] = 'Instagram Profile URL';
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);

// Remove Extra Fields
function add_twitter_contactmethod( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  unset($contactmethods['twitter']);
  unset($contactmethods['googleplus']);
  unset($contactmethods['facebook']);
  return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);

/**
 * Overiding post_nav function
 */
function gabo_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'gabo' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'gabo' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'gabo' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
/**
 * Overriding paging_nav function
 */

function gabo_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'gabo' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gabo' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gabo' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Enqueue scripts and styles for the front end.
 *
 */
function gabo_scripts_styles() {
  // Loads our main stylesheet with a version number associated with the last modified time.
  $stylesheet_last_modified = filemtime( get_stylesheet_directory() . '/style.css' );
  wp_enqueue_style( 'gabo-style', get_stylesheet_uri(), array(), $stylesheet_last_modified );
  // Load our stylesheet for the home loop
  wp_enqueue_style( 'gabo-home-loop', get_stylesheet_directory_uri() . '/css/home-loop.css',
                    array(), filemtime( get_stylesheet_directory() . '/css/home-loop.css' ) );

  // Add script for the nav changer
  wp_enqueue_script('nav-changer', get_stylesheet_directory_uri() . '/js/nav-changer.js', array('jquery'), '2014-08-26', true);
	// Loads script for handling buttons on floating nav
	wp_enqueue_script( 'gabo-navbuttons', get_stylesheet_directory_uri() . '/js/nav-buttons.js', array('jquery'), '2014-07-14', true );
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_stylesheet_directory_uri() . '/fonts/genericons.css', array(), '3.1' );
	// Add custom Fontello font found at www.fontello.com
	wp_enqueue_style( 'fontello', get_stylesheet_directory_uri() . '/fonts/fontello/css/hoy.css', array(), '2014-08-12');
	// Add script for the list-grid toggle in nav
	wp_enqueue_script('list-grid', get_stylesheet_directory_uri() . '/js/list-grid.js', array('jquery'), '2014-08-13');
  // Add Google Font Andada
  wp_enqueue_style('font-andada', 'http://fonts.googleapis.com/css?family=Andada', array(), '2014-08-28');
  // Adds jQuery Waypoints
  wp_enqueue_script( 'jquery-waypoints', get_stylesheet_directory_uri() . '/js/waypoints/waypoints.min.js', array('jquery'), '2.0.5' );
  // Adds gallery analytics code dependent on jquery-waypoints
  wp_enqueue_script( 'gallery-analytics', get_stylesheet_directory_uri() . '/js/gallery_analytics.js', array('jquery', 'jquery-waypoints'), '2014-09-17' );
  // Adds ImgLiquid
  wp_enqueue_script('img-liquid', get_stylesheet_directory_uri() . '/js/imgliquid/imgLiquid-min.js', array('jquery'), '0.9.944');
  // Loads ImgLiquid
  wp_enqueue_script('load-img-liquid', get_stylesheet_directory_uri() . '/js/imgliquid/load_imgliquid.js', array('jquery'), '0.9.944', true);

  wp_enqueue_script('mediaCheck', get_stylesheet_directory_uri() . '/js/mediaCheck/mediaCheck-min.js', array(), '0.4.5');

  // Add dashicons to frontend
  wp_enqueue_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'gabo_scripts_styles' );

// Custom Editor Style CSS - Able to style TinyMCE
function my_theme_add_editor_styles() {
    add_editor_style( 'assets/css/custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

// Add support of other languages
function gabo_theme_setup(){
  load_theme_textdomain('gabo', get_stylesheet_directory() . '/languages');
  // This theme uses its own gallery styles.
  add_filter( 'use_default_gallery_style', '__return_false' );

  /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, icons, and column width.
   */
  add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

  // Adds RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Switches default core markup for search form, comment form,
   * and comments to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );


  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );
}
add_action('after_setup_theme', 'gabo_theme_setup');

// Placing image caption in proper caption location
add_action( 'add_attachment', 'gabo_attachment' );
function gabo_attachment($id) {
    /*
        title       post_title
        caption     post_excerpt
        description post_content
        alt text    <this one is special>
    */
    $attachment = & get_post( $id, ARRAY_A );
    if ( !empty( $attachment ) ) {
        $attachment['post_excerpt'] = $attachment['post_content'];
        // Some images lack a headline in their metadata, which is what
        // the post_title is derived from. We don't want to set the post_content,
        // i.e. description, to the title unless it exists.
        if ( '' !== $attachment['post_title'] ) {
            $attachment['post_content'] = $attachment['post_title'];
        }
        wp_update_post($attachment);
    }
}

// Total hack to expand the attachment details in the media uploader modal dialog
function expand_attachment_details() {
?>
	<style>
	.media-modal .media-toolbar { right: 700px; }
	.media-modal .attachments { right: 700px; }
	.media-modal .media-sidebar { width: 667px; }
	</style>
<?php
}
add_action( 'admin_footer', 'expand_attachment_details' );

// Set defaults for image media insertion
function gabo_insert_image_defaults() {
	// http://codex.wordpress.org/Option_Reference#Uncategorized
	update_option( 'image_default_link_type', 'post' ); // 'post' means link to attachment page
	update_option( 'image_default_size', 'large' );
	update_option( 'large_size_w', 860 ); // should be same as $content_width
	update_option( 'large_size_h', 600 );
}
add_action( 'after_setup_theme', 'gabo_insert_image_defaults' );


include_once('inc/relativetime.php');
include_once('inc/utils.php');
include_once('inc/ads.php');
include_once('inc/omniture.php');

/**
 * Registers an image size for the post thumbnail
 */
function gabo_thumb() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 300, 200, true );
}
add_action( 'after_setup_theme', 'gabo_thumb', 11 );

/*
Thank you! http://callmenick.com/2014/02/21/custom-wordpress-loop-with-pagination/
*/
function custom_pagination($numpages = '', $pagerange = '', $paged='') {
 
  if (empty($pagerange)) {
    $pagerange = 2;
  }
 
  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
 
  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => '/page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo; Previa'),
    'next_text'       => __('Siguiente &raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);
  
  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo $paginate_links;
    echo "</nav>";
  }
}

// Overiding attachment image width
function gabo_content_width() {
  global $content_width;

  if ( is_attachment() )
    $content_width = 860;
}
add_action( 'template_redirect', 'gabo_content_width', 11 );

// Images to link to none by default, until we bring back the attachment page
function default_image_upload_settings() {
  
  update_option('image_default_align', 'center' );
  update_option('image_default_link_type', 'none' );
}
add_action('after_setup_theme', 'default_image_upload_settings');

add_filter( 'pre_get_posts', 'my_get_posts' );

// CPTs to be included in homepage
function my_get_posts( $query ) {

  if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', array( 'post', 'enfoque', 'patrocinado' ) );

  return $query;
}

// CPTs to be included in category archive
function namespace_add_custom_types( $query ) {
  if( ( is_category() || is_tag() ) && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'enfoque', 'patrocinado'
    ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );


/****

twentythirteen carry-overs

****/

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function gabo_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name', 'display' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'gabo' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'gabo_wp_title', 10, 2 );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
  $fonts_url = '';

  /* Translators: If there are characters in your language that are not
   * supported by Source Sans Pro, translate this to 'off'. Do not translate
   * into your own language.
   */
  $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

  /* Translators: If there are characters in your language that are not
   * supported by Bitter, translate this to 'off'. Do not translate into your
   * own language.
   */
  $bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

  if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
    $font_families = array();

    if ( 'off' !== $source_sans_pro )
      $font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

    if ( 'off' !== $bitter )
      $font_families[] = 'Bitter:400,700';

    $query_args = array(
      'family' => urlencode( implode( '|', $font_families ) ),
      'subset' => urlencode( 'latin,latin-ext' ),
    );
    $fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
  }

  return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
  /*
   * Adds JavaScript to pages with the comment form to support
   * sites with threaded comments (when in use).
   */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

  // Adds Masonry to handle vertical alignment of footer widgets.
  if ( is_active_sidebar( 'sidebar-1' ) )
    wp_enqueue_script( 'jquery-masonry' );

  // Loads JavaScript file with functionality specific to Twenty Thirteen.
  wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2014-06-08', true );

  // Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
  wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

  // Loads our main stylesheet.
  wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

  // Loads the Internet Explorer specific stylesheet.
  wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
  wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );