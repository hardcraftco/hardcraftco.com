<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class MSL_Admin
{

	public function __construct()
	{
		/* Enqueue backend scripts */
		add_action('admin_enqueue_scripts', array(&$this, 'load_backend_scripts'));

		/* Add menu items to dashboard */
		add_action('admin_menu', array(&$this, 'admin_menu_items'));

		/* Enqueue backend scripts */
		add_action('admin_init', array(&$this, 'register_plugin_settings'));
	}

	// -------------------------------------------------------------------

	/* Load backend scripts and stylesheets */
	public function load_backend_scripts($hook)
	{
		// Load scripts only on my plugins admin page
		if(strpos($hook, 'musli-social-links') === FALSE)
		{
			return;
		}

		// scripts
		wp_enqueue_media();
		wp_enqueue_script( 'jQuery' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_script( 'msl-admin', MUSLI_SL_URL . 'js/msl-admin.js', array('jquery'), NULL, TRUE);

		// stylesheets
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'musli-social-links-admin', MUSLI_SL_URL . 'css/musli-social-links-admin.css', array(), NULL );
		wp_enqueue_style( 'jquery-ui', MUSLI_SL_URL . 'css/jquery-ui.css', array(), NULL );
		wp_enqueue_style( 'font-awesome', MUSLI_SL_URL . 'css/font-awesome.min.css', array(), NULL );
		wp_enqueue_style( 'musli-social-links', MUSLI_SL_URL . 'css/musli-social-links.css', array(), NULL );
	}

	// -------------------------------------------------------------------

	/* Add menu options */
	public function admin_menu_items()
	{
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page('Musli Social Links', 'Musli Links', 'manage_options', 'musli-social-links', array(&$this, 'manage_links_form'), 'dashicons-star-filled');
			
			// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
			add_submenu_page('musli-social-links', 'Manage Links', 'Manage Links', 'manage_options', 'musli-social-links', array(&$this, 'manage_links_form'));
			add_submenu_page('musli-social-links', 'General Settings', 'General Settings', 'manage_options', 'musli-social-links-settings', array(&$this, 'general_settings_form'));
	}

	// -------------------------------------------------------------------

	public function manage_links_form()
	{
		$i = 111; ?>

		<div class="wrap">
			<h1>Musli Social Links <a class="page-title-action" href="">Add new link</a></h1>
			<p>Hi, I really hope that you like this plugin! If you have any troubles, questions or requests regarding it, don't hesitate to ask on forums.</p>
			
			<?php settings_errors(); ?>

			<form action="options.php" method="post" id="msl-form">
				
				<?php settings_fields('msl_links'); ?>
    			<?php $msl_links = get_option('msl_links'); ?>

				<ul id="msl-list">
				<?php if (is_array($msl_links)): ?>
					<?php foreach ($msl_links as $k => $link): ?>

						<?php $id = 'msl-' . $i++;  ?>
						<li>
							<i class="fa fa-<?php echo esc_attr( $link['class'] ); ?> load-icons-set" title="Click to choose another icon"></i>
							<input type="hidden" class="msl_hidden" name="msl_links[<?php echo $id; ?>][class]" value="<?php echo esc_attr( $link['class'] ); ?>">
							<input type="text" name="msl_links[<?php echo $id; ?>][url]" value="<?php echo esc_url( $link['url'] ); ?>" placeholder="Link URL">
							<input type="text" name="msl_links[<?php echo $id; ?>][title]" value="<?php echo esc_html( $link['title'] ); ?>" placeholder="Link caption">
							<i class="fa fa-trash fa-action" title="Delete this link"></i>
						</li>
					<?php endforeach ?>
				<?php endif ?>
				</ul>

				<input type="hidden" name="msl_last_id" value="<?php echo $i; ?>">
				<p class="description">You can change links order with "drag&amp;drop" method!</p>
        
				<?php submit_button(); ?>

			</form>
		</div>

			<div class="icons-set icons-set-prototype">
				<a data-class="500px"><i class="fa fa-500px"></i></a><a data-class="apple"><i class="fa fa-apple"></i></a>
				<a data-class="archive"><i class="fa fa-archive"></i></a>
				<a data-class="behance"><i class="fa fa-behance"></i></a><a data-class="delicious"><i class="fa fa-delicious"></i></a>
				<a data-class="deviantart"><i class="fa fa-deviantart"></i></a><a data-class="digg"><i class="fa fa-digg"></i></a>
				<a data-class="dribbble"><i class="fa fa-dribbble"></i></a><a data-class="envelope"><i class="fa fa-envelope"></i></a>
				<a data-class="envelope-o"><i class="fa fa-envelope-o"></i></a><a data-class="facebook"><i class="fa fa-facebook"></i></a>
				<a data-class="flickr"><i class="fa fa-flickr"></i></a><a data-class="foursquare"><i class="fa fa-foursquare"></i></a>
				<a data-class="github"><i class="fa fa-github"></i></a>
				<a data-class="google"><i class="fa fa-google"></i></a><a data-class="google-plus"><i class="fa fa-google-plus"></i></a>
				<a data-class="heart-o"><i class="fa fa-heart-o"></i></a>
				<a data-class="instagram"><i class="fa fa-instagram"></i></a><a data-class="joomla"><i class="fa fa-joomla"></i></a>
				<a data-class="lastfm"><i class="fa fa-lastfm"></i></a><a data-class="linkedin"><i class="fa fa-linkedin"></i></a>
				<a data-class="link"><i class="fa fa-link"></i></a><a data-class="paper-plane"><i class="fa fa-paper-plane"></i></a>
				<a data-class="pinterest"><i class="fa fa-pinterest"></i></a><a data-class="play"><i class="fa fa-play"></i></a>
				<a data-class="reddit"><i class="fa fa-reddit"></i></a>
				<a data-class="rss"><i class="fa fa-rss"></i></a><a data-class="skype"><i class="fa fa-skype"></i></a>
				<a data-class="slideshare"><i class="fa fa-slideshare"></i></a>
				<a data-class="soundcloud"><i class="fa fa-soundcloud"></i></a><a data-class="shopping-cart"><i class="fa fa-shopping-cart"></i></a>
				<a data-class="spotify"><i class="fa fa-spotify"></i></a><a data-class="steam"><i class="fa fa-steam"></i></a>
				<a data-class="stumbleupon"><i class="fa fa-stumbleupon"></i></a>
				<a data-class="tumblr"><i class="fa fa-tumblr"></i></a><a data-class="twitter"><i class="fa fa-twitter"></i></a>
				<a data-class="thumbs-o-up"><i class="fa fa-thumbs-o-up"></i></a><a data-class="vimeo"><i class="fa fa-vimeo"></i></a>
				<a data-class="vine"><i class="fa fa-vine"></i></a><a data-class="wikipedia-w"><i class="fa fa-wikipedia-w"></i></a>
				<a data-class="windows"><i class="fa fa-windows"></i></a>
				<a data-class="wordpress"><i class="fa fa-wordpress"></i></a><a data-class="xing"><i class="fa fa-xing"></i></a>
				<a data-class="yahoo"><i class="fa fa-yahoo"></i></a>
				<a data-class="yelp"><i class="fa fa-yelp"></i></a><a data-class="youtube"><i class="fa fa-youtube"></i></a>
			</div>

			<li class="link-prototype">
				<i class="fa fa-link load-icons-set" title="Click to choose another icon"></i>
				<input type="hidden" class="msl_hidden" name="class" value="link">
				<input type="text" name="url" value="#link-url" placeholder="Link URL">
				<input type="text" name="title" value="Visit Us on..." placeholder="Link caption">
				<i class="fa fa-trash fa-action" title="Delete this link"></i>
			</li>

		<?php
	}

	// -------------------------------------------------------------------

	public function general_settings_form()
	{
		?>

		<div class="wrap">
			<h1>Musli Social Links - General Options</h1>

			<?php settings_errors(); ?>

			<form action="options.php" method="post" id="msl-form">
				<?php settings_fields('msl_settings'); ?>

				<?php do_settings_sections("musli-social-links"); ?>

				<?php submit_button(); ?>
			</form>
		</div>

		<?php
	}

	// -------------------------------------------------------------------

	public function register_plugin_settings()
	{
		//add_settings_section( $id, $title, $callback, $page );
		add_settings_section('msl-section-general', 'General settings', array(&$this, 'render_msl_section_general'), 'musli-social-links');

		// register WP option for links list
		// register_setting( $option_group, $option_name, $sanitize_callback );
		register_setting('msl_links', 'msl_links', array(&$this, 'sanitize_links'));

		// register WP option for plugin settings
		register_setting('msl_settings', 'msl_settings', array(&$this, 'sanitize_options'));

		//get fields settings
		$fields = $this->get_settings_options();

		foreach ($fields as $field)
		{
			extract($field);

			//add_settings_field( $id, $title, $callback, $page, $section, $args );
			add_settings_field( $id, $title, array(&$this, $callback), $page, $section, $args );
		}

	}

	// -------------------------------------------------------------------

	private function get_settings_options()
	{

		$msl_settings = get_option('msl_settings');

		//theme
		$settings[] = array(
			'id'		=> 'msl-theme',
			'title'		=> 'Theme: ',
			'callback'	=> 'render_msl_dropdown',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-theme',
				'name'	=> 'msl_settings[theme]',
				'value' => isset($msl_settings['theme']) ? $msl_settings['theme'] : 'msl-theme-default',
				'description' => '',
				'options' 	  => array(
					'msl-theme-default',
					'msl-theme-2', 
					'msl-theme-3', 
					'msl-theme-4',
					'msl-theme-5',
					'msl-theme-6',
					'msl-theme-7'
				)
			)
		);

		//position
		$settings[] = array(
			'id'		=> 'msl-position',
			'title'		=> 'Position: ',
			'callback'	=> 'render_msl_position',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-position',
				'name'	=> 'msl_settings[position]',
				'value' => isset($msl_settings['position']) ? $msl_settings['position'] : 'right',
				'class'	=> '',
				'type'	=> 'radio',
				'description' => 'Not working in the preview mode.',
				'options' 	  => array('right', 'left')
			)
		);

		//position-margin
		$settings[] = array(
			'id'		=> 'msl-position-margin',
			'title'		=> 'Position margin: ',
			'callback'	=> 'render_small_number',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-position-margin',
				'name'	=> 'msl_settings[position-margin]',
				'value' => isset($msl_settings['position-margin']) ? $msl_settings['position-margin'] : '30',
				'class'	=> 'small-text',
				'type'	=> 'number',
				'unit'	=> '[%]',
				'slider_min'  => '0',
				'slider_max'  => '100',
				'description' => 'Margin from browsers edge.'
			)
		);

		//icon-size
		$settings[] = array(
			'id'		=> 'msl-icon-size',
			'title'		=> 'Size of the icon: ',
			'callback'	=> 'render_small_number',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-icon-size',
				'name'	=> 'msl_settings[icon-size]',
				'value' => isset($msl_settings['icon-size']) ? $msl_settings['icon-size'] : '50',
				'class'	=> 'small-text',
				'type'	=> 'number',
				'unit'	=> '[px]',
				'slider_min'  => '20',
				'slider_max'  => '80',
				'description' => 'Size of the icon background.'
			)
		);


		//font-size
		$settings[] = array(
			'id'		=> 'msl-font-size',
			'title'		=> 'Size of the font: ',
			'callback'	=> 'render_small_number',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-font-size',
				'name'	=> 'msl_settings[font-size]',
				'value' => isset($msl_settings['font-size']) ? $msl_settings['font-size'] : '24',
				'class'	=> 'small-text',
				'type'	=> 'number',
				'unit'	=> '[px]',
				'slider_min'  => '10',
				'slider_max'  => '50',
				'description' => 'Size of the Font-Awesome icon.'
			)
		);

		//icon-spacing
		$settings[] = array(
			'id'		=> 'msl-icon-spacing',
			'title'		=> 'Icon spacing: ',
			'callback'	=> 'render_small_number',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-icon-spacing',
				'name'	=> 'msl_settings[icon-spacing]',
				'value' => isset($msl_settings['icon-spacing']) ? $msl_settings['icon-spacing'] : '2',
				'class'	=> 'small-text',
				'type'	=> 'number',
				'unit'	=> '[px]',
				'slider_min'  => '0',
				'slider_max'  => '20',
				'description' => 'Spacing between icons.'
			)
		);

		//hide-on-width
		$settings[] = array(
			'id'		=> 'msl-hide-on-width',
			'title'		=> 'Hide on width: ',
			'callback'	=> 'render_small_number',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-hide-on-width',
				'name'	=> 'msl_settings[hide-on-width]',
				'value' => isset($msl_settings['hide-on-width']) ? $msl_settings['hide-on-width'] : 0,
				'class'	=> 'small-text',
				'type'	=> 'number',
				'unit'	=> '[px]',
				'slider_min'  => '0',
				'slider_max'  => '2000',
				'step'		  => '10',
				'description' => 'Hides the plugin when browser width is less then value given here. 0 for no hidding.'
			)
		);

		// add no follow to links
		$settings[] = array(
			'id'		=> 'msl-add-nofollow',
			'title'		=> 'No follow links: ',
			'callback'	=> 'render_checkbox',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'	=> 'msl-add-nofollow',
				'name'	=> 'msl_settings[add-nofollow]',
				'value' 		  => (isset($msl_settings['add-nofollow'])) ? $msl_settings['add-nofollow'] : 1,
				'checkbox_value'  => 1,
				'description' => 'Adds <code>rel="external nofollow"</code> to all links.'
			)
		);

		//target blank
		$settings[] = array(
			'id'		=> 'msl-target-blank',
			'title'		=> 'Target _blank: ',
			'callback'	=> 'render_checkbox',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'		  	  => 'msl-target-blank',
				'name'		  	  => 'msl_settings[target-blank]',
				'value' 		  => (isset($msl_settings['target-blank'])) ? $msl_settings['target-blank'] : 1,
				'checkbox_value'  => 1,
				'description'	  => 'Adds <code>target="_blank"</code> to all links. Opens link in new window.'
			)
		);

		//include-fa
		$settings[] = array(
			'id'		=> 'msl-include-fa',
			'title'		=> 'Include FA: ',
			'callback'	=> 'render_checkbox',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'			  => 'msl-include-fa',
				'name'			  => 'msl_settings[include-fa]',
				'value' 		  => (isset($msl_settings['include-fa'])) ? $msl_settings['include-fa'] : 1,
				'checkbox_value'  => 1,
				'description' 	  => 'Include FontAwesome files (CSS and font). If your theme is already supporting FontAwesome, then you can (you should) disable it here.'
			)
		);

		//include-default-font
		$settings[] = array(
			'id'		=> 'msl-include-default-font',
			'title'		=> 'Include default font: ',
			'callback'	=> 'render_checkbox',
			'page'		=> 'musli-social-links',
			'section'	=> 'msl-section-general',
			'args'		=> array(
				'id'			  => 'msl-include-default-font',
				'name'			  => 'msl_settings[include-default-font]',
				'value' 		  => (isset($msl_settings['include-default-font'])) ? $msl_settings['include-default-font'] : 1,
				'checkbox_value'  => 1,
				'description' 	  => 'Include default font (Kalam) for links titles. If you want to use another font then you have to load it by yourself.'
			)
		);

		return $settings;

	}

	// -------------------------------------------------------------------

	public function sanitize_options($options)
	{
		$msl_settings = array(
			// radios
			'position' 				=> sanitize_text_field($options['position']),
			'theme' 				=> sanitize_text_field($options['theme']),

			// int expected
			'position-margin' 		=> absint($options['position-margin']),
			'icon-size' 			=> absint($options['icon-size']),
			'font-size' 			=> absint($options['font-size']),
			'icon-spacing' 			=> absint($options['icon-spacing']),
			'hide-on-width' 		=> absint($options['hide-on-width']),

			// checkboxes
			'add-nofollow' 			=> (isset($options['add-nofollow']) && $options['add-nofollow'] == 1) ? 1 : 0,
			'target-blank' 			=> (isset($options['target-blank']) && $options['target-blank'] == 1) ? 1 : 0 ,
			'include-fa' 			=> (isset($options['include-fa']) && $options['include-fa'] == 1) ? 1 : 0,
			'include-default-font' 	=> (isset($options['include-default-font']) && $options['include-default-font'] == 1) ? 1 : 0,
		);

		return $msl_settings;
	}

	// -------------------------------------------------------------------

	public function sanitize_links($options)
	{
		// dont bother if its not array
		if(!is_array($options)) return $options;

		foreach($options as $k => $link)
		{
			$options[$k]['url']   = sanitize_text_field($link['url']);
			$options[$k]['class'] = sanitize_html_class($link['class']);
			$options[$k]['title'] = sanitize_text_field($link['title']);
		}

		return $options;
	}

	// -------------------------------------------------------------------

	public function render_msl_dropdown($args)
	{
		extract($args); ?>
		
		<label for="<?php echo $id; ?>">
			<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
				<?php foreach ($options as $option): ?>
					<option value="<?php echo esc_html( $option ); ?>" <?php selected( $value, $option ); ?>><?php echo esc_html( $option ); ?></option>
				<?php endforeach ?>
			</select>
			<p class="description"><?php echo $description; ?></p>
		</label>

		<?php
	}

	// -------------------------------------------------------------------

	public function render_small_number($args)
	{
		extract($args); 
		$step = (isset($step)) ? $step : 1; ?>

		<label for="<?php echo $id; ?>">
			<div id="<?php echo $id; ?>-slider" class="msl-option-slider"></div>
			<input type="number" min="<?php echo $slider_min; ?>" max="<?php echo $slider_max; ?>" class="<?php echo esc_attr( $class ); ?>" id="<?php echo $id; ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_html( $value ); ?>">&nbsp;<?php echo $unit; ?><br />
			<p class="description"><?php echo $description; ?></p>
		</label>

		<script>
		jQuery(function(){
			jQuery( '#<?php echo $id; ?>-slider' ).slider({
				orientation: "horizontal",
				range: "min",
				max: <?php echo $slider_max; ?>,
				min: <?php echo $slider_min; ?>,
				step: <?php echo $step; ?>,
				value: <?php echo esc_html( $value ); ?>,
				slide: function(event, ui){
					jQuery('#<?php echo $id; ?>').val(ui.value);
				}
			});
			jQuery('#<?php echo $id; ?>').val(jQuery( "#<?php echo $id; ?>-slider" ).slider( "value" ));
			jQuery('#<?php echo $id; ?>').change(function () {
				var x = parseInt(jQuery(this).val());
				jQuery( "#<?php echo $id; ?>-slider" ).slider("value", x);
			});
		});
		</script>

	<?php
	}

	// -------------------------------------------------------------------

	public function render_msl_position($args)
	{
		extract($args); ?>

		<ul id="msl-position">
			<?php foreach ($options as $option): ?>
				<li>
					<label title="Musli position">
						<input type="radio" name="<?php echo $name; ?>" value="<?php echo esc_html ( $option ); ?>" <?php checked( $value, $option ); ?> />
						<?php echo esc_html( $option ); ?><br />
						<img src="<?php echo esc_url( MUSLI_SL_URL . 'img/musli-position-'.$option.'.png' ); ?>" alt="Musli position RIGHT" />
					</label>
				</li>
			<?php endforeach ?>
		</ul>
		
		<p class="description"><?php echo $description; ?></p>
	<?php
	}

	// -------------------------------------------------------------------

	public function render_checkbox($args)
	{
		extract($args);

		?>

		<label for="<?php echo $id; ?>">
			<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $checkbox_value; ?>" <?php checked( $checkbox_value, $value ); ?>>
			<span class="description"><?php echo $description; ?></span>
		</label>

	<?php
	}

	// -------------------------------------------------------------------

	public function render_select_options($args)
	{
		extract($args); ?>

		<label for="<?php echo $id; ?>">
			<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
				<?php foreach ($options as $option): ?>
					<option value="<?php echo esc_html( $option ); ?>" <?php selected( $value, $option ); ?>><?php echo esc_html( $option ); ?></option>
				<?php endforeach ?>
			</select>
			<p class="description"><?php echo $description; ?></p>
		</label>

	<?php
	}

	// -------------------------------------------------------------------

	public function render_text_input($args)
	{
		extract($args); ?>

		<label for="<?php echo $id; ?>">
			<input type="text" class="<?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_html( $value ); ?>">
			<p class="description"><?php echo $description; ?></p>
		</label>

	<?php
	}

	// -------------------------------------------------------------------

	public function render_msl_section_general()
	{
		?>

		<div id="msl-preview">
			<?php echo $this->generate_plugins_preview(); ?>
		</div>

		<?php
	}

	// -------------------------------------------------------------------

	public function generate_plugins_preview()
	{
		$msl_links = get_option('msl_links');

		$html = '<!-- Musli Social Links --><ul id="musli-social-links">'. "\r\n";
		
		foreach($msl_links as $link)
		{
			$html.= '<li class="msl-'.$link['class'].'"><a href="#">';
			$html.= '<i class="fa fa-'.$link['class'].'"></i>'.$link['title'];
			$html.= '</a></li>' . "\r\n";
		}

		$html .= '</ul><!-- http://wordpress.org/plugins/musli-social-links -->';

		return $html;
	}

	// -------------------------------------------------------------------
}
