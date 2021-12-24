<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CoverNews
 */

get_header(); ?>
        <div class="row">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">

                        <?php
                        while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('af-single-article'); ?>>
                                <div class="entry-content-wrap">
                                    <?php covernews_get_block('header'); ?>
                                    <?php

                                    get_template_part('template-parts/content', get_post_type());


                                    ?>
                                </div>
                                <?php
                                $show_related_posts = esc_attr(covernews_get_option('single_show_related_posts'));
                                if ($show_related_posts):
                                    if ('post' === get_post_type()) :
                                        covernews_get_block('related');
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
            </div>
<?php
get_footer();
