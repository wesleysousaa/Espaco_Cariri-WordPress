<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CoverNews
 */

if (!function_exists('covernews_post_categories')) :
    function covernews_post_categories($separator = '&nbsp')
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            global $post;


            $post_categories = get_the_category($post->ID);
            if ($post_categories) {
                $output = '<ul class="cat-links">';
                foreach ($post_categories as $post_category) {
                    $t_id = $post_category->term_id;
                    $color_id = "category_color_" . $t_id;

                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
                    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';

                    $output .= '<li class="meta-category">
                             <a class="covernews-categories ' . esc_attr($color_class) . '" href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'covernews'), $post_category->name)) . '"> 
                                 ' . esc_html($post_category->name) . '
                             </a>
                        </li>';
                }
                $output .= '</ul>';
                echo $output;

            }
        }
    }
endif;



if (!function_exists('covernews_get_category_color_class')) :

    function covernews_get_category_color_class($term_id)
    {

        $color_id = "category_color_" . $term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $term_meta = get_option($color_id);
        $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : '';
        return $color_class;


    }
endif;

if (!function_exists('covernews_post_item_meta')) :

    function covernews_post_item_meta()
    {
        global $post;
        $author_id = $post->post_author;
        $display_setting = covernews_get_option('global_post_date_author_setting');
        $date_display_setting = covernews_get_option('global_date_display_setting');
        ?>

        <span class="author-links">
            <?php

            if ($display_setting == 'show-date-author' || $display_setting == 'show-date-only'): ?>
                <span class="item-metadata posts-date">
                <i class="far fa-clock"></i>
                    <?php
                    if($date_display_setting == 'default-date'){
                        the_time(get_option('date_format'));
                    }else{
                        echo human_time_diff(get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'covernews');
                    }


                    ?>
            </span>
            <?php endif; ?>
            <?php if ($display_setting == 'show-date-author' || $display_setting == 'show-author-only'): ?>

                <span class="item-metadata posts-author">
            <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
            </a>
        </span>
            <?php endif; ?>
        </span>
        <?php


    }
endif;


if (!function_exists('covernews_post_item_tag')) :

    function covernews_post_item_tag($view = 'default')
    {
        global $post;

        if ('post' === get_post_type()) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'covernews'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html('Tags: %1$s') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (is_single()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'covernews'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }

    }
endif;