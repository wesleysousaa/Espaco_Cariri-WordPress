<?php
if (!function_exists('newsphere_single_header')) :
    /**
     * Banner Slider
     *
     * @since Newsphere 1.0.0
     *
     */
    function newsphere_single_header()
    {

        $show_featured_image = newsphere_get_option('single_show_featured_image');
        $wrapper_class = '';
        if ($show_featured_image == false) {
            $wrapper_class = 'aft-no-featured-image';

        }
        global $post;
        $post_id = $post->ID;
        ?>
        <header class="entry-header pos-rel <?php echo esc_attr($wrapper_class); ?>">
            <div class="read-details marg-btm-lr">
                <div class="entry-header-details">
                    <?php if ('post' === get_post_type()) : ?>
                        <div class="figure-categories figure-categories-bg">
                            <?php newsphere_post_categories(); ?>
                        </div>
                    <?php endif; ?>


                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <?php if ('post' === get_post_type($post_id)) :


                        ?>
                        <span class="min-read-post-format">
                            <?php echo newsphere_post_format($post_id); ?>
                            <?php newsphere_count_content_words($post->ID); ?>
                        </span>
                        <div class="entry-meta">
                            <?php newsphere_post_item_meta(); ?>
                        </div>


                        <?php if (has_excerpt($post_id)):  ?>
                        <div class="post-excerpt">
                            <?php echo esc_html(get_the_excerpt($post_id)); ?>
                        </div>

                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php


            if ($show_featured_image):
                ?>
                <div class="read-img pos-rel">
                    <?php newsphere_post_thumbnail(); ?>
                    <span class="min-read-post-format">

                        <?php
                        if (has_post_thumbnail($post_id)):
                            if ($aft_image_caption = get_post(get_post_thumbnail_id())->post_excerpt): ?>
                                <span class="aft-image-caption">
                                    <p>
                                        <?php echo $aft_image_caption; ?>
                                    </p>
                                </span>
                            <?php
                            endif;
                        endif;
                        ?>
                    </span>

                </div>
            <?php endif; ?>
        </header><!-- .entry-header -->

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('newsphere_action_single_header', 'newsphere_single_header', 40);