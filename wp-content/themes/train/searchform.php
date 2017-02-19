<div class="search">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<!--  <span class="screen-reader-text"><?php echo _x( '', 'label', 'train' ) ?></span> -->
		<input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Type Something to search', 'placeholder' , 'train' ) ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'train'  ) ?>" />
		<!-- <input type="submit" class="search-submit" value="&#xf002;" /> -->
	</form>
</div>