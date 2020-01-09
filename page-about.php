<?php
/**
 * Template Name: About Us
 */
$insert = ( isset($_GET['insert']) && $_GET['insert']==1 ) ? true : false;
insert_teams($insert);
get_header(); ?>

	<div id="primary" class="content-area default cf presspage">
		<main id="main" class="site-main cf" role="main">
	
			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>

					<?php 
					$video_type = get_field("video_type"); 
					$video_thumbnail = get_field("video_mp4_thumbnail"); 
					$video_embed = get_field("video_embed"); 
					$video_mp4 = get_field("video_mp4"); 
					$videoFormat = array("mp4");
					$vidThumb = ($video_thumbnail) ? ' style="background-image:url('.$video_thumbnail['url'].')"':'';
					?>

					<?php if( $video_type=='embed' ) { ?>
						<?php if ($video_embed) { ?>
						<div class="featured-video">
							<div class="embedvideo cf"><?php echo $video_embed; ?></div>
						</div>
						<?php } ?>
					<?php } else { ?>
						
						<?php if ($video_mp4) { ?>

							<?php 
								$file = pathinfo($video_mp4);
								$isVIDEO = ( isset($file['extension']) && in_array($file['extension'],$videoFormat) ) ? true : false;
								if($isVIDEO) { ?>
								<div class="featured-video videomp4">
									<div class="videwrap">
										<div class="inside">
											<video id="htmlVideo" width="400" height="300" controls playsinline>
												<source src="<?php echo $video_mp4; ?>" type="video/mp4">
												<p>Your browser doesn't support HTML5 video. <a href="<?php echo $video_mp4; ?>">Download</a> the video instead.
												</p>
											</video>
											<?php if ($video_thumbnail) { ?>
											<div class="video-thumb"<?php echo $vidThumb ?>></div>	
											<?php } ?>
											<a href="#" id="VidPlay">
												<span class="sr">PLAY</span>
												<span class="playBtn"><span><i class="b1"></i><i class="b2"></i><i class="b3"></i></span></span>
											</a>
										</div>
									</div>
								</div>
								<?php } ?>
							
						<?php } ?>


					<?php } ?>
				</div>
			</section>
			<?php endwhile; ?>


			<?php  
			/* PRESS ARTICLES */
			$args = array(
				'posts_per_page'=> -1,
			    'post_type' 	=> 'teams',
			    'post_status' 	=> 'publish',
			    'orderby' 		=> 'date',
				'order'			=> 'DESC',
			);
			$team = new WP_Query($args);
			$placeholder = get_bloginfo("template_url") . "/images/square.png";

			$teamBg = get_field("team_bg_image");
			$bgImg = ($teamBg) ? ' style="background-image:url('.$teamBg['url'].')"':'';
			if ( $team->have_posts() ) {  ?>
			<section class="section team-info">
				<div class="bg"<?php echo $bgImg ?>></div>
				<div class="section-content cf">
					<div class="wrapper cf">
					<?php while ( $team->have_posts() ) : $team->the_post();  ?>
						<?php  
						$photo = get_field("photo");
						$hasphoto = ($photo) ? 'hasphoto':'nophoto';
						$photoBg = ($photo) ? ' style="background-image:url('.$photo['sizes']['medium_large'].')"':'';
						$content = get_the_content();
						$content = ($content) ? strip_shortcodes( strip_tags($content) ) :'';
						$summary = ($content) ? shortenText($content,300," ","...") : '';
						?>
						<div class="infobox">
							<div class="photo <?php echo $hasphoto ?>">
								<div class="img"<?php echo $photoBg ?>><img src="<?php echo $placeholder  ?>" alt="" aria-hidden="" /></div>
							</div>
							<div class="text">
								<h2 class="name"><?php echo get_the_title(); ?></h2>
								<div class="bio"><?php echo $summary ?></div>
								<div class="more">
									<a href="<?php echo get_permalink(); ?>">Read More</a>
								</div>
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
