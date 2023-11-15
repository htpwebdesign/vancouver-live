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
	if ( ! is_post_type_archive('vanlive-vendor') ) {?>
		<div class="site-info">
			<div>
				<h3>Our Partners</h2>
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
			</div>
			<div>
				<h3>Want to become a vendor? Sign up here!</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

				</p>
				<a href="<?php echo get_site_url(); ?>/vendors">Become a vendor today!</a>
			</div>
		
		</div><!-- .site-info -->
		<?php 
	}
	else {
		gravity_form( 2, false, false, false, false, true ); 
	}
	?>
		<div class="site-social-media">
			<div>
				<h3>Subscribe to our newsletter!</h3>
				<?php gravity_form( 1, false, false, false, false, true ); ?>
			</div>
			<div>
				<p>Check out our social media!</p>
				<div>
					<a href="<?php echo esc_url( "https://www.facebook.com/" ); ?> "><?php get_template_part( 'icons/facebook' ); ?></a>
					<a href="<?php echo esc_url( "https://twitter.com/" ); ?> "><?php get_template_part( 'icons/twitterx' ); ?></a>
					<a href="<?php echo esc_url( "https://www.instagram.com/" ); ?> "><?php get_template_part( 'icons/instagram' ); ?></a>
				</div>
			</div>
		</div>
		<div class="site-copyright">
			<p><a href="#">Privacy Policy</a> | <a href="#">Terms and Conditions</a> | <a href="#">Contact Us</a></p>
			<p>&copy;2023 Vancouver Live</p>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
