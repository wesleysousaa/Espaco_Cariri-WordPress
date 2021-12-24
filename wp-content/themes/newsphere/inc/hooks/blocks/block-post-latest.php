<?php
/**
 * List block part for displaying latest posts in footer.php
 *
 * @package Newsphere
 */

$newsphere_latest_posts_title = newsphere_get_option('frontpage_latest_posts_section_title');
$newsphere_latest_posts_subtitle = newsphere_get_option('frontpage_latest_posts_section_subtitle');
$number_of_posts = newsphere_get_option('number_of_frontpage_latest_posts');

$all_posts = newsphere_get_posts($number_of_posts);


?>
<div class="af-main-banner-latest-posts grid-layout">
    <div class="container-wrapper">
        <div class="widget-title-section">
            <?php if (!empty($newsphere_latest_posts_title)): ?>
                <h4 class="widget-title header-after1">
                            <span class="header-after">
                                <?php echo esc_html($newsphere_latest_posts_title);  ?>
                            </span>
                </h4>
            <?php endif; ?>

        </div>
        <div class="af-container-row clearfix">
        <?php
        if ($all_posts->have_posts()) :
            while ($all_posts->have_posts()) : $all_posts->the_post();
                global $post;
                $url = newsphere_get_freatured_image_url($post->ID, 'newsphere-medium');

                ?>
                <div class="col-4 pad float-l" data-mh="you-may-have-missed">
                    <div class="read-single color-pad">
                        <div class="data-bg read-img pos-rel read-bg-img"
                             data-background="<?php echo esc_url($url); ?>">
                            <img src="<?php echo esc_url($url); ?>">
                            <span class="min-read-post-format">
    		  								<?php echo newsphere_post_format($post->ID); ?>
                                            <?php newsphere_count_content_words($post->ID); ?>

                            </span>
                            <a href="<?php the_permalink(); ?>"></a>
                            <?php newsphere_get_comments_count($post->ID); ?>
                        </div>
                        <div class="read-details color-tp-pad">
                            <div class="read-categories">
                                <?php newsphere_post_categories(); ?>
                            </div>
                            <div class="read-title">
                                <h4>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                            <div class="entry-meta">
                                <?php newsphere_post_item_meta(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endwhile; ?>
        <?php
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>
