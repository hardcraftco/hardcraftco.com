<?php

/* Fired during plugin activation */
class MSL_On_Activate
{
	public static function activate()
	{
		// check if we are dealing with fresh installation
		if ( ! get_option( 'msl_version' ) )
		{
			// insert demo data do database
			self::insert_demo_data();

			// save current version in database
			update_option('msl_version', MUSLI_SL_VERSION);
		}
	}

	// -------------------------------------------------------------------

	public static function insert_demo_data()
	{
		$msl_links = array(
			array(
				'class' => 'facebook',
				'url' => 'http://facebook.com',
				'title' => 'Like us on Facebook'
			),
			array(
				'class' => 'twitter',
				'url' => 'http://twitter.com',
				'title' => 'Follow us on Twitter'
			)
		);

		update_option( 'msl_links', $msl_links );
	}

}
