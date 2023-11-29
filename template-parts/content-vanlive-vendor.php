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
    <div class="article-content">
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
                        echo '<p>' . $vendorDesc . '</p>';
                    }
                }
            }
        }
         endif;
        ?>
        </div>
         <?php
        if(is_single()):
                echo '<div class="vendor-desc">';
                if(function_exists('get_field')) {

                    if(get_field('vendor_tier')){
                    
                        $tier = get_field('vendor_tier');
                   
                        if($tier === 'Tier 1' || $tier === 'Tier 2'){
        
                            $vendorDesc = get_field('vendor_description');
        
                            if($vendorDesc){
                                echo '<p>'. $vendorDesc . '</p>'; 
                            }
                        }
                    
                        $to_sched = get_field('link_to_schedule', 34);
                              
                        if($to_sched){
                            echo '<p class="to-sched">Find out when the vendor area is open.<br> <a class ="to-sched-link" href="' . esc_url($to_sched['url']) . '">' . esc_html($to_sched['title']) . '&#8594;</a></p>';
                            echo '<p class="or">or</p>';
                            }
                        }
                        
                    }
                    echo '</div>';
            endif;
            ?>
    </div>
    <div 
        class="entry-content">
            <?php 
            the_post_thumbnail();  
            ?>
        </div>
</article>

<?php
if(is_singular()){
    if(function_exists('get_field')){
        $to_archive = get_field('v_single_to_archive', 38);
                                      
        if($to_archive){
             echo '<a class ="to-archive" href="' . esc_url($to_archive['url']) . '">' . esc_html($to_archive['title']) . '</a>';
                   
        } 
    }
}
?>