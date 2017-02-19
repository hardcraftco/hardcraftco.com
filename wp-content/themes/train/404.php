<?php
/**
 * The template for displaying search results pages.
 *
 * @package Train
 * @since   1.0.8
 */

get_header(); ?>

<section class="page-header">
    <div class="container">        
        <div class="row">
            <div class="col-sm-12">
             <h1 class="text-center">
              <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'train' ); ?>
             </h1>
         </div>
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
                <div class="col-sm-12">
          <div class="not-found">
              <p class="text-center"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'train' ); ?></p>
               <?php get_search_form(); ?>
          </div>
          </div>

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