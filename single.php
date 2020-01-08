<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); ?>

	<div id="primary" class="content-area cf default singlepage">
		<main id="main" class="site-main cf" role="main">

		<?php while ( have_posts() ) : the_post(); 
			$type = get_field("feature_type");
			$thumbnail = '';
			$altImage = '';
			$embed = '';
			$is_video = ($type=='video') ? true : false;
			if($type=='image') {
				$img = get_field("image");
				$thumbnail = ($img) ? $img['url']: '';
				$altImage = ($img) ? $img['title']: '';
			} 
			else if($type=='video') {
				$vid = get_field("video");
				$thumbnail = ( isset($vid['thumbnail']) && $vid['thumbnail'] ) ? $vid['thumbnail']['url']:'';
				$altImage = ( isset($vid['thumbnail']) && $vid['thumbnail'] ) ? $vid['thumbnail']['title']: '';
				$embed = ( isset($vid['embed']) && $vid['embed'] ) ? $vid['embed']:'';
			}
			//$imageStyle = ($thumbnail) ? ' style="background-image:url('.$thumbnail.')"':'';
			$hasImage = ($thumbnail) ? 'hasphoto':'nophoto';
			?>
			<article class="article">
				<div class="wrapper">
					<h1 class="entry-title text-center"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
					
					<div class="featureImgVid text-center">
						<?php if($is_video && $embed) { ?>
							<div class="embedvideo"><?php echo $embed; ?></div>
						<?php } else { ?>
							<?php if ($thumbnail) { ?>
								<img src="<?php echo $thumbnail ?>" alt="<?php echo $altImage ?>" />
							<?php } ?>
						<?php } ?>
					</div>	
					
				</div>
			</article>
			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
