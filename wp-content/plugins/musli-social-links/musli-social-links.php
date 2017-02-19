<?php
/**
 * Plugin Name:  Musli Social Links
 * Description:  Floating social icons. It's a little feature that will make your site looks richer, cooler and more interesting. It is also a great tool for promoting your social network profiles.
 * Version:      1.0
 * Author:       ziemekpr0
 * Author Email: ziemekpr0@gmail.com
 * Author URI:   http://wpadmin.pl
 * License:      GPLv2 or later
 */

/* Security check - block direct access */
if (!defined('ABSPATH')) exit('No direct script access allowed');

/* Paths and constants */
define('MUSLI_SL_DIR_NAME', 'musli-social-links');
define('MUSLI_SL_DIR_PATH', plugin_dir_path(__FILE__));
define('MUSLI_SL_URL', plugin_dir_url(__FILE__));
define('MUSLI_SL_VERSION', '1.0');


/* Musli Social Links */
class Musli_Social_Links
{
	private $msl_settings;

	public function __construct()
	{
		// Get settings
		$this->msl_settings = get_option('msl_settings');

		/* Enqueue frontend scripts */
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_frontend_scripts'));

		/* Generate frontend CSS */
		add_action('wp_head', array(&$this, 'generate_css'));

		/* Generate frontend HTML */
		add_action('wp_footer', array(&$this, 'generate_html'));

		/* Load Admin Stuff if needed */
		if(is_admin())
		{
			require_once( MUSLI_SL_DIR_PATH . 'inc/class-msl-admin.php' );
			new MSL_Admin();
		}
	}

	// -------------------------------------------------------------------

	public function enqueue_frontend_scripts()
	{
		// main stylesheet
		wp_enqueue_style( 'msl-style', MUSLI_SL_URL . '/css/musli-social-links.css', array(), null );

		// include FontAwesome only if its needed
		if(!isset($this->msl_settings['include-fa']) || $this->msl_settings['include-fa'] == 1)
			wp_enqueue_style( 'msl-fontawesome', MUSLI_SL_URL . 'css/font-awesome.min.css', array(), NULL );

		// include my custom font only if its needed
		if(!isset($this->msl_settings['include-default-font']) || $this->msl_settings['include-default-font'] == 1)
			wp_enqueue_style( 'msl-kalam', '//fonts.googleapis.com/css?family=Kalam:700&subset=latin,latin-ext', array(), null );
	}

	// -------------------------------------------------------------------

	public function generate_html()
	{
		$msl_links = get_option('msl_links');

		//dont bother it theres no links
		if(!is_array($msl_links)) return;

		$position = (isset($this->msl_settings['position']) && $this->msl_settings['position'] == 'left') ? 'msl-left' : '';
		$theme = (isset($this->msl_settings['theme'])) ? ' '.$this->msl_settings['theme'] : ' msl-theme-default';
		$nofollow = (isset($this->msl_settings['add-nofollow']) && $this->msl_settings['add-nofollow'] == 1) ? ' rel="external nofollow"' : '';
		$target = (isset($this->msl_settings['target-blank']) && $this->msl_settings['target-blank'] == 1) ? ' target="_blank"' : '';

		$html = '<!-- Musli Social Links --><ul id="musli-social-links" class="'.$position.$theme.'">'. "\r\n";
		
		foreach($msl_links as $k => $link)
		{
			$html.= '<li class="msl-'.$link['class'].'"><a href="'.$link['url'].'"'.$nofollow.$target.'>';
			$html.= '<i class="fa fa-'.$link['class'].'"></i>'.$link['title'];
			$html.= '</a></li>' . "\r\n";
		}

		$html .= '</ul><!-- http://wordpress.org/plugins/musli-social-links -->';

		echo $html;
	}

	// -------------------------------------------------------------------

	public function generate_css()
	{

		$css = '<style type="text/css">/* Musli Social Links CSS */';

		// position margin
		if(isset($this->msl_settings['position-margin'])) {
			$css .= '#musli-social-links {top: '. $this->msl_settings['position-margin'] .'%;}';
		}

		//icon-size
		if(isset($this->msl_settings['icon-size'])) {
			$css .= '#musli-social-links li > a > i {' .
				'width: '. $this->msl_settings['icon-size'] .'px; ' .
				'height: '. $this->msl_settings['icon-size'] .'px; ' .
				'line-height: '. $this->msl_settings['icon-size'] .'px;}';

			$css .= '#musli-social-links > li > a {line-height: '. $this->msl_settings['icon-size'] .'px;}';
			$css .= '#musli-social-links > li {height: '. $this->msl_settings['icon-size'] .'px;}';
		}

		//font-size
		if(isset($this->msl_settings['font-size'])) {
			$css .= '#musli-social-links li a i {font-size: '. $this->msl_settings['font-size'] .'px;}';
		}

		//icon-spacing
		if(isset($this->msl_settings['icon-spacing'])) {
			$css .= '#musli-social-links li {margin-bottom: '. $this->msl_settings['icon-spacing'] .'px;}';
		}

		//hide-on-width
		if(isset($this->msl_settings['hide-on-width'])) {
			$css .= '@media screen and (max-width: '. $this->msl_settings['hide-on-width'] .'px) {#musli-social-links {display: none!important;}}';
		}

		$css .= '</style>';

		echo $css;
	}

	// -------------------------------------------------------------------

}

new Musli_Social_Links;

/* Stuff to do when activated */
function activate_msl()
{
	require_once( MUSLI_SL_DIR_PATH . 'inc/class-msl-on-activate.php' );
	MSL_On_Activate::activate();
}

register_activation_hook( __FILE__, 'activate_msl' );
