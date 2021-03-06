<?php
$banner = get_field("banner");
$border = get_bloginfo("template_url") . "/images/banner-border.jpg";
if( is_front_page() ) {

    if($banner) { ?>
    <div id="banner" class="banner cf">
    	<?php if( get_custom_logo() ) { ?>
            <div class="logo zoomIn wow">
            	<?php the_custom_logo(); ?>
            </div>
        <?php } else { ?>
            <h1 class="logo">
                <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
            </h1>
        <?php } ?>
    	<img class="banner-image" src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" />
        <div class="mobileMenu"><button class="menu-mobile menu-toggle menutoggle2" aria-controls="primary-menu" aria-expanded="false"><span class="sr"><?php esc_html_e( 'MENU', 'bellaworks' ); ?></span><span class="bar"></span></button></div>
    </div>
    <div class="banner-border"></div>
    <div class="banner-mirror"><img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" /></div>
    <?php } ?>

<?php } else { ?>

    <?php if ($banner) { ?>
        <div id="subpage-banner" class="subpage-banner cf">
            <img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" />
        </div>
    <?php } ?>

<?php } ?>