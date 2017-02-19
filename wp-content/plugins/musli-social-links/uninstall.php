<?php
/**
 * Musli Social Links Uninstall
 *
 * Cleans all plugins data
 */
if ( !defined('WP_UNINSTALL_PLUGIN') ) exit();

delete_option('msl_version');
delete_option('msl_links');
delete_option('msl_settings');
