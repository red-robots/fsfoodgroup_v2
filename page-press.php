<?php
/**
 * Template Name: Press
 */

get_header(); ?>

	<div id="primary" class="content-area default cf presspage">
		<main id="main" class="site-main cf" role="main">
	
			<?php while ( have_posts() ) : the_post(); ?>
			<section class="maintext">
				<div class="wrapper text-center">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
				</div>
			</section>
			<?php endwhile; ?>


			<?php  
			/* PRESS ARTICLES */
			$perpage = 12;
			$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
			$args = array(
				'posts_per_page'=> $perpage,
				'paged'			=> $paged,
			    'post_type' 	=> 'post',
			    'post_status' 	=> 'publish',
			    'orderby' 		=> 'date',
				'order'			=> 'DESC',
			);
			$press = new WP_Query($args);
			$placeholder = get_bloginfo("template_url") . "/images/portrait.png";
			if ( $press->have_posts() ) {  ?>
			<section class="section press-articles">
				<div id="articles" class="wrapper">
					<div class="flexwrap">
					<?php while ( $press->have_posts() ) : $press->the_post(); 
						$type = get_field("feature_type");
						$thumbnail = '';
						$embed = '';
						$is_video = ($type=='video') ? true : false;
						if($type=='image') {
							$img = get_field("image");
							$thumbnail = ($img) ? $img['sizes']['medium_large'] : '';
						} 
						else if($type=='video') {
							$vid = get_field("video");
							$thumbnail = ( isset($vid['thumbnail']) && $vid['thumbnail'] ) ? $vid['thumbnail']['sizes']['medium_large']:'';
							$embed = ( isset($vid['embed']) && $vid['embed'] ) ? $vid['embed']:'';
						}
						$imageStyle = ($thumbnail) ? ' style="background-image:url('.$thumbnail.')"':'';
						$hasImage = ($thumbnail) ? 'hasphoto':'nophoto';
						$pagelink = get_permalink();
						$title = get_the_title();
						?>
						<div class="news-item">
							<a href="<?php echo $pagelink ?>" class="news-link cf feat-<?php echo $type ?> <?php echo $hasImage ?>">
								<?php if ($is_video && $embed) { ?>
								<span class="play-video"><span></span></span>	
								<?php } ?>
								<span class="photo"<?php echo $imageStyle ?>>
									<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
								</span>
								<span class="title"><?php echo $title; ?></span>
							</a>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
					</div>

					<?php
		            $total_pages = $press->max_num_pages;
		            if ($total_pages > 1){ ?>
	                <div id="pagination" class="pagination cf">
	                    <?php
                        $pagination = array(
                            'base' => @add_query_arg('pg','%#%'),
                            'format' => '?paged=%#%',
                            'current' => $paged,
                            'total' => $total_pages,
                            'prev_text' => __( '&laquo;', 'red_partners' ),
                            'next_text' => __( '&raquo;', 'red_partners' ),
                            'type' => 'plain'
                        );
                        echo paginate_links($pagination);
	                    ?>
	                </div>
	                <?php } ?>
				</div>
			</section>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
