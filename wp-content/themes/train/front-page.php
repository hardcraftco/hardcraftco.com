<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Train
 * @since   1.0.10
 */
get_header(); ?>
<?php if ( 'posts' != get_option( 'show_on_front' ) ): ?>
<section class="theme-slider">
  <div class="container-fluid">
    <div class="row">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php
          $cid = esc_attr(get_theme_mod('slider_category_display'));
          $category_link = get_category_link($cid);
          $train_theme_cat = get_category($cid);
          if ($train_theme_cat) {
          ?>
            <?php 
            global $post;
        $cnum= esc_attr(get_theme_mod('slider_category_display_num'));
            ?>
          <?php
            $args = array(
              'posts_per_page' => $cnum,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);

            $cn = 0;
            if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
            $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'train-slider-thumb' );
          ?>
          <div class="item <?php echo $cn == 1 ? 'active' : ''; ?>" style="background:url('<?php echo $image[0]; ?>'); background-size:cover; background-position:center">
                <div class="carousel-caption wow slideInUp container" data-wow-duration="2s">
                <div class="row">
                 <div class="content col-sm-6 hidden-xs text-left">
                    <h1><?php the_title();?></h1>
                  <?php the_excerpt();?>
                    <div class="btn-group">
                                <?php if(esc_attr(get_theme_mod('slider_button'))){?>
                          <a href="<?php echo esc_url(get_theme_mod( 'slider_button_link', '#' ));?>" title="" class="btn"><?php echo esc_attr(get_theme_mod('slider_button'));?></a>
                      <?php } ?>
                                <a href="<?php the_permalink();?>" title="" class="btn"><?php _e('Read More','train'); ?></a>

                    </div>             
                  </div>  
                  </div>
              </div> <!-- /.end of carousel-caption -->
            
          </div> <!-- /.end of item -->
      <?php                 
        endwhile;
          wp_reset_postdata();  
        endif;                             
        }
      ?> 
        </div>  <!-- /.end of carousel inner -->
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          <span class="sr-only"><?php __('Previous','train'); ?></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
          <span class="sr-only"><?php __('Next','train'); ?></span>
        </a>
      </div> <!-- /.end of carousel example -->
    </div> <!-- /.end of row -->
  </div> <!-- /.end of container -->
</section> <!-- /.end of section -->

<div class="clearfix"></div>

<section class="welcome main-section">
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
            <div class="section-title text-center">
                <h1><?php echo esc_attr(get_theme_mod( 'welcome_textbox1', __('Welcome to Train Theme','train' ))); ?></h1>
                <div class="long-line"></div>

            </div>
          </div>
          <div class="col-sm-12">
            <div class="content text-center">
                <h2><?php echo esc_attr(get_theme_mod( 'welcome_textbox2', __('FREE RESPONSIVE, MULTIPURPOSE BUSINESS AND CORPORATE THEME PERFECT FOR ANY ONE.','train' ))); ?></h2>
                    <p><?php echo esc_html(get_theme_mod( 'textarea_setting', __('Train Theme is a simple, clean, beautifully designed responsive WordPress business theme. It is minimal but mostly used features will help you setup your website easily and quickly. Full width layout, featured slider,services/features layout, blog layout, social media integration, full width page layout and woocommerce ready. ','train' ))); ?></p> 
                <a href="<?php echo esc_url(get_theme_mod( 'welcome_button', '#' )); ?>" title="<?php _e('Read More','train'); ?>" class="btn btn-primary"><?php _e('Read More','train'); ?></a>
            </div>
          </div>
      </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="featured-content main-section">
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
            <div class="section-title text-center">
                <h1><?php echo esc_attr(get_theme_mod('featured_title',__('Featured Contents','train'))) ?></h1>
                <div class="long-line"></div>                
            </div>
          </div>
          <?php
            $cid = esc_attr(get_theme_mod('features_display'));
            $category_link = get_category_link($cid);
            $train_theme_cat = get_category($cid);
            if ($train_theme_cat) {
          ?>
              <?php 
                global $post;
        $fnum=esc_attr(get_theme_mod('feature_category_display_num',3));

            ?>
          <?php

              $args = array(
                  'posts_per_page' => $fnum,
                  'paged' => 1,
                  'cat' => $cid
              );
              $loop = new WP_Query($args);                                   
              if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
          ?>
          <div class="col-md-4 col-sm-6 featured">
            <div class="single">
                  <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php if(has_post_thumbnail()){
                      $arg =
                        array(
                            'class' => 'img-responsive center-block img-thumbnail',
                            'alt' => '',
                            'data-wow-duration'=> '2s'
                        );
                        the_post_thumbnail('train-home-thumb',$arg);
                    } 
                  ?></a>
              <h1><a href="<?php the_permalink(); ?>" rel="bookmark" class="content-title"><?php the_title();?></a></h1>
              <p><?php echo the_excerpt(); ?><a href="<?php the_permalink();?>" title="" class="btn"><?php _e('Read More','train'); ?></a>
            </div>
          </div>
          <?php
            endwhile;
                wp_reset_postdata();
            endif; }
        ?>
        <div class="col-sm-12 text-center">
            <a href="<?php echo esc_url( $category_link ); ?>" title="" class="btn "><?php _e('View All','train'); ?></a>
          </div>
      </div>  <!-- /.end of row -->
    </div>  <!-- /.end of container -->
</section>  <!-- /.end of section -->





<?php else: ?>
<section class="page-section">
  <div class="container">
    <div class="row">
      <?php
        $class = 'col-md-6';
        $sidebar =  esc_attr(get_theme_mod('category_sidebar_position','right'));
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
          <?php if ( have_posts() ) : ?>                
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php

                /* Include the Post-Format-specific template for the content.

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
              <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
        </div>
        <?php if ($sidebar == 'right' || $sidebar == 'both'){

            get_sidebar('right');            

            }
        ?>
    </div> <!-- /.end of row -->
  </div> <!-- /.end of container -->
</section>  <!-- /.end of section --> 
<?php endif; ?>

  

<?php get_footer();?>