<?php

/**
 * Template part for displaying blog posts.
 *
 * @package Train
 * @since   1.0.10
 */



?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="single-post">
<div class="content-wrapper">
    <div class="post-content">
        <figure>
            <?php 
                if (has_post_thumbnail()) :
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                    if(is_single()):
                    $featuredimage = get_theme_mod('enable_featuredimage','enable');
                        if($featuredimage=='enable'):
             ?>
                         <a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo $image[0]; ?>" class="img-responsive"></a>
                        <?php endif; ?>
                     <?php else:?>
                         <a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo $image[0]; ?>" class="img-responsive"></a>
                     <?php endif;?>
                <?php else : ?>
            <?php endif; ?>
        </figure>
        <article class="contents">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><h2 class="post-title"><?php the_title(); ?></h2></a>
            <div class="info">
                <ul class="list-inline">
                    <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><i class="fa fa-user"></i>  &nbsp;<?php echo esc_attr(get_the_author_meta('display_name'));?></a></li>
                    <li><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>" title=""><i class="fa fa-calendar"></i> <?php echo esc_attr(get_the_date('d M Y'));?></a></li>
                    <li><a href=""><i class="fa fa-comments-o"></i> &nbsp; <?php comments_popup_link(esc_html__('No comment','train'),esc_html__('1 comment','train'), esc_html__('% comments','train'));?></a></li>
                </ul>
            </div>
            <?php if(is_single()):
                     the_content(); 
                    else:
                      the_excerpt();
                  endif;
            ?>
        </article>
        <div class="bottom-info">
        <?php if(!is_single()): ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="" class="btn btn-primary pull-left"><?php _e('Read More','train')?> <i class="fa fa-angle-double-right"></i></a>
        <?php endif;?>
            <div class="tag-cat pull-right">
                <ul class="list-inline">
                    <li><i class="fa fa-folder-open"></i> <?php echo get_the_category_list(', '); ?></li>
                    <?php echo get_the_tag_list('<li><i class="fa fa-tag"></i> ',', ','</li>'); ?>
                </ul>
            </div>
        </div>

        </div>
        <?php if(is_single()):?>
        <div class="swift-pager">
            <ul class="pager">                    
                <?php
                previous_post_link( '<li class="previous">%link</li>', _x( '<i class="fa fa-angle-left"></i>', 'Previous post link', 'train' ) );
                next_post_link(     '<li class="next">%link</li>',     _x( '<i class="fa fa-angle-right"></i>', 'Next post link',     'train' ) );
                ?>
            </ul>

        </div> 
    <?php endif;?>
    </div>
    <div class="clearfix"></div>
    
</div>
</div> <!-- End of WordPress Generated Class -->

<div class="clearfix"></div>