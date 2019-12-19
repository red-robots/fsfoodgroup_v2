<?php 
$banner = get_field("banner");
get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				$title1 = get_field("row1_title"); 
				$text1 = get_field("row1_text"); 
			?>

			<section class="section row1">
				<div class="textwrap">
					<div class="wrapper text-center">
						<?php if ($title1) { ?>
							<h2 class="title"><?php echo $title1 ?></h2>
						<?php } ?>
						<?php if ($text1) { ?>
							<div class="text"><?php echo $text1 ?></div>
						<?php } ?>
					</div>
				</div>
			</section>


		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
