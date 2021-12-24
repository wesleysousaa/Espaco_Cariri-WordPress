<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package CoverNews
 */

?>
<header class="entry-header">

    <div class="header-details-wrapper">
        <div class="entry-header-details">
            <?php if ('post' === get_post_type()) : ?>
                <div class="figure-categories figure-categories-bg">
                    <?php echo covernews_post_format(get_the_ID()); ?>
                    <?php covernews_post_categories(); ?>
                </div>
            <?php endif; ?>
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

            <?php if ('post' === get_post_type()) : ?>

                <?php covernews_post_item_meta(); ?>
                <?php if (has_excerpt()): ?>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>


            <?php endif; ?>
        </div>
    </div>

    <?php
    $single_show_featured_image = covernews_get_option('single_show_featured_image');
    if($single_show_featured_image == true):
    ?>
    <div class="aft-post-thumbnail-wrapper">    
    <?php covernews_post_thumbnail(); ?>
    <?php 
    if(has_post_thumbnail()):
        if($aft_image_caption = get_post( get_post_thumbnail_id() )->post_excerpt): ?>
            <span class="aft-image-caption">
                <p>
                    <?php echo $aft_image_caption; ?>
                </p>
            </span>
    <?php 
            endif; 
        endif; 
    ?>
    </div>
    <?php endif; ?>
</header><!-- .entry-header -->