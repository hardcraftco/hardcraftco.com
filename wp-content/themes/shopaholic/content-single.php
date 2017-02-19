<?php
/**
 * @package shopaholic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
	<?php
	/**
	 * @hooked shopaholic_post_meta - 10
	 */
		do_action('shopaholic_blog_post_content');

	/**
	 * @hooked storefront_post_content - 20
	 */
		do_action('shopaholic_single_post');
	?>

</article><!-- #post-## -->