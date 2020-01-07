<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site cf">
	<a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>
	
	<?php $headerClass = ( is_front_page() ) ? ' animated fadeInDown':'subpage-header'; ?>
	<header id="masthead" class="site-header cf <?php echo $headerClass ?>" role="banner">
		<div class="wrapper">

			<?php if ( !is_front_page() ) { ?>

				<?php if( $main_logo = get_field("main_logo","option") ) { ?>
		            <div class="logo-subpage">
		            	<a href="<?php echo get_site_url(); ?>"><img src="<?php echo $main_logo['url'] ?>" alt="<?php echo get_bloginfo("name"); ?>"></a>
		            </div>
		        <?php } ?>
						
			<?php } ?>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<div class="nav-wrap cf">
					<a href="#" class="closemenubtn menu-mobile"></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container_class'=>'main-menu-wrap' ) ); ?>
				</div>
			</nav><!-- #site-navigation -->
		</div><!-- wrapper -->
	</header><!-- #masthead -->
	<button class="menu-mobile menu-toggle menutoggle1" aria-controls="primary-menu" aria-expanded="false"><span class="sr"><?php esc_html_e( 'MENU', 'bellaworks' ); ?></span><span class="bar"></span></button>

	<?php get_template_part("parts/content","banner"); ?>

	<div id="content" class="site-content cf">
