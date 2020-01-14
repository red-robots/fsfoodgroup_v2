<?php
/**
 * Template Name: Careers
*/

get_header(); ?>

	<div id="primary" class="content-area cf default careers">
		<main id="main" class="site-main cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php //the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
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
			$items = get_posts($args);
			$numItems = array();
			if($items) {
				$i=1; foreach($items as $e) {
					$pageLink = get_field("careerslink",$e->ID);
					if($pageLink) {
						$numItems[] = $e->ID;
					}
					$i++;
				}
			}
			$countItems = ($numItems) ? count($numItems) : 0;
			$colClass = 'columns4';
			if($countItems==2) {
				$colClass = 'columns2';
			}
			else if($countItems==4) {
				$colClass = 'columns4';
			}
			else if($countItems==5) {
				$colClass = 'columns5';
			}
			else if($countItems<=3) {
				$colClass = 'columns3';
			}
			else if($countItems>=6) {
				$colClass = 'columns6';
			}
			if( $fsgroup ) { ?>
			<section id="concepts" class="section fsgroup cf <?php echo $colClass ?>">
				<div class="wrapper cf">
					<div class="flexwrap cf">
						<?php while ( $fsgroup->have_posts() ) : $fsgroup->the_post(); 
						$fsLogo = get_field("logo");
						$featImg = get_field("featured_image");
						$bgStyle = ($featImg) ? ' style="background-image:url('.$featImg['url'].')"':'';
						$fsLink = get_field("link");
						$pageLink = get_field("careerslink");
						$openLink = '';
						$closeLink = '';
						if($pageLink) {
							$openLink = '<a href="'.$pageLink.'" target="_blank">';
							$closeLink = '</a>';
						}
						$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
						if($pageLink) { ?>
						<div class="fsgroup-item cf">
							<div class="fsimage">
								<?php echo $openLink; ?>
								<span class="wrap"<?php echo $bgStyle ?>>
								<?php if ($fsLogo) { ?>
									<img class="fslogo" src="<?php echo $fsLogo['url'] ?>" alt="<?php echo $fsLogo['title'] ?>">
								<?php } ?>
								<?php if ($featImg) { ?>
									<img class="placeholder" src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
								<?php } ?>
								</span>
								<?php echo $closeLink; ?>
							</div>
						</div>
						<?php } ?>
						<?php endwhile; wp_reset_postdata(); ?>	
					</div>
				</div>
			</section>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
