<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<?php
	// get the current page url (used for rel canonical and open graph tags)
	global $current_url;
	$current_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />

    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sm.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-med.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-lg.png" />	

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
    <?php print_ad_script("home page"); ?>
</head>

<body <?php body_class(); ?>>
	<?php include_once("analyticstracking.php") ?>

	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					
					<div id="hoy-menu" style="display:none">
						<div id="menu-global-navigation" class="hoy-menu">
							<ul>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'hoy-menu', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
							</ul>
							
								<footer class="entry-meta" style="padding: 12px 10px 70px 50px; margin-top:0; border-bottom: none" >
									<div>						
										<div style="text-align:center; font-family:helvetica; font-weight:300; letter-spacing:0.5px; height:30px">Síganos en:</div>
										<div style="height: 42px; text-align:center">
											<a href="https://twitter.com/vivelohoy" target="_blank" style="padding-right:10px"><span class="genericon genericon-twitter" style="color: #55acee"></span></a>
											<a href="https://www.facebook.com/HoyMedia" style="padding-right:20px" target="_blank"><span class="genericon genericon-facebook" style="margin-right: 5px; color:#3b5998"></span></a>	
											<a href="http://instagram.com/vivelohoy" style="padding-right:10px"><span class="genericon genericon-instagram" style="color: #3f729b"></span></a>
											<a href="https://www.youtube.com/user/VIVELOHOY"><span class="genericon genericon-youtube" style="color:#b31217"></span></a>
										</div>
									</div>
									<div id="footer-content" style="border-top:1px solid #E6E6E6"> 
											© 2014 Hoy      
								            <a href="/about-vivelohoy/"> Acerca de nosotros</a>
								            <a href="/advertise"> Advertise</a>
								            <a href="/terminos-de-servicio/"> Términos de servicio</a>
								 			<a href="/politica-de-confidencialidad"> Política de privacidad</a>
									</div>
								</footer>
						</div>
					</div>

					<div class="new-menu">	
						
						<a class="screen-reader-text skip-link" href="#main" title="Skip to content">Saltar al contenido</a>
						<div>
							<span id="hoy-menunav" class="genericon genericon-menu"></span>
							<a href="#" id="hoy-searchnav"><span class="genericon genericon-search" style="float: right; margin: 6px 7px 0 2px; color: #000"></span></a>
						
							<?php get_search_form() ?>	
						</div>
						<div>
							<a href="<?php echo home_url() ?>"><img class="nav-logo" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/hoy-logo.png"></a>
						</div>
						
					</div>

				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

						

		<div id="main" class="site-main">
