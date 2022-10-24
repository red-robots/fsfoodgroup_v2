<?php
/**
 * Template Name: Private Dining
 */

get_header(); ?>

	<div id="primary" class="content-area default cf conceptpage">
		<main id="main" class="site-main cf" role="main">
	
			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
				</div>
			</section>
			<?php endwhile; ?>

			<div class="wrapper cf arrow-section text-center">
				<div class="scrolldown no-animate"><a href="#concepts" class="arrowdown"></a></div>
			</div>


			<?php  
			/* CONCEPTS */
			//
			// $concepts = new WP_Query($args);
			$placeholder = get_bloginfo("template_url") . "/images/portrait.png";
			if ( have_rows('dining') ) {  ?>
			<section class="section section-concepts private-dining cf">
				<div id="concepts" class="wrapper">

					<?php while ( have_rows('dining') ) : the_row(); 
						
						$thumbnail = get_sub_field('thumbnail');
						$hasImage = ($thumbnail) ? 'hasphoto':'nophoto';
						$imageStyle = ($thumbnail) ? ' style="background-image:url('.$thumbnail['url'].')"':'';

						$fsLogo = get_sub_field("logo");
						$featImg = get_sub_field("thumbnail");
						$fsLink = get_sub_field("link");
						$openLink = '';
						$closeLink = '';
						$cont = get_sub_field('details');
						$title = get_sub_field('title');
						$room = get_sub_field('room');
						$capacity = get_sub_field('capacity');
						if($fsLink) {
							$openLink = '<a href="'.$fsLink.'" target="_blank">';
							$closeLink = '</a>';
						}
						?>
						<div class="concept-info <?php echo $hasImage ?>">
							<div class="flexwrap">
								<div class="concept-image"<?php echo $var ?>>
									<div class="imagediv"<?php echo $imageStyle ?>>
									<?php echo $openLink; ?>
										<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true"/>
										<?php if ($fsLogo) { ?>
										<img src="<?php echo $thumbnail['url'] ?>" alt="<?php echo $thumbnail['title'] ?>" class="xfslogo" />
										<?php } ?>
									<?php echo $closeLink; ?>
									</div>
								</div>
								<div class="concept-text">
									<h2 class="title"><?php echo $title; ?></h2>
									<?php if( $room || $capacity ){ ?>
										<div class="details">
											<?php if( $room ){ ?><div class="detail">Room: <?php echo $room; ?></div><?php } ?>
											<?php if( $capacity ){ ?><div class="detail">Capacity: <?php echo $capacity; ?></div><?php } ?>
										</div>
									<?php } ?>
									<div class="text"><?php echo $cont; ?></div>
									<?php if ($fsLink) { ?>
									<div class="sitelink"><a href="<?php echo $fsLink ?>" target="_blank">Visit Site</a></div>	
									<?php } ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>

				</div>
			</section>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
