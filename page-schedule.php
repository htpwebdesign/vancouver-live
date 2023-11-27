<?php
get_header();
?>

<main id="primary" class="site-main">

<?php

$terms = get_terms('vli-day', array('hide_empty' => false));

foreach ($terms as $term) {
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'vanlive-performer',
        'tax_query'      => array(
            array(
                'taxonomy' => 'vli-day',
                'field'    => 'slug',
                'terms'    => $term->slug,
            ),
        ),
        'meta_key'       => 'timeslot',
        'orderby'        => 'meta_value',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);
    ?>
   <?php 
        echo '<section id="' . str_replace(' ', '-', esc_html($term->name)) . '">';
        echo '<h2>' . esc_html($term->name) . '</h2>';

        // Check if there are posts for the current term
        if ($query->have_posts()) {
            // Start a new container
            echo '<div class="schedule-container">';

            // Loop through the posts for the current term
            while ($query->have_posts()) : $query->the_post();
                // Get performer details
                $timeslot = get_field('timeslot');
                $festival_length = 540;

                // Extract start and end times from the timeslot
                list($start_time, $end_time) = explode('-', $timeslot);

                // Create DateTime objects for start and end times
                $start_datetime = strtotime($start_time);
                $end_datetime = strtotime($end_time);

                // echo $start->format('H:i');
                $interval = $end_datetime - $start_datetime;
                $min_interval = $interval/60;

                $percentageHeight = (($min_interval) / $festival_length) * 100;
                $percentageHeight = $percentageHeight;
                $post_id = get_the_ID();
                ?>
                <div class="scheduled-performer" style="height: <?php echo $percentageHeight; ?>vh; <?php echo $leftPosition; ?>;">
                    <div class="performer-background">
                        <?php echo get_the_post_thumbnail($post_id) ?>
                    </div>  
                    <div class="performer-content">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
                        <span><?php echo esc_html($timeslot); ?></span>
                    </div>
                </div>
                <?php
            endwhile;

            // Close the container
            echo '</div>';
            echo '</section>';
        }

        // Reset the query
        wp_reset_postdata();
    }
    ?>

</main><!-- #main -->

<?php
get_footer();
?>
