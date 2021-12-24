<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package CoverNews
 */

?>

<div class="promotionspace enable-promotionspace">

    <div class="em-reated-posts  col-ten">
        <div class="row">
            <?php
            global $post;
            $categories = get_the_category($post->ID);
            $related_section_title = esc_attr(covernews_get_option('single_related_posts_title'));
            $number_of_related_posts = 3;

            if ($categories) {
            $cat_ids = array();
            foreach ($categories as $category) $cat_ids[] = $category->term_id;
            $args = array(
                'category__in' => $cat_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => $number_of_related_posts, // Number of related posts to display.
                'ignore_sticky_posts' => 1
            );
            $related_posts = new wp_query($args);

            if (!empty($related_posts)) { ?>
                <h3 class="related-title">                    
                    <?php echo apply_filters( 'the_title', $related_section_title); ?>
                </h3>
            <?php }
            ?>
            <div class="row">
                <?php
                while ($related_posts->have_posts()) {
                    $related_posts->the_post();
                    if (has_post_thumbnail()) {
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'covernews-medium');
                        $url = $thumb['0'];
                        $col_class = 'col-five';
                    } else {
                        $url = '';
                        $col_class = 'col-ten';
                    }
                    global $post;
                    ?>
                    <div class="col-sm-4 latest-posts-grid" data-mh="latest-posts-grid">
                        <div class="spotlight-post">
                            <figure class="categorised-article">
                                <div class="categorised-article-wrapper">
                                    <div class="data-bg data-bg-hover data-bg-categorised"
                                         data-background="<?php echo esc_url($url); ?>">
                                        <a href="<?php the_permalink(); ?>"></a>
                                    </div>
                                </div>
                            </figure>

                            <figcaption>
                                <div class="figure-categories figure-categories-bg">
                                    <?php echo covernews_post_format($post->ID); ?>
                                    <?php covernews_post_categories(); ?>
                                </div>
                                <h3 class="article-title article-title-1">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="grid-item-metadata">
                                    <?php covernews_post_item_meta(); ?>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                <?php }
                }
                wp_reset_postdata();
                ?>
            </div>

        </div>
    </div>
</div>