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

        if(function_exists ('get_field')){
            $about_artist = get_field('about_artist');
            if($about_artist){
                $performer_tier = get_field('performer_status');
                if($performer_tier === 'Headliner' || is_singular()){
                    echo '<div class="artist-desc">';

                    echo '<p>' . $about_artist . '</p>';

                    if(is_singular()){

                        if(function_exists('get_field')){
                            $to_sched = get_field('link_to_schedule', 34);
                              
                            if($to_sched){
                                echo '<p class="to-sched">Find out when your favorite artist is performing.<br> <a class ="to-sched-link" href="' . esc_url($to_sched['url']) . '">' . esc_html($to_sched['title']) . '&#8594;</a></p>';
                                echo '<p class="or">or</p>';
                            }
                        }
                    }
                    echo '</div>';
                }
            }
        }
        ?>
    </div>

    <div class="entry-content">
        <?php   
        the_post_thumbnail();
        ?>
    </div>
    
</article>
<?php
    if(is_singular()){
        if(function_exists('get_field')){
            $to_archive = get_field('p_single_to_archive', 36);
              
            if($to_archive){
              
                echo '<a class ="to-archive" href="' . esc_url($to_archive['url']) . '">' . esc_html($to_archive['title']) . '</a>';
               
            }
        }
    }
?>