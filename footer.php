<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vancouver_Live
 */

?>

	<footer id="colophon" class="site-footer">
	<?php
	if(function_exists ('get_field')) {
		if ( ! is_post_type_archive('vanlive-vendor') ) {?>
			<section class="site-vendor-showcase">
				<section>
					<h3><?php the_field('vendor_showcase_heading', 'option'); ?></h2>
					<?php
					$args = array(
							'post_type'      => 'vanlive-vendor',
							'posts_per_page' => -1,
							'meta_query'		=> array(
								array(
									'key'	=> 'vendor_tier',
									'value'	=> 'tier 1',
								),
							),
						);
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'logo' ); ?>
								</a>
							<?php 
						}
						wp_reset_postdata();
					}
					?>
				</section>
				<section>
					<h3><?php the_field('vendor_cta_heading', 'option'); ?></h3>
					<p><?php the_field('vendor_cta_text', 'option'); ?></p>
					<a href="<?php echo get_site_url(); ?>/vendors#gform_wrapper_2"><?php the_field('vendor_cta_link_text', 'option'); ?></a>
				</section>
			
			</section><!-- .site-vendor-showcase -->
			<?php 
		}
		else {
			?>
			<section class="site-vendor-showcase">
				<h3><?php the_field('vendor_showcase_heading', 'option'); ?></h3>
				<?php gravity_form( 2, false, false, false, false, true ); ?>
			</section><!-- .site-vendor-showcase -->
			<?php 
		}
		?>
			 
		
		
			<section class="site-social-media">
				<section>
					<h3><?php the_field('subscribe_heading', 'option'); ?></h3>
					<?php gravity_form( 1, false, false, false, false, true ); ?>
				</section>
				<section>
					<p><?php the_field('social_media_heading', 'option'); ?></p>
					<nav>
						<a href="<?php the_field('facebook', 'option'); ?> "><?php get_template_part( 'icons/facebook' ); ?></a>
						<a href="<?php the_field('twitter', 'option'); ?> "><?php get_template_part( 'icons/twitterx' ); ?></a>
						<a href="<?php the_field('instagram', 'option'); ?> "><?php get_template_part( 'icons/instagram' ); ?></a>
					</nav>
				</section>
			</section>
	<?php 
	} 
	?>
		<section class="site-copyright">
			<p><a href="#">Privacy Policy</a> | <a href="#">Terms and Conditions</a> | <a href="#">Contact Us</a></p>
			<p>Built by <a href="#">Taylor Hillier</a>, <a href="#">Zeinab Kordeh</a>, <a href="#">Justin Yu</a>, and <a href="#">Bruce Gerona</a></p>
			<p>&copy;2023 Vancouver Live</p>
		</section>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
