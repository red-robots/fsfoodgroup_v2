<?php
$banner = get_field("banner");
$border = get_bloginfo("template_url") . "/images/banner-border.jpg";
if($banner) { ?>
<div id="banner" class="banner cf">
	<?php if( get_custom_logo() ) { ?>
        <div class="logo">
        	<?php the_custom_logo(); ?>
        </div>
    <?php } else { ?>
        <h1 class="logo">
            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
        </h1>
    <?php } ?>
	<img class="banner-image" src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" />
</div>
<div class="banner-border"></div>
<div class="banner-mirror"><img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" /></div>
<?php } ?>