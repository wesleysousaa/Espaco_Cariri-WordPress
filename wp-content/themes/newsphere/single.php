<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newsphere
 */

get_header();

?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php
                while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content-wrap read-single">
                            <?php

                            $single_post_featured_image_view = newsphere_get_option('single_post_featured_image_view');
                            if($single_post_featured_image_view == 'default'){
                                do_action('newsphere_action_single_header');
                            }


                            ?>
                            <?php
                            get_template_part('template-parts/content', get_post_type());
                            ?>
                        </div>
                        <?php
                        $show_related_posts = esc_attr(newsphere_get_option('single_show_related_posts'));
                        if ($show_related_posts):
                            if ('post' === get_post_type()) :
                                newsphere_get_block('related');
                            endif;
                        endif;
                        ?>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </article>
                <?php

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php ?>
        <?php
        get_sidebar(); ?>
<?php
get_footer();
