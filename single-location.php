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
			if( $num == 1 ) {
				$spaces = 'space';
			} else {
				$spaces = 'spaces';
			}

			if( $description == '' ) {
				$bClass = 'empty';
			} else {
				$bClass = 'full';
			}
			// echo '<pre>';
			// print_r($map);
			
			?>
			<article class="article locations">
				<div class="location-logo">
					<img src="<?php echo $logo['url']; ?>">
				</div>
				<div class="wrapper">
					<h1 class="entry-title text-center"><?php the_title(); ?></h1>
					<div class="address <?php echo $bClass; ?>">
						<?php echo $map['street_number'].' '.$map['street_name'].'</br>'.$map['city'].', '.$map['state_short'].' '.$map['post_code']; ?>
					</div>

					<?php if( $description ) { ?>
						<section class="location-intro">
							<div class="wrap">
								<?php echo $description; ?>
							</div>
						</section>
					<?php } ?>

					<?php if( $button ) { ?>
						<div class="buttondiv cf">
							<a class="btn-default" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>
						</div>
					<?php } ?>
					<!-- <div class="entry-content"><?php the_content(); ?></div> -->
				</div>
			</article>
			<?php endwhile; ?>

			

			<?php if( $space ) { ?>
				<section class="spaces">
					<div class="spaces-info">
						
						<div class="num-spaces">
							<h2>Spaces</h2>
							<?php echo $num ?> <?php echo $spaces; ?> available for <?php the_title(); ?>
						</div>
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
					<div class="addy">
						<h2><?php the_title(); ?></h2>
						<?php echo $map['street_number'].' '.$map['street_name'].'</br>'.$map['city'].', '.$map['state_short'].' '.$map['post_code']; ?>
							
					</div>
					
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
