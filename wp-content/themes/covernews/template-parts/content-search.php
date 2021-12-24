<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CoverNews
 */


$archive_class = covernews_get_option('archive_layout');
if ($archive_class == 'archive-layout-grid'):
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-6 col-sm-6 col-md-6 archive-layout-grid'); ?> data-mh="archive-layout-grid">
        <?php covernews_page_layout_blocks('archive-layout-grid'); ?>
    </article>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php covernews_page_layout_blocks(); ?>
    </article>
<?php endif; ?>

