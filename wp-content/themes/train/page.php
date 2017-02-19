<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Train
* @since 	1.0.8
 */

get_header(); ?>

<section class="page-section">
    <div class="container">
        <div class="row">
        	<?php
				$class = 'col-md-6';
				$sidebar =  esc_attr(get_theme_mod('single_page_sidebar_position','right'));
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
	                <?php get_template_part( 'template-parts/content', 'page' ); ?>   

	            <?php endwhile; // End of the loop. ?> 

	            <?php comments_template(); ?>         

	        </div> <!-- /.end of detail-content -->

			<?php
			    if ($sidebar == 'right' || $sidebar == 'both'){ 
			        get_sidebar('right');
			       }
			?>
        </div> <!-- /.end of row -->
    </div> <!-- /.end of container -->
</section> <!-- /.end of section -->
<div class="clear-both"></div>
<?php get_footer(); ?>