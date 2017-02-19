<?php
/**
 * @package onsale
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
	<div class="post-meta"><?php storefront_posted_on(); ?></div>
	<?php
	/**
	 * @hooked storefront_post_meta - 20
	 * @hooked storefront_post_content - 30
	 */
	do_action( 'onsale_single_post' );
	?>

</article><!-- #post-## -->