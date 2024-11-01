<?php
/*
Plugin Name: 	Zanox Product Search
Plugin URI: 	http://www.zanox.com/store/wordpress/search_plugin
Description: 	This plugin integrates the Zanox advertiser product catalog items into the frontend search result list of your blog. The plugin checks against the Zanox Web Service API for suitable advertising programs, which are then displayed on the search result page. You need a Zanox Web Services ConnectId to use the plugin.
Version: 		1.7
Author: 		ZANOX.de AG
Author URI: 	http://www.zanox.com
Changes:		1.0

                Copyright 2009 Zanox (email : apps@zanox.com)

				This program is free software; you can redistribute it and/or modify
				it under the terms of the GNU General Public License as published by
				the Free Software Foundation; either version 2 of the License, or
				(at your option) any later version.

				This program is distributed in the hope that it will be useful,
				but WITHOUT ANY WARRANTY; without even the implied warranty of
				MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
				GNU General Public License for more details.

				You should have received a copy of the GNU General Public License
				along with this program; if not, write to the Free Software
				Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/


/**
 * Constant definition that are needed throughout the plugin
 *
 */
define	("ZANOX_SEARCH_BASE_DIR", 		dirname(__FILE__) . '/');
define  ("ZANOX_SEARCH_TEMPLATE_DIR", 	ZANOX_SEARCH_BASE_DIR . 'templates/');
define  ("ZANOX_SEARCH_CONFIG_DIR", 	ZANOX_SEARCH_BASE_DIR . 'config/');
define  ("ZANOX_SEARCH_LIB_DIR",        ZANOX_SEARCH_BASE_DIR . 'lib/');
define  ("ZANOX_SEARCH_TEMPLATE_DIR_", get_option('siteurl') . '/wp-content/plugins/zanox_search/templates/');

ini_set("display_errors", "true");


/**
 * Handle the different parts of the plugin
 *
 * Include the admin part only if the request comes from within the admin panel.
 * Otherwise include the frontend part.
 *
 * All actions and filters are set within the constructors of the according
 * classes.
 */
if (ereg('/wp-admin/', $_SERVER['REQUEST_URI']))
{
    /**
     * Handle plugin activation and deactivation
     */
    register_activation_hook( __FILE__, '__plugin_activation' );
    register_deactivation_hook( __FILE__, '__plugin_deactivation' );

    /**
     * If we are in the admin panel just load the admin class
     */
    require_once ZANOX_SEARCH_BASE_DIR . 'zanox_search_admin.php';
	$zanox_search_plugin_admin = new ZanoxSearchPluginAdmin();
}
else
{
    /**
     * If we are in the frontend add the frontend search part of the plugin
     */
    require_once ZANOX_SEARCH_BASE_DIR . 'zanox_search_frontend.php';
    $zanox_search_obj = & new ZanoxSearchFrontend();
}


/**
 * Called when plugin is activated
 *
 * Nothing to do yet.
 */
function __plugin_activation() {};


/**
 * Called when plugin is deactivated. Cleans up parameter, which have been set
 *
 */
function __plugin_deactivation()
{
    delete_option("ZSP_region");
    delete_option("ZSP_program");
    delete_option("ZSP_product_category");
    delete_option("ZSP_min_price");
    delete_option("ZSP_max_price");
    delete_option("ZSP_display_images");
    delete_option("ZSP_application_id");
    delete_option("ZSP_ad_position");
}

?>