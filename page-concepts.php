<?php
/**
 * Template Name: Concepts
 */

get_header(); ?>

	<div id="primary" class="content-area default cf conceptpage">
		<main id="main" class="site-main cf" role="main">
	
			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
				</div>
			</section>
			<?php endwhile; ?>

			<div class="wrapper cf arrow-section text-center">
				<div class="scrolldown no-animate"><a href="#concepts" class="arrowdown"></a></div>
			</div>


			<?php  
			/* CONCEPTS */
			$perpage = -1;
			$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
			$args = array(
				'posts_per_page'=> $perpage,
			    'post_type' 	=> 'restaurants',
			    'post_status' 	=> 'publish'
			);
			$concepts = new WP_Query($args);
			$placeholder = get_bloginfo("template_url") . "/images/portrait.png";
			if ( $concepts->have_posts() ) {  ?>
			<section class="section section-concepts cf">
				<div id="concepts" class="wrapper">

					<?php while ( $concepts->have_posts() ) : $concepts->the_post(); 
						// $type = get_field("feature_type");
						// $thumbnail = '';
						// $embed = '';
						// $is_video = ($type=='video') ? true : false;
						// if($type=='image') {
						// 	$img = get_field("image");
						// 	$thumbnail = ($img) ? $img['sizes']['medium_large'] : '';
						// } 
						// else if($type=='video') {
						// 	$vid = get_field("video");
						// 	$thumbnail = ( isset($vid['thumbnail']) && $vid['thumbnail'] ) ? $vid['thumbnail']['sizes']['medium_large']:'';
						// 	$embed = ( isset($vid['embed']) && $vid['embed'] ) ? $vid['embed']:'';
						// }
						// $imageStyle = ($thumbnail) ? ' style="background-image:url('.$thumbnail.')"':'';
						// $hasImage = ($thumbnail) ? 'hasphoto':'nophoto';
						// $pagelink = get_permalink();
						// $title = get_the_title();
						$thumbnail = get_field('featured_image');
						$hasImage = ($thumbnail) ? 'hasphoto':'nophoto';
						$imageStyle = ($thumbnail) ? ' style="background-image:url('.$thumbnail['url'].')"':'';

						$fsLogo = get_field("logo");
						$featImg = get_field("featured_image");
						$fsLink = get_field("link");
						$openLink = '';
						$closeLink = '';
						if($fsLink) {
							$openLink = '<a href="'.$fsLink.'" target="_blank">';
							$closeLink = '</a>';
						}
						?>
						<div class="concept-info <?php echo $hasImage ?>">
							<div class="flexwrap">
								<div class="concept-image"<?php echo $var ?>>
									<div class="imagediv"<?php echo $imageStyle ?>>
									<?php echo $openLink; ?>
										<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true"/>
										<?php if ($fsLogo) { ?>
										<img src="<?php echo $fsLogo['url'] ?>" alt="<?php echo $fsLogo['title'] ?>" class="xfslogo" />
										<?php } ?>
									<?php echo $closeLink; ?>
									</div>
								</div>
								<div class="concept-text">
									<h2 class="title"><?php echo get_the_title(); ?></h2>
									<div class="text"><?php the_content(); ?></div>
									<?php if ($fsLink) { ?>
									<div class="sitelink"><a href="<?php echo $fsLink ?>" target="_blank">Visit Site</a></div>	
									<?php } ?>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</section>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
