<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */
?>

<article id="authorid<?php the_author_ID(); ?>" <?php post_class(); ?>>
    <div class="row"  data-equalizer>
        <div class="small-12 medium-6 columns" data-equalizer-watch>
            <?php 
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                    the_post_thumbnail('large');
                } 
            ?>
        </div>
        <div class="small-12 medium-6 columns" style="padding-bottom: 40px;" data-equalizer-watch>
            <h3><?php the_title(); ?></h3>
            <?php the_content(); ?>
            <dl>
                <dt>Favorite Movies:</dt>
                <dd><?php  the_field('1movie'); ?></dd>
                <dd><?php  the_field('2movie'); ?></dd>
                <dd><?php  the_field('3movie'); ?></dd>
            </dl>
            <a href="#" data-options="align: top" data-dropdown="<?php the_title(); ?>"  class="reviewAnchor icon comments"></span>Reviews</a>
            <ul id="<?php the_title(); ?>" class="f-dropdown" data-dropdown-content>

            <?php 
                $var = 'category=4&author=';
                $var2 = $post->post_author;
                $var3= $var.$var2;
                $myposts = get_posts($var3);                        
                    if($myposts){
                    echo '<ul>';
                    foreach ($myposts as $author_post)  {
                        echo '<li><a href="'. get_permalink() .'">'.$author_post->post_title.'</a></li>';
                    }
                        echo '</ul>';
                    }
            ?>
            </ul>
        </div>
    </div>
</article>
