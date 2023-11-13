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
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'vanlive-performer',
        'meta_key'       => 'timeslot',
        'orderby'        => array(
            'meta_value' => 'DESC',
            'day'        => 'ASC',
        ),
        'tax_query'      => array(
            array(
                'taxonomy' => 'day',
                'field'    => 'slug',
                'terms'    => array('day-1', 'day-2'),
            ),
        ),
    );

    $query = new WP_Query($args);
    ?>

    <?php if ($query->have_posts()) : ?>
        <?php
        // Initialize day as emptry string to track the current day
        $current_day = '';
        ?>

        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $day_terms = wp_get_post_terms(get_the_ID(), 'day', array('fields' => 'names'));
			//if array is not empty, assign day to current query else assign empty string
            $current_post_day = !empty($day_terms) ? $day_terms[0] : '';

            //check if current performer is performing on the queried day
            if ($current_post_day !== $current_day) {

                // Close the previous list if not the first iteration
                if ($current_day !== '') {
                    echo '</ul>';
                }
              
				//if day is empty start output new title
                echo '<h2>' . esc_html($current_post_day) . '</h2>';
                // Start a new list
                echo '<ul>';
                // Update the current day
                $current_day = $current_post_day;
            }
            ?>
            <li id="<?php the_ID();?>">
                <?php the_title(); ?>
                <?php $selected_option = get_field('timeslot'); ?>
                <?php echo esc_html($selected_option); ?>
                <?php echo esc_html(implode(', ', $day_terms)); ?>
            </li>
        <?php endwhile; ?>
        <?php
        echo '</ul>';
        ?>
    <?php endif; ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
