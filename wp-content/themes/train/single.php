<?php
/**
 * The template for displaying all single posts.
 *
 * @package Train
 * @since   1.0.8
 */

get_header(); ?>

<section class="page-section">
  <div class="container">
    <div class="row">
        <?php
        $class = 'col-md-6';
        $sidebar =  esc_attr(get_theme_mod('single_post_sidebar_position','right'));
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
            
        <?php while ( have_posts() ) : the_post(); ?>                    
          <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
          
        
        <?php endwhile; // End of the loop. ?>
        
        <?php comments_template(); ?>
      <?php 
                     the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'train' ),
                            'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'train' ),
                        ) );

                  ?>  
        </div><!-- /.end of deatil-content -->
        
        <?php if ($sidebar == 'right' || $sidebar == 'both'){
          get_sidebar('right');            
          }
        ?>        

     </div> <!-- /.end of row -->  
    </div> <!-- /.end of container -->  
</section> <!-- /.end of section -->  
<div class="clear-both"></div>
<?php get_footer(); ?>