<?php
/**
 * Full block part for displaying page content in page.php
 *
 * @package Newsphere
 */
?>

<?php

$newsphere_slider_category = newsphere_get_option('select_slider_news_category');
$newsphere_number_of_slides = 5;

?>

<div class="banner-carousel-1 af-widget-carousel swiper-container banner-carousel-slider">
    <div class="swiper-wrapper">
        <?php
        $slider_posts = newsphere_get_posts($newsphere_number_of_slides, $newsphere_slider_category);
        if ($slider_posts->have_posts()) :
            while ($slider_posts->have_posts()) : $slider_posts->the_post();

                global $post;
                $url = newsphere_get_freatured_image_url($post->ID, 'newsphere-slider-center');
                ?>
                <div class="swiper-slide">
                    <div class="read-single color-pad">
                        <div class="read-img pos-rel read-img read-bg-img data-bg"
                             data-background="<?php echo esc_url($url); ?>">
                            <a class="aft-slide-items" href="<?php the_permalink(); ?>"></a>
                            <?php if (!empty($url)): ?>
                                <img src="<?php echo esc_url($url); ?>">
                            <?php endif; ?>
                            <?php newsphere_get_comments_count($post->ID); ?>
                            <span class="min-read-post-format">
                                <?php echo newsphere_post_format($post->ID); ?>
                                <?php newsphere_count_content_words($post->ID); ?>

                            </span>
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
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <div class="swiper-button-next af-slider-btn"></div>
    <div class="swiper-button-prev af-slider-btn"></div>
</div>