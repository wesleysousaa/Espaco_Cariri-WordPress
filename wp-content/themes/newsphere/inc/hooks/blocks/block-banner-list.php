<?php
/**
 * Full block part for displaying page content in page.php
 *
 * @package Newsphere
 */
?>

<?php


$select_vertical_slider_news_category = newsphere_get_option('select_vertical_slider_news_category');
$vertical_slider_number_of_slides = newsphere_get_option('vertical_slider_number_of_slides');
$all_posts_vertical = newsphere_get_posts($vertical_slider_number_of_slides, $select_vertical_slider_news_category);

?>
<div class="af-container-row clearfix af-flex-container">
    <div class="col-40 pad float-l full-wid-resp">
        <div class="vertical-slider af-widget-carousel swiper-container">
            <div class="swiper-wrapper">

                <?php
                $count = 1;
                if ($all_posts_vertical->have_posts()) :
                    while ($all_posts_vertical->have_posts()) : $all_posts_vertical->the_post();

                        ?>

                        <div class="swiper-slide">
                            <div class="list-part af-sec-post">
                                <div class="af-double-column list-style clearfix">
                                    <div class="read-single color-pad">
                                        <span class="trending-no">
                                                <?php echo sprintf( __( '%s', 'newsphere' ), $count); ?>
                                            </span>

                                        <div class="read-details float-l col-85 pad color-tp-pad">
                                            <div class="read-categories">
                                                <?php newsphere_post_categories(); ?>
                                            </div>
                                            <div class="read-title">
                                                <h4>
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                            </div>

                                            <div class="entry-meta">
                                                <?php newsphere_get_comments_count($post->ID); ?>
                                                <?php newsphere_post_item_meta(); ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $count++;
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>


            </div>
            <div class="swiper-button-next af-slider-btn"></div>
            <div class="swiper-button-prev af-slider-btn"></div>
        </div>
    </div>

    <?php

    $newsphere_slider_category = newsphere_get_option('select_slider_news_category');
    $newsphere_number_of_slides = newsphere_get_option('number_of_slides');
    $all_posts_main = newsphere_get_posts($newsphere_number_of_slides, $newsphere_slider_category);


    ?>

    <div class="col-60 pad float-l full-wid-resp">
        <div class="banner-carousel-1 banner-main-slider af-widget-carousel swiper-container">
            <div class="swiper-wrapper">
                <?php
                $count = 1;

                if ($all_posts_main->have_posts()) :
                    while ($all_posts_main->have_posts()) : $all_posts_main->the_post();

                        global $post;
                        $url = newsphere_get_freatured_image_url($post->ID, 'newsphere-slider-full');

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
    </div>
</div>