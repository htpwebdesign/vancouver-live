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
	<section class="buttons-sec">
		<a href="<?php the_permalink(16) ?>" class="ticket-button">Tickets</a>
		<a href="<?php the_permalink(34) ?>" class="schedule-button">Schedule</a>
	</section>
	<section class="banner-content-text">
		<p class="sub-header-s">The Land of pioneering events. <br>Where service and expertise is at the heart of it all.</p>
	</section>
    <?php
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.

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
					<a href="<?php echo esc_url($first_link); ?>"><span class="screen-reader-text">Check out our performers!</span>Read More</a>
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
					<a href="<?php echo esc_url($first_link); ?>" ><span class="screen-reader-text">Check out our food vendors!</span>Read More</a>
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

	
    ?>

</main><!-- #main -->

<?php
get_footer();
