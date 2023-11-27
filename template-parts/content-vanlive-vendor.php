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
        <div class="vendor-text">
        <?php if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; 

        if(is_archive() ):
                
        if(function_exists('get_field')) {

            if(get_field('vendor_tier')){
            
                $tier = get_field('vendor_tier');
           
                if($tier === 'Tier 1'){

                    $vendorDesc = get_field('vendor_description');

                    if ($vendorDesc) {
                        // Truncate to 100 characters and add "..."
                        $vendorDesc = substr($vendorDesc, 0, 50) . '<a href="' . esc_url(get_permalink()) . '"> ...</a>';
                        echo '<p>' . $vendorDesc . '</p>';
                    }
                }
            }
        }
         endif;
        ?>
        </div>
        <div 
        class="entry-content">
            <?php 
            the_post_thumbnail();  

            if(is_single()):
                if(function_exists('get_field')) {

                    if(get_field('vendor_tier')){
                    
                        $tier = get_field('vendor_tier');
                   
                        if($tier === 'Tier 1' || $tier === 'Tier 2'){
        
                            $vendorDesc = get_field('vendor_description');
        
                            if($vendorDesc){
                                echo '<p>'. $vendorDesc . '</p>'; 
                            }
                        }
                    }
                }
            endif;
            ?>
        </div>

</article>