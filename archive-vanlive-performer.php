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

						
				$hero_image_url = get_post_thumbnail_id('36');
			
				if($hero_image_url){
					$image_url = wp_get_attachment_image_url($hero_image_url);
					echo '<img class="hero" src="' . esc_url($image_url) . '"/>';
				}

				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );

				if(function_exists('get_field')){
					$cta = get_field('performer_cta', 36);
				
					if($cta){
						echo '<a href="' . esc_url($cta['url']) . '">' . esc_html($cta['title']) . '</a>';
					}
				}
				?>
			</header><!-- .page-header -->

			<?php

			$performer_acfstatus = 'performer_status';

			$performer_tiers = array('headliner', 'secondary', 'tertiary');

			foreach($performer_tiers as $tier){
				$args = array(
					'post_type'			=> 'vanlive-performer',
					'posts_per_page'	=> -1,
					'meta_query'		=> array(
						array(
							'key'	=> $performer_acfstatus,
							'value'	=> $tier,
						),
					),
				);

				$query = new WP_Query($args);
				echo '<section class="' . esc_html($tier) . '">';
				if (function_exists('get_field')) {
					$rows = get_field('performer_tier_names', 36);
					echo '<div class="section-header">';
					if ($rows) {
						while (have_rows('performer_tier_names', 36)) : the_row();
							if($tier === 'headliner'){
								echo '<h2>' . get_sub_field('tier_1') . '</h2>';
							}
							if($tier === 'secondary'){
								echo '<h2>' . get_sub_field('tier_2') . '</h2>';
							}
							if($tier === 'tertiary'){
								echo '<h2>' . get_sub_field('tier_3') . '</h2>';
							}
							
						endwhile;
					}
					echo '</div>';
					echo '<div class="section-desc">';
					$rows2 = get_field('performer_tier_desc', 36);
				
					if ($rows2) {
						while (have_rows('performer_tier_desc', 36)) : the_row();
							if($tier === 'headliner'){
								echo '<p>' . get_sub_field('tier_1') . '</p>';
							}
							if($tier === 'secondary'){
								echo '<p>' . get_sub_field('tier_2') . '</p>';
							}
							if($tier === 'tertiary'){
								echo '<p>' . get_sub_field('tier_3') . '</p>';
							}
						endwhile;
					}
					echo '</div>';
				}
					/* Start the Loop */
					echo '<div class="performer-articles">';
					if($query -> have_posts()) {

						while ($query -> have_posts()) : $query->the_post();
							get_template_part('template-parts/content', get_post_type());
						endwhile;
					}
					echo '</div>';
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
