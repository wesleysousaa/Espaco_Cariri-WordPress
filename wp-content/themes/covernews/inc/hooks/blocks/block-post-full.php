<?php
/**
 * Full block part for displaying page content in page.php
 *
 * @package CoverNews
 */
?>

<div class="entry-header-image-wrap">
    <header class="entry-header">
        <?php covernews_post_thumbnail(); ?>
        <div class="header-details-wrapper">
            <div class="entry-header-details">
                <?php if ('post' === get_post_type()) : ?>
                    <div class="figure-categories figure-categories-bg">
                        <?php echo covernews_post_format(get_the_ID()); ?>
                        <?php covernews_post_categories(); ?>
                    </div>
                <?php endif; ?>

                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a>
                    </h2>'); ?>
                <?php if ('post' === get_post_type()) : ?>
                    <div class="post-item-metadata entry-meta">
                        <?php covernews_post_item_meta(); ?>
                    </div>
                <?php endif; ?>

                <?php
                $archive_content_view = covernews_get_option('archive_content_view');
                if ($archive_content_view != 'archive-content-none'):
                    ?>

                    <div class="post-excerpt">
                        <?php

                        if ($archive_content_view == 'archive-content-excerpt') {

                            the_excerpt();
                        } else {
                            the_content();
                        }
                        ?>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </header>
</div>