<?php
/**
 * Template part for displaying page content in vendor-single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vancouver_Live
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; 
        ?>


    <div class="entry-content">
        <?php 
        the_post_thumbnail();  
        if(function_exists('get_field')) {

            if(get_field('vendor_tier')){
            
                $tier = get_field('vendor_tier');
           
                if($tier === 'Tier 1'){

                    $vendorDesc = get_field('vendor_description');

                    if($vendorDesc){
                        echo '<p>'. $vendorDesc . '</p>'; 
                    }
                }
            }
        }
        ?>
    </div>
</article>