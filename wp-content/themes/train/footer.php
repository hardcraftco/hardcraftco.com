<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Train 
* @since 	1.0.8
 */

?>		

<!-- Tab to top scrolling -->
<div class="scroll-top-wrapper"> 
	<span class="scroll-top-inner">
	<i class="fa fa-2x fa-angle-up"></i>
	</span>

</div> 
<footer>
	<?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
		<section class="footer-info">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'Footer sidebar' ); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<section class="copyright">
	    <div class="container">
	      	<div class="row">
	        	<div class="col-sm-8">
	        		<h6><?php echo esc_attr(get_theme_mod( 'copyright_textbox', __('Copyright &copy; 2016. Your Theme. All Rights Reserved.','train') )); ?> | <?php _e('Developed By :','train'); ?> <a href="#" rel="author"><?php _e('Oceanweb Theme','train')?></a></h6>
	        	</div>
	        	<div class="col-sm-4">
	        		<?php wp_nav_menu( array('theme_location'=>'secondary','menu_class'=>'list-inline') ); ?>
	        	</div>
	        </div>
	    </div>
	</section>

</footer>
<!-- Tab to top scrolling -->
		<div class="scroll-top-wrapper"> <span class="scroll-top-inner">
  			<i class="fa fa-2x fa-angle-up"></i>
    		</span>
    	</div>
		<?php wp_footer(); ?>
	</body>
</html>