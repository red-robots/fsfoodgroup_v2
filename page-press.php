<?php
/**
 * Template Name: Press
 */

get_header(); ?>

	<div id="primary" class="content-area default">
		<main id="main" class="site-main wrapper cf" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
