<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoverNews
 */

?>


<?php if (is_singular()) : ?>
    <div class="entry-content">
        <?php
        the_content(sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'covernews'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        )); ?>
        <?PHP if (is_single()): ?>
            <div class="post-item-metadata entry-meta">
                <?php covernews_post_item_tag(); ?>
            </div>
        <?php endif; ?>
        <?php
        the_post_navigation(array(
            'prev_text' => __('<span class="em-post-navigation">Previous</span> %title', 'covernews'),
            'next_text' => __('<span class="em-post-navigation">Next</span> %title', 'covernews'),
            'in_same_term' => true,
            'taxonomy' => __('category', 'covernews'),
            'screen_reader_text' => __('Continue Reading', 'covernews'),
        ));
        ?>
        <?php wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'covernews'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->


<?php else:
    $archive_class = covernews_get_option('archive_layout');

    if ($archive_class == 'archive-layout-grid'):
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-4 col-sm-4 col-md-4 latest-posts-grid'); ?>
                 data-mh="archive-layout-grid">
            <?php covernews_page_layout_blocks('archive-layout-grid'); ?>
        </article>
    <?php else: ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('latest-posts-full col-sm-12'); ?>>
            <?php covernews_page_layout_blocks(); ?>
        </article>
    <?php endif; ?>
<?php endif; ?>
