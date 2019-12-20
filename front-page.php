<?php 
$banner = get_field("banner");
get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
			$title1 = get_field("row1_title"); 
			$text1 = get_field("row1_text"); 
			$buttonName = get_field("row1_button_label"); 
			$buttonLink = get_field("row1_button_link"); 
			?>

			<section class="section row1 fadeIn wow">
				<div class="textwrap">
					<div class="wrapper text-center">
						<?php if ($title1) { ?>
							<h2 class="title"><?php echo $title1 ?></h2>
						<?php } ?>
						<?php if ($text1) { ?>
							<div class="text"><?php echo $text1 ?></div>
						<?php } ?>
						<?php if ($buttonName && $buttonLink) { ?>
							<div class="buttondiv cf"><a href="<?php echo $buttonLink ?>" class="btn-default"><?php echo $buttonName ?></a></div>
							<div class="scrolldown"><span class="arrowdown"></span></div>
						<?php } ?>
					</div>
				</div>
			</section>

			<?php if( $fsgroup = get_field("fsgroup") ) { ?>
			<section class="section fsgroup cf">
				<div class="wrapper">
					<div class="flexwrap">
					<?php foreach ($fsgroup as $fs) { 
						$fsLogo = $fs['logo'];
						$featImg = $fs['featured_image'];
						$fsLink = $fs['link'];
						$openLink = '';
						$closeLink = '';
						if($fsLink) {
							$openLink = '<a href="'.$fsLink.'" target="_blank">';
							$closeLink = '</a>';
						}
						$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
						?>
						<div class="fsgroup">
							<div class="fsimage">
								<?php echo $openLink; ?>
								<span class="wrap">
								<?php if ($fsLogo) { ?>
									<img class="fslogo" src="<?php echo $fsLogo['url'] ?>" alt="<?php echo $fsLogo['title'] ?>">
								<?php } ?>
								<?php if ($featImg) { ?>
									<img class="featimg" src="<?php echo $featImg['url'] ?>" alt="<?php echo $featImg['title'] ?>">
								<?php } else { ?>
									<img class="featimg nophoto" src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
								<?php } ?>
								</span>
								<?php echo $closeLink; ?>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			</section>
			<?php } ?>


		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
