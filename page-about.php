<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vancouver_Live
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="about-page-wrapper">
		<?php

		$about_section = get_field('about_hero_section');

		if ($about_section) {
	
			foreach ($about_section as $section) {
				$title = $section['hero_section_title'];
				$media = $section['hero_section_image'];
				$text = $section['hero_section_text'];
				
				?>
				<section class="about-section-hero">
					<h2><?php echo $title; ?></h2>
					<div class="about-image-banner">
					<img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt']); ?>">
					</div>
					<p><?php echo $text; ?></p>
				</section>
				<?php
			}
		}

		$History_section = get_field('history_and_mission');

		if ($History_section) {
	
			foreach ($History_section as $section) {

				$title = $section['about_history_title'];
				$media = $section['about_history_image'];
				$text = $section['about_history_text'];
				
				?>
				<section class="History-section">
					<h2><?php echo $title; ?></h2>
					<img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt']); ?>">
					<p><?php echo $text; ?></p>
				</section>
				<?php
			}
		}

		$public_transit = get_field('public_transit');

		if ($public_transit) {
			foreach ($public_transit as $section) {
				$title = $section['public_transit_title'];
				$text = $section['public_transit_text'];
		
				?>
				<section class="public_transit">
					<h2><?php echo $title; ?></h2>
					<p><?php echo $text; ?></p>
		
					<?php
					$map_id = 1;
		
					$shortcode = '[wpgmza id="' . esc_attr($map_id) . '"]';
		
					echo do_shortcode($shortcode);
					?>
				</section>
				<?php
			}
		}

		echo'</div>';

		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

		?>
	</main><!-- #main -->

<?php
get_footer();
