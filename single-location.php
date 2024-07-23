<?php
/**
 * The template for displaying the Locations post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); ?>

	<div id="primary" class="content-area cf default singlepage">
		<main id="main" class="site-main cf" role="main">

		<?php while ( have_posts() ) : the_post(); 
			$description = get_field("description");
			$logo = get_field("logo");
			$button = get_field('button');
			$space = get_field('space');
			$map = get_field('map');
			$links = get_field('links');
			$num = count( $space );
			// echo '<pre>';
			// print_r($button);
			
			?>
			<article class="article locations">
				<div class="location-logo">
					<img src="<?php echo $logo['url']; ?>">
				</div>
				<div class="wrapper">
					<h1 class="entry-title text-center"><?php the_title(); ?></h1>
					<div class="address">
						<?php echo $map['address']; ?>
					</div>
					<?php if( $button ) { ?>
						<div class="btn">
							<a href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>
						</div>
					<?php } ?>
					<!-- <div class="entry-content"><?php the_content(); ?></div> -->
				</div>
			</article>
			<?php endwhile; ?>

			<section class="location-intro">
				<div class="wrap">
					<?php echo $description; ?>
					<?php if( $button ) { ?>
						<div class="btn">
							<a href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>
						</div>
					<?php } ?>
				</div>
			</section>

			<?php if( $space ) { ?>
				<section class="spaces">
					<div class="spaces-info">
						<h2>Spaces</h2>
						<?php echo $num ?> spaces available for <?php the_title(); ?>
					</div>
					<div class="flex">
						<?php foreach( $space as $s ) { 
								$image = $s['image'];
								$capacity = $s['capacity'];
								$desc = $s['desc'];
							?>
							<div class="space">
								<div class="image">
									<img src="<?php echo $image['url']; ?>">
								</div>
								<div class="details">
									<div class="capacity">
										<h3>Capacity</h3>
										<?php echo $capacity; ?>
									</div>
									<div class="desc">
										<?php echo $desc; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</section>
			<?php } ?>

			<section class="map">
				<div class="links">
					<div class="addy"><?php echo $map['address']; ?></div>
					
					<?php foreach( $links as $link ) { ?>
						<div class="btn">
							<a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a>
						</div>
					<?php } ?>
				</div>
				<?php 
				if( $map ): ?>
				    <div class="acf-map" data-zoom="16">
				        <div class="marker" data-lat="<?php echo esc_attr($map['lat']); ?>" data-lng="<?php echo esc_attr($map['lng']); ?>"></div>
				    </div>
				<?php endif; ?>
			</section>		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
