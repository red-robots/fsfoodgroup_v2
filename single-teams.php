<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); ?>

	<div id="primary" class="content-area cf default single-team">
		<main id="main" class="site-main cf" role="main">

		<?php while ( have_posts() ) : the_post(); 
			$photo = get_field("photo");
			$hasphoto = ($photo) ? 'hasphoto':'nophoto';
			$placeholder = get_bloginfo("template_url") . "/images/square.png";
			?>
			<article class="article cf">
				<div class="wrapper cf">
					<div class="photo <?php echo $hasphoto ?>">
						<?php if ($photo) { ?>
							<img src="<?php echo $photo['url'] ?>" alt="<?php echo $photo['title'] ?>" />
						<?php } else { ?>
							<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
						<?php } ?>
					</div>
					<div class="entry-content">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="bio"><?php the_content(); ?></div>
					</div>
				</div>
			</article>
			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
