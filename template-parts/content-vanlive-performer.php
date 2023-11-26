<?php
/**
 * Template part for displaying page content in performer-single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vancouver_Live
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="performer-text">
        <?php
        if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>
    </div>

    <div class="entry-content">
        <?php   
        the_post_thumbnail();
        
        if(function_exists ('get_field')){
            $about_artist = get_field('about_artist');
            if($about_artist){
                $performer_tier = get_field('performer_status');
                if($performer_tier === 'Headliner'){
                    echo '<div>';
                    echo '<p>' . esc_html($about_artist) . '</p>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
</article>