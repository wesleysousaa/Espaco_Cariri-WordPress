<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package CoverNews
 */

$excerpt_length = 20;
if (has_post_thumbnail()) {
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-medium');
    $url = $thumb['0'];
} else {
    $url = '';
}
global $post;


$class = '';
$background = '';
if ($url != '') {
    $class = 'data-bg data-bg-categorised';
    $background = $url;
}
?>

<div class="align-items-center">
        <div class="spotlight-post">
            <figure class="categorised-article inside-img">
                <div class="categorised-article-wrapper">
                    <div class="data-bg-hover data-bg data-bg-categorised"
                         data-background="<?php echo esc_attr($background); ?>">
                        <a href="<?php the_permalink(); ?>"></a>
                    </div>
                    <?php echo covernews_post_format($post->ID); ?>
                    <div class="figure-categories figure-categories-bg">
                        <?php covernews_post_categories(); ?>
                    </div>
                </div>

            </figure>
            <figcaption>

                <h3 class="article-title article-title-1">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <div class="grid-item-metadata">
                    <?php covernews_post_item_meta(); ?>
                </div>
                <?php
                $archive_content_view = covernews_get_option('archive_content_view');
                if ($archive_content_view != 'archive-content-none'):
                    ?>
                    <div class="full-item-discription">
                        <div class="post-description">
                            <?php

                            if ($archive_content_view == 'archive-content-excerpt') {

                                the_excerpt();
                            } else {
                                the_content();
                            }
                            ?>

                        </div>
                    </div>
                <?php endif; ?>
            </figcaption>
    </div>
    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'covernews'),
        'after' => '</div>',
    ));
    ?>
</div>







