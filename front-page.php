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
    <?php
    while (have_posts()) :
		echo "<section class='intro'>";
        the_post();
		?>
		<div class="hero-button-text">
			<div class="buttons-sec">
				<a href="<?php the_permalink(16) ?>" class="ticket-button">Tickets</a>
				<a href="<?php the_permalink(34) ?>" class="schedule-button">Schedule</a>
			</div>
			<div class="banner-content-text">
				<p class="sub-header-s">The Land of pioneering events. <br>Where service and expertise is at the heart of it all.</p>
			</div>
		</div>
		<?php

        get_template_part('template-parts/content', 'page');
		echo "</section>";

    endwhile; // End of the loop.
	if(function_exists('get_field')){
		echo'<div class="events-home">';
		
		$event_sections = get_field('events_section');

		if ($event_sections) {

			foreach ($event_sections as $section) {

				$title = $section['events_section_title'];
				$links = $section['events_section_link'];
				$media = $section['events_section_media'];
				$text = $section['events_section_textarea'];
				
				?>
				<section class="event-section">
					<h2><?php echo $title; ?></h2>
					
						<img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt']); ?>">
						<p><?php echo $text; ?></p>

						<?php

					if (is_array($links) && !empty($links)) {
						$first_link = reset($links);
						?>
						<a href="<?php echo esc_url($first_link); ?>"><span class="screen-reader-text">Check out our performers!</span>See Performers</a>
						<?php
					}
					?>
				</section>
				<?php
			}
		}

		$second_events_sections = get_field('second_events_section');
			foreach ($second_events_sections as $section) {

				$title = $section['second_events_title'];
				$links = $section['second_events_link'];
				$media = $section['second_events_media'];
				$text = $section['second_events_textarea'];
				
				?>
				<section class="second-event-section">
					<h2><?php echo $title; ?></h2>
						
						<img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt']); ?>">
						<p><?php echo $text; ?></p>

						<?php

					if (is_array($links) && !empty($links)) {
						$first_link = reset($links);
						?>
						<a href="<?php echo esc_url($first_link); ?>" ><span class="screen-reader-text">Check out our food vendors!</span>See Vendors</a>
						<?php
					}
					?>
				</section>

				<?php
			}
		echo'</div>';

		echo'<section class="performer-vendor-wrapper">';

			$performer_sections = get_field('performer_section');
			foreach ($performer_sections as $section) {

				$title = $section['performer_section_title'];
				$media = $section['performer_section_image'];
				$text = $section['performer_section_text'];
				$links = $section['performer_section_link'];

				?>
				<section class="home-performer-section">
					
					<img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt']); ?>">
					<article class="article-wrapper">
						<h2><?php echo $title; ?></h2>
						<p><?php echo $text; ?></p>
						
						<?php

						if (is_array($links) && !empty($links)) {
							$first_link = reset($links);
							?>
							<a href="<?php echo esc_url($first_link); ?>">Read More</a>
							<?php
						}
						?>
					</article>

				</section>

				<?php
			}

			$vendor_sections = get_field('vendor_section');
			foreach ($vendor_sections as $section) {

				$title = $section['vendor_section_title'];
				$media = $section['vendor_section_image'];
				$text = $section['vendor_section_text'];
				$links = $section['vendor_section_link'];

				?>
				<section class="home-vendor-section">
					
					<img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['alt']); ?>">
					
					<article class="article-wrapper">
						<h2><?php echo $title; ?></h2>
						<p><?php echo $text; ?></p>

						<?php

					if (is_array($links) && !empty($links)) {
						$first_link = reset($links);
						?>
						<a href="<?php echo esc_url($first_link); ?>">Read More</a>
						<?php
					}
					?>
					</article>
				</section>

				<?php
			}
		echo'</section>';

	}
    ?>

</main><!-- #main -->

<?php
get_footer();
