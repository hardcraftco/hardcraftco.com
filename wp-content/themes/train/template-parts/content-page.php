<?php /**  
* The template used for displaying page content in page.php  
*  
* @package Train
* @since 	1.0.5
  */

?>
<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>
<div class="single-post">
	<div class="content-wrapper">
	<div class="post-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<figure>
				<?php the_post_thumbnail('full'); ?>
			</figure>
		<?php endif; ?>       
		<article>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'train' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</article> <!-- /.end of article -->
	</div>
	</div>
</div>
<div class="clearfix"></div>

<div class="entry-meta">

	<?php edit_post_link( __( 'Edit', 'train' ), '<span class="edit-link">', '</span>' ); ?>

</div><!-- .entry-meta -->