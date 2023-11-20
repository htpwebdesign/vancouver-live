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
            'order'     => 'DESC',
    );

    $query = new WP_Query($args);
    ?>
    <section id="<?php echo $term->name; ?>">
    <?php
    echo '<h2>' . esc_html($term->name) . '</h2>';

    // Check if there are posts for the current term
    if ($query->have_posts()) {
        // Start a new list
        echo '<ul>';

        // Loop through the posts for the current term
        while ($query->have_posts()) : $query->the_post();
            ?>
            <li id="<?php the_ID(); ?>">
                <?php echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>'; ?>
                <?php
                if(function_exists('get_field')){
                 $selected_option = get_field('timeslot');   
                }
                ?>
                <?php echo esc_html($selected_option); ?>
            </li>
            <?php
        endwhile;

        // Close the list
        echo '</ul>';
        echo '</section>';
    }

    // Reset the query
    wp_reset_postdata();
}
?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
