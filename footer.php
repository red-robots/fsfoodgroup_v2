	</div><!-- #content -->

	<?php
	$main_logo = get_field("main_logo","option");
	$footer_logos = get_field("footer_logos","option");
	$phone = get_field("phone","option");
	$email = get_field("email","option");
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="flexcols">
				<div class="col col1 ft-main-logo">
					<?php if ($main_logo) { ?>
						<img src="<?php echo $main_logo['url'] ?>" alt="<?php echo $main_logo['title'] ?>">
					<?php } ?>
				</div>
				<div class="col col2 fsgrouplogos">
					<div class="flexwrap">
					<?php if ($footer_logos) { ?>
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
								<span class="fsgrplogo"><?php echo $openLink; ?><img src="<?php echo $fsLogo['url'] ?>" alt="<?php echo $fsLogo['title'] ?>"><?php echo $closeLink; ?></span>
							<?php } ?>
							
						<?php } ?>
					<?php } ?>
					</div>
				</div>
				<div class="col col3">
					<?php if ($phone) { ?>
					<div class="ft-contact phone"><a href="tel:<?php echo format_phone_number($phone); ?>"><?php echo $phone ?></a></div>	
					<?php } ?>
					<?php if ($email) { ?>
					<div class="ft-contact email"><a href="mailto:<?php echo antispambot($email,1); ?>"><?php echo antispambot($email); ?></a></div>	
					<?php } ?>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
