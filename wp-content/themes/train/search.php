<?php
/**
 * The template for displaying search results pages.
 *
 * @package Train
 * @since   2.0.1
 */

get_header(); ?>

<section class="page-header">
    <div class="container">        
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
                
                    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'train' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </div>
            </div> <!-- /.end of col 12 -->
        </div> <!-- /.end of row -->        
    </div> <!-- /.end of container -->
</section> <!-- /.end of section -->


<section class="page-section">
    <div class="container">
        <div class="row">           
            <?php
                $class = 'col-md-6';
                $sidebar =  esc_attr(get_theme_mod('search_page_sidebar_position','right'));
            
                 if($sidebar != 'both'){
                  $class = 'col-md-9';
                }
            ?>

            <?php
                  if ($sidebar == 'left' || $sidebar == 'both'){
                  get_sidebar('left');
                 }
            ?>

            <div class="<?php echo $class;?> detail-content">
                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-sm-12">
                            <article>
                                <h1><?php the_title();?></h1>
                                <ul class="list-inline post-info">
                                    <li><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>"><i class="fa fa-calendar"></i><?php echo get_the_date('d M Y');?></a></li>
                                    <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><i class="fa fa-user"></i> <?php echo esc_attr(get_the_author_meta('display_name'));?></a></li>
                                    <li><a href=""><i class="fa fa-comments"></i> <?php comments_popup_link(esc_html__('No comment','train'),esc_html__('1 comment','train'), esc_html__('% comments','train'));?></a></li>

                                </ul>

                                <?php the_excerpt();?>

                                <div class="tag-button">
                                    <span class="theme-tag pull-left">
                                        <?php echo get_the_tag_list('<p><i class="fa fa-tag"></i> ',', ','</p>'); ?>
                                    </span>

                                    <span class="read-more pull-right">
                                        <a href="<?php the_permalink();?>" class="btn btn-theme"><?php _e('Read More','train')?> <i class="fa fa-angle-double-right"></i> </a>
                                    </span>
                                </div> <!-- /.end of tag-button -->
                            </article> <!-- /.end of article -->
                        </div> <!-- /.end of col 6 -->
                        <div class="clearfix"></div>
                    <?php endwhile; ?>

                    

                <?php else : ?>

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                <?php endif; ?>

            </div>

            <?php if ($sidebar == 'right' || $sidebar == 'both'){
                get_sidebar('right');
            }
            ?>

        </div> <!-- /.end of row -->
    </div> <!-- /.end of container -->
</section> <!-- /.end of section -->
<div class="clear-both"></div> 

<?php get_footer(); ?>