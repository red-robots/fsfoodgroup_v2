<?php
/**
 * Template Name: Careers
*/

get_header(); 

function howmany( $num ) {
	if( $num == 3 ) { $tClass = 'three'; }
	if( $num == 4 ) { $tClass = 'four'; }
	if( $num == 5 ) { $tClass = 'five'; }
	if( $num == 6 ) { $tClass = 'six'; }
	if( $num == 7 ) { $tClass = 'seven'; }
	if( $num == 8 ) { $tClass = 'eight'; }
	if( $num == 9 ) { $tClass = 'nine'; }
	return $tClass;
}

?>

	<div id="primary" class="content-area cf default careers">
		<main id="main" class="site-main cf" role="main">

			<?php while ( have_posts() ) : the_post(); 
					$main_content = get_the_content();
					$main_content = ($main_content) ? email_obfuscator($main_content) : '';
					$mainStrings = '';
					ob_start();
					echo $main_content;
					$mainStrings = ob_get_contents();
					ob_end_clean();
					$hasH1Tag = false;
					if(strpos($mainStrings, '<h1>') !== false){
					    $hasH1Tag = true;
					} else{
					    $hasH1Tag = false;
					}
				?>
				
				<?php 
				$footer_logos = get_field("footer_logos","option"); 
				 if ($footer_logos) { ?>
					<section class="places">
						<div class="flex">
							<?php foreach ($footer_logos as $f) { 
								$fsLogo = $f['logo']; 
								$fsLink = $f['link']; 
								$openLink  = '';
								$closeLink = '';
								if($fsLink) {
									$openLink  = '<a href="'.$fsLink.'" target="_blank">';
									$closeLink = '</a>';
								}
								?>
								<?php if ($fsLogo) { ?>
									<div class="place-l">
										<?php echo $openLink; ?>
											<img src="<?php echo $fsLogo['url'] ?>" alt="<?php echo $fsLogo['title'] ?>">
										<?php echo $closeLink; ?>
									</div>
								<?php } ?>
								
							<?php } ?>
							</div>
						</section>
					<?php } ?>


				<section class="maintext">
					<div class="wrapper text-center">
						<?php //if ($hasH1Tag==false) { ?>
						<h1 class="entry-title careers"><?php the_title(); ?></h1>
						<?php //} ?>
						<div class="entry-content careers"><?php echo $main_content; ?></div>
					</div>
				</section>

				<?php 
				$galOne = get_field('row_1_gallery'); 
				$num = count( $galOne );
				$tClass = howmany( $num );
				// echo $num;
				?>
					<section class="car-gallery">
						<?php foreach( $galOne as $gI ) { 
								// echo '<pre>';
								// print_r($gI);
								// echo '</pre>';
							?>
							<div class="galwrap <?php echo $tClass; ?>">
								<img src="<?php echo $gI['sizes']['medium']; ?>">
							</div>
							
						<?php } ?>
					</section>

				<?php if( have_rows( 'benefits' ) ) : ?>
					<section class="benefits">
						<h2>Employment Benefits</h2>
						<div class="flex gridz">
							<?php while( have_rows( 'benefits' ) ) : the_row(); 
									$bt = get_sub_field('benefit_header');
									$bb = get_sub_field('benefit');
								?>
							<div class="benefit grid-itemz">
								<?php if( $bt ) { echo '<h3>'.$bt.'</h3>';} ?>
								<?php if( $bb ){ echo $bb; } ?>
							</div>
						<?php endwhile; ?>
					</div>
					</section>
				<?php endif; ?>


				<?php 
				$galOne = get_field('row_2_gallery'); 
				$num = count( $galOne );
				$tClass = howmany( $num );
				// echo $num;
				?>
					<section class="car-gallery">
						<?php foreach( $galOne as $gI ) { 
								// echo '<pre>';
								// print_r($gI);
								// echo '</pre>';
							?>
							<div class="galwrap <?php echo $tClass; ?>">
								<img src="<?php echo $gI['sizes']['medium']; ?>">
							</div>
							
						<?php } ?>
					</section>


				<?php $careers_embed = get_field("careers_embed"); ?>
				<?php if ($careers_embed) { ?>
				<section class="section-careers-embed cf">
					<div class="wrapper">
						<?php echo $careers_embed; ?>
					</div>
				</section>
				<?php } ?>

			<?php endwhile; ?>




			<?php  
			$post_type = 'restaurants';
			$args = array(
				'posts_per_page' => -1,
			    'post_type' => $post_type,
			    'post_status' => 'publish',
			);
			$fsgroup = new WP_Query($args);
			$items = get_posts($args);
			$numItems = array();
			if($items) {
				$i=1; foreach($items as $e) {
					$pageLink = get_field("careerslink",$e->ID);
					if($pageLink) {
						$numItems[] = $e->ID;
					}
					$i++;
				}
			}
			$countItems = ($numItems) ? count($numItems) : 0;
			$colClass = 'columns4';
			if($countItems==2) {
				$colClass = 'columns2';
			}
			else if($countItems==4) {
				$colClass = 'columns4';
			}
			else if($countItems==5) {
				$colClass = 'columns5';
			}
			else if($countItems<=3) {
				$colClass = 'columns3';
			}
			else if($countItems>=6) {
				$colClass = 'columns6';
			}

			$fsgroup = FALSE; /* To HIDE temporarily */
			if( $fsgroup ) { ?>
			<section id="concepts" class="section fsgroup cf <?php echo $colClass ?>">
				<div class="wrapper cf">
					<div class="flexwrap cf">
						<?php while ( $fsgroup->have_posts() ) : $fsgroup->the_post(); 
						$fsLogo = get_field("logo");
						$featImg = get_field("featured_image");
						$bgStyle = ($featImg) ? ' style="background-image:url('.$featImg['url'].')"':'';
						$fsLink = get_field("link");
						$pageLink = get_field("careerslink");
						$openLink = '';
						$closeLink = '';
						if($pageLink) {
							$openLink = '<a href="'.$pageLink.'" target="_blank">';
							$closeLink = '</a>';
						}
						$placeholder = get_bloginfo("template_url") . "/images/rectangle.png";
						if($pageLink) { ?>
						<div class="fsgroup-item cf">
							<div class="fsimage">
								<?php echo $openLink; ?>
								<span class="wrap"<?php echo $bgStyle ?>>
								<?php if ($fsLogo) { ?>
									<img class="fslogo" src="<?php echo $fsLogo['url'] ?>" alt="<?php echo $fsLogo['title'] ?>">
								<?php } ?>
								<?php if ($featImg) { ?>
									<img class="placeholder" src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
								<?php } ?>
								</span>
								<?php echo $closeLink; ?>
							</div>
						</div>
						<?php } ?>
						<?php endwhile; wp_reset_postdata(); ?>	
					</div>
				</div>
			</section>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
