
<?php
/**
 * Template Name: Home Page 
 * by YiBing (Jessca) Zhao 999826210
 * @package berrybeuty
 */
?>

<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div id="gallery">
                <img src="wp-content/themes/berryMakeup/img/7.jpg" alt="" id="main-img" />
                <ul>
                  <li><img src="wp-content/themes/berryMakeup/img/1.jpg" alt="" width="80" /></li>
                  <li><img src="wp-content/themes/berryMakeup/img/2.jpg" alt="" width="80" /></li>
                  <li><img src="wp-content/themes/berryMakeup/img/3.jpg" alt="" width="80" /></li>
                  <li><img src="wp-content/themes/berryMakeup/img/4.jpg" alt="" width="80" /></li>
                  <li><img src="wp-content/themes/berryMakeup/img/5.jpg" alt="" width="80" /></li>
                  <li><img src="wp-content/themes/berryMakeup/img/6.jpg" alt="" width="80" height="80" /></li>
                </ul>
        </div>
            
        
        <div class="gridcontainer">
            <?php
            // Setting up the grid layout
            // Start counter
            $counter = 1; 
            // Grids per row
            $row = 4; 
            $titlelength = 25;
            /** Custom query for category ID 39, 
            * will show 10 posts, no sticky posts */
            $args = array(
                'ignore_sticky_posts' => 1,
                'showposts' => 6, 
                'cat' => 192);
            $my_query = new WP_Query($args);
            
            //The expanded Loop 
            if ( $my_query->have_posts() ) :   
            
                while ($my_query->have_posts()):
                        $my_query->the_post(); 

                /**Show half of the post, 
                /* start a grid loop, 
                 * will run loop if counter is not equal to row */
                if ($counter !=$row): ?>
    
                <div class ="gridleft">
                    <div class="postimage"> 
                        <!--Display featured image--> 
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
                            <?php //checks to see if there is a featured image
                                if ( has_post_thumbnail() ) {the_post_thumbnail();}
                                else { //if there is no image, it will use this default image (reference Wordpress Codex)
                                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/noimg.jpg" />';}?> 
                        </a> 
                    </div> 
                </div>
                        <h2 class ="postimage-title"> 
                            <!--Post Title under image -->
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                              <?php //checks to see if the title is longer than 20 characters, if is add ...
                                if (mb_strlen($post->post_title) > $titlelength)
                                { echo mb_substr(the_title($before = '', $after = '', FALSE), 0, $titlelength) . ' ...'; }
                                else { the_title(); } ?>
                            </a>
                        </h2> 

                <?php 
                //will run loop if counter is equal to row
                 elseif($counter ==$row) :  ?>
                
                <div class ="gridright">
                    <div class="postimage">
                        <!--Featured image--> 
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
                            <?php //checks to see if there is a featured image
                                if ( has_post_thumbnail() ) {the_post_thumbnail();}
                                else { //if there is no image, it will use this default image (reference Wordpress Codex)
                                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/noimg.jpg" />';}?> 
                        </a> 
                    </div>    
                        <h2 class ="postimage-title"> 
                        <!--Post Tile under image -->
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php //checks to see if the title is longer than 20 characters, if is add ...
                                    if (mb_strlen($post->post_title) > $titlelength)
                                    { echo mb_substr(the_title($before = '', $after = '', FALSE), 0, $titlelength) .".." ; }
                                    else { the_title(); } ?> 
                            </a>
                        </h2> 
                </div> 
                
            <?php
            //when counter = row clear counter to zero and end if
            $counter = 0;
             endif; ?> 
            
            <?php
            // counter increase by 1 every loop
            $counter++;
            endwhile;
            //clear all data
            wp_reset_postdata(); 
            //if ther is no post found in the category, print following text
            else: 
                echo "<h2> Uh-Oh, No Post Found in this Category. </h2> ";
            endif; ?> 
        </div>
    </main>
</div>
</div><!-- #page -->
<?php get_footer(); ?>