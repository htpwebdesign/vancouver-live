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
			
			$hero_image_url = get_post_thumbnail_id('38');
		
			if($hero_image_url){
				$image_url = wp_get_attachment_image_url($hero_image_url);
				echo '<img class="hero" src="' . esc_url($image_url) . '"/>';
			}

			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );

			if(function_exists('get_field')){
				$cta = get_field('vendor_cta', 38);
			
				if($cta){
					echo '<a href="' . esc_url($cta['url']) . '">' . esc_html($cta['title']) . '</a>';
				}
			}
			?>
		</header><!-- .page-header -->

		<?php

		$vendor_acfstatus = 'vendor_tier';

		$vendor_tiers = array('tier 1', 'tier 2', 'tier 3', 'tier 4');
		
		foreach ($vendor_tiers as $tier) {
			$args = array(
				'post_type'         => 'vanlive-vendor',
				'posts_per_page'    => -1,
				'meta_query'        => array(
					array(
						'key'   => $vendor_acfstatus,
						'value' => $tier,
					),
				),
			);
		
			$query = new WP_Query($args);
			echo '<section class="' . str_replace(' ', '-', esc_html($tier)) . '">';
			echo '<div class="section-header">';
			if (function_exists('get_field')) {
				$rows = get_field('vendor_tier_names', 38);
			
				if ($rows) {
					while (have_rows('vendor_tier_names', 38)) : the_row();
						if($tier === 'tier 1'){
							echo '<h2>' . get_sub_field('tier_1') . '</h2>';
						}
						if($tier === 'tier 2'){
							echo '<h2>' . get_sub_field('tier_2') . '</h2>';
						}
						if($tier === 'tier 3'){
							echo '<h2>' . get_sub_field('tier_3') . '</h2>';
						}
						if($tier === 'tier 4'){
							echo '<h2>' . get_sub_field('tier_4') . '</h2>';
						}
						
					endwhile;
				}

				$rows2 = get_field('vendor_tier_desc', 38);
			
				if ($rows2) {
					while (have_rows('vendor_tier_desc', 38)) : the_row();
						if($tier === 'tier 1'){
							echo '<p>' . get_sub_field('tier_1') . '</p>';
						}
						if($tier === 'tier 2'){
							echo '<p>' . get_sub_field('tier_2') . '</p>';
						}
						if($tier === 'tier 3'){
							echo '<p>' . get_sub_field('tier_3') . '</p>';
						}
						if($tier === 'tier 4'){
							echo '<p>' . get_sub_field('tier_4') . '</p>';
						}
						
					endwhile;
				}
			}
			echo '</div>';
			if ($query->have_posts()) {
				while ($query->have_posts()) : $query->the_post();
					get_template_part('template-parts/content', get_post_type());
				endwhile;
			}
		
			echo '</section>';
			wp_reset_postdata();
		}
		
			the_posts_navigation();

		else :

		get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</main><!-- #main -->

<?php
get_footer();
