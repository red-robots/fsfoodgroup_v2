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

			<?php while ( have_posts() ) : the_post(); 
				$main_content = get_the_content();
				$main_content = ($main_content) ? email_obfuscator($main_content) : '';
				// $mainStrings = '';
				// ob_start();
				// echo $main_content;
				// $mainStrings = ob_get_contents();
				// ob_end_clean();
				// $hasH1Tag = false;
				// if(strpos($mainStrings, '<h1>') !== false){
				//     $hasH1Tag = true;
				// } else{
				//     $hasH1Tag = false;
				// }
			?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php echo $main_content; ?></div>
				</div>
			</section>
			<?php endwhile; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
