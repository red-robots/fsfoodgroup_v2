<?php
/**
 * Template Name: Private Dining 2024
 */

get_header(); 

$btn_link = get_field('button_link');

?>

	<div id="primary" class="content-area default cf conceptpage">
		<main id="main" class="site-main cf" role="main">
	
			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>

					<?php if( $btn_link ) { ?>
						<div class="buttondiv cf">
							<a href="<?php echo $btn_link['url']; ?>" class="btn-default" target="<?php echo $btn_link['target']; ?>">
								<?php echo $btn_link['title']; ?>
							</a>
						</div>
					<?php } ?>


				</div>
			</section>
			<?php endwhile; ?>

			<div class="wrapper cf arrow-section text-center">
				<div class="scrolldown no-animate"><a href="#concepts" class="arrowdown"></a></div>
			</div>


			<section class="restaurants">
			<?php 

				

					$ordered_terms = get_terms_ordered_by_menu_order('restaurant');


					// echo '<pre>';
					// print_r($terms);
					// echo '</pre>';

					foreach ($ordered_terms as $term) {
					    // echo $term->slug . ' - Menu Order: ' . get_term_meta($term->term_id, 'menu_order', true);

					    $wp_query = new WP_Query();
						$wp_query->query(array(
							'post_type'=>'location',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'restaurant',
									'field' => 'slug',
									'terms' => $term->slug
								)
							)
						));

						if ($wp_query->have_posts()) :
					
			 ?>

						 
						 	<div class="restaurant">
					 			<div class="flexslider">
					 				<ul class="slides">
									 	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
									 			$banner = get_field('banner');
									 			$term = get_the_terms( get_the_ID(),'restaurant');
									 			$logo = get_field("logo");
									 		// 	echo '<pre>';
												// print_r($term);
												// echo '</pre>';
									 		?>
						 					<li>
						 						<a href="<?php the_permalink(); ?>">
						 							<div class="info">
						 								<!-- <h2><?php echo $term[0]->name; ?></h2> -->
						 								<div class="r-logo">
						 									<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
						 								</div>
						 								<h3><?php the_title(); ?></h3>
						 								<div class="learn"><span>About Location <i class="fa-duotone fa-solid fa-angles-right"></i></span></div>
						 							</div>
						 							<div class="overlay"></div>
						 							<img src="<?php echo $banner['url']; ?>">
							 					</a>
						 					</li>
						 				<?php endwhile; ?>
					 				</ul>
					 			</div>
					 		</div>
						

						<?php endif; ?>


			 	


			
			<?php } ?>
			</section>

			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
