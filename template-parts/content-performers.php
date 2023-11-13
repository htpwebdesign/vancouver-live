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
    <header>
        <?php the_title('<h2 class="entry-title">', '<h2>'); ?>
    </header>

    <div class="entry-content">
        <?php 
        
        the_content();
        

        ?>
    </div>
</article>