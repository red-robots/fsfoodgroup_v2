<style type="text/css">
    .banner-wrap h2 {
        font-size: clamp(1.875rem, -11.9088rem + 22.973vw, 12.5rem);
    }
</style>
<?php
$banner = get_field("banner");
$border = get_bloginfo("template_url") . "/images/banner-border.jpg";
$custom_title = get_field('custom_title');
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
            <div class="banner-wrap">
                <?php if( $custom_title ){ ?>
                    <h2><?php echo $custom_title; ?></h2>
                <?php } ?>
            </div>
            <img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" />
        </div>
    <?php } ?>

<?php } ?>