<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vancouver_Live
 */

get_header();
?>

	<main id="primary" class="site-main">

		
		<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php

		$vendor_acfstatus = 'vendor_tier';

		$vendor_tiers = array('tier 1', 'tier 2', 'tier 3', 'tier 4');

		foreach($vendor_tiers as $tier){
			$args = array(
				'post_type'			=> 'vanlive-vendor',
				'posts_per_page'	=> -1,
				'meta_query'		=> array(
					array(
						'key'	=> $vendor_acfstatus,
						'value'	=> $tier,
					),
				),
			);

			$query = new WP_Query($args);
			echo '<div class="' . esc_html($tier) . '">';
				echo '<h2>' . esc_html($tier) . '</h2>';
				echo '<ul>';
				/* Start the Loop */
				if($query -> have_posts()) {

					while ($query -> have_posts()) : $query->the_post();
						get_template_part('template-parts/content', get_post_type());
					endwhile;
				}
				echo '</ul>';
			echo '</div>';
			wp_reset_postdata();
		}
			the_posts_navigation();

		else :

		get_template_part( 'template-parts/content', 'none' );

		endif;
		gravity_form( 2, false, false, false, false, true ); 
		?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
