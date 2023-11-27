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
					$cta = get_field('performer_cta', 38);
				
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
					echo '<h2>' . ucfirst(esc_html($tier)) . '</h2>';
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
