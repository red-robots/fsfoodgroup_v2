<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

get_header(); ?>

	<div id="primary" class="content-area cf default">
		<main id="main" class="site-main cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
				</div>
			</section>
			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
