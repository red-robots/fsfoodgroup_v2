<?php 
$banner = get_field("banner");
// $insert = ( isset($_GET['insert']) && $_GET['insert']==1 ) ? true : false;
// insert_teams($insert);
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
							<div class="scrolldown"><a href="<?php echo $buttonLink ?>" class="arrowdown"></a></div>
						<?php } ?>
					</div>
				</div>
			</section>

		<?php endwhile; ?>

		<?php  
			$post_type = 'restaurants';
			$args = array(
				'posts_per_page' => -1,
			    'post_type' => $post_type,
			    'post_status' => 'publish',
			);
			$fsgroup = new WP_Query($args);
		?>

		<?php if( $fsgroup ) { ?>
		<section id="concepts" class="section fsgroup cf">
			<div class="wrapper">
				<div class="flexwrap">
				<?php while ( $fsgroup->have_posts() ) : $fsgroup->the_post();

					// $fsLogo = $fs['logo'];
					// $featImg = $fs['featured_image'];
					// $fsLink = $fs['link'];
					$fsLogo = get_field("logo");
					$featImg = get_field("featured_image");
					$fsLink = get_field("link");
					$openLink = '';
					$closeLink = '';
					if($fsLink) {
						$openLink = '<a href="'.$fsLink.'" target="_blank">';
						$closeLink = '</a>';
					}
					$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
					?>
					<div class="fsgroup-item cf">
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
				<?php endwhile; wp_reset_postdata(); ?>	
				</div>
			</div>
		</section>
		<?php } ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
