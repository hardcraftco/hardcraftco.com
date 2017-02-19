<?php

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Train
 * @since   1.0.8
 */

get_header(); ?>
<section class="page-section">
    <div class="container">
        <div class="row">
            <?php if ( have_posts() ) : ?> 
            <?php
                $class = 'col-md-6';
                $sidebar =  esc_attr(get_theme_mod('category_sidebar_position',__('right','train') ));
                if($sidebar != 'both'){
                    $class = 'col-md-9';
                }
            ?>          
            <?php
                if ($sidebar == 'left' || $sidebar == 'both'){ 
                    get_sidebar('left');
                   }
            ?>          
            <div class="<?php echo $class;?> clear-both">
                 <?php
                    the_archive_title( '<h1>', '</h1>' );
                    
                ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php

                        /*

                         * Include the Post-Format-specific template for the content.

                         * If you want to override this in a child theme, then include a file

                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.

                         */

                        get_template_part( 'template-parts/content', get_post_format() );
                    ?>
                <?php endwhile; ?>                    
                 <?php 
                     the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'train' ),
                            'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'train' ),
                        ) );

                  ?>       
                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>                 

            </div> <!-- /.end of single-post clear-both-->
            <?php if ($sidebar == 'right' || $sidebar == 'both'){          
                get_sidebar('right');            

                }
            ?>
        </div>  <!-- /.end of row -->      
    </div> <!-- /.end of container -->

</section>  <!-- /.end of section --> 



<div class="clear-both"></div>

<?php get_footer();?>