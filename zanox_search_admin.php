<?php

/**
 * Implements the admin UI for the Zanox search plugin for the configuration
 * of search and display paramter.
 *
 * @see         http://webservices.zanox.com
 * @see         http://wiki.zanox.com/en/WebServices
 *
 * @category    WordPress plugin
 * @package		Zanox Search Plugin
 * @version 	2009-07-01
 * @copyright 	Copyright © 2007-2009 ZANOX.de AG
 */
class ZanoxSearchPluginAdmin
{
    /**
     * ConnectId for Zanox Web Service
     *
     * @var     string
     * @access  private
     */
    var $zws_application_id;

    /**
     * REST API version
     *
     * @var     string
     * @access  private
     */
    var $zws_version = "2009-07-01";

    /**
     * Boolean variable to validate application id
     *
     * @var     boolean
     * @access  private
     */
    var $set_check_application_id;



    /**
     * Constructor
     *
     * 1. Set hook for WordPress admin action
     * 2. Initialize properties
     *
     * @return ZanoxSearchPluginAdmin
     */
    function ZanoxSearchPluginAdmin ()
    {
        add_action('admin_menu', array(&$this, 'addhooks'));

        $this->_initProperties();
    }



    /**
     * Handle admin page
     *
     * 1. Handle input data
     * 2. Display admin interface with current configuration parameter
     */
    function show_admin_page ()
    {

        /**
         * Check if ConnectId is valid
         * (Usage of Zanox Web Services getPrograms resource)
         */
        if ($_POST['check_application_id'])
        {
            update_option('ZSP_application_id', $_POST['application_id']);
            $this->_initProperties();
            $this->set_check_application_id = $this->_checkApplicationID();
        }


        /**
         * Update configuration data with values from admin interface
         */
        if ($_POST['save_zanox_search_settings'] || $_POST['check_application_id'])
        {
            // Web Service API configuration paramter
            update_option('ZSP_application_id',     $_POST['application_id']);

            // Search paramter
            update_option('ZSP_region',             $_POST['sales_region']);
            update_option('ZSP_min_price',          $_POST['min_price']);
            update_option('ZSP_max_price',          $_POST['max_price']);
            update_option('ZSP_product_category',   $_POST['product_category']);
            update_option('ZSP_program',            $_POST['program']);

            // update_option('ZSP_ad_space',        $_POST['ad_space']);

            // Display options
            update_option('ZSP_display_images',     $_POST['display_images']);
            update_option('ZSP_ad_position',        $_POST['ad_position']);
            update_option('ZSP_max_products',       $_POST['max_products']);
        }


        /**
         * Update Zanox advertiser programs
         * (Usage of Zanox Web Services getPrograms resource)
         */
        if ($_POST['update_programs'])
        {
            $this->_updatePrograms();
        }



        /**
         * Display admin interface
         */
        $this->_display_admin_interface();
    }



    /**
     * Add Zanox search hooks to admin panel
     *
     */
    function addhooks ()
    {
        /**
         * If version > 2.1 add hook in sidebar
         */
        if (version_compare(get_bloginfo('version'), '2.7', '>'))
        {
            add_options_page('Zanox Search', 'Zanox Search', 10, __FILE__, array(&$this, 'show_admin_page'));
        }
    }





    /**************************************************************************


        PRIVATE FUNCTIONS


    **************************************************************************/

    /**
     * Render admin interface
     *
     */
    function _display_admin_interface ()
    {

        /**
         * Read configuration data from database
         */
        $_set_application_id    = get_option('ZSP_application_id');

        $_set_region_code       = get_option('ZSP_region');
        $_set_min_price         = get_option('ZSP_min_price');
        $_set_max_price         = get_option('ZSP_max_price');
        $_set_category_code     = get_option('ZSP_product_category');
        $_set_program_code      = get_option('ZSP_program');
        $_set_max_products      = get_option('ZSP_max_products');
        // $_set_space_code     = get_option('ZSP_ad_space');

        if (get_option('ZSP_display_images') != "")
        {
            $_set_display_images = get_option('ZSP_display_images');
        }
        else
        {
            $_set_display_images = 1;
        }

        if (get_option('ZSP_ad_position') != "")
        {
            $_set_ad_position = get_option('ZSP_ad_position');
        }
        else
        {
             $_set_ad_position = "top";
        }

	    if ($this->_getPrograms())
	    {
    	    $ZS_programs = $this->_sort($this->_getPrograms());
	    }

        if (isset($this->set_check_application_id))
        {
            $_set_check_application_id = $this->set_check_application_id;
        }

        /**
         * Include definitions
         */
        include ZANOX_SEARCH_CONFIG_DIR . 'zanox_definition.inc.php';
        $ZS_sales_regions = $this->_sort($ZS_sales_regions);

        /**
         * Show admin page template
         */
        include ZANOX_SEARCH_TEMPLATE_DIR . 'admin.inc.php';
    }



    /**
     * Get Zanox advertiser programs from database cache
     *
     * @return  mixed       $programs
     */
    function _getPrograms ()
    {
        return get_option('ZSP_programs');
    }



    /**
     * Update database cache with Zanox advertiser programs
     *
     */
    function _updatePrograms ()
    {
        require_once ZANOX_SEARCH_LIB_DIR . 'z_ws_client/zanox-api.class.php';

        $zx = new ZanoxAPI();
        $zx->setMessageCredentials($this->zws_application_id, "");
        $zx->setVersion($this->zws_version);

        $programs   = array();
        $fetch_more = true;
        $page       = 0;
        $items      = 10;

        do
        {
            /**
             * Get program informastion
             */
            $results = $zx->getPrograms(false, $page, $items);

            /**
             * Check if there was an error on receiving the information
             */
            if (isset($results['total']))
            {
                /**
                 * Get the total number of programs
                 */
                $number_programs = $results['total'];

                /**
                 * Calculate the total number of pages that need to be
                 * received
                 */
                $number_total_pages = ceil($number_programs/$items);

                $page++;

                /**
                 * Add program id and name into an internal array
                 */
                if (!empty($results['programitems']['programitem']))
                {
            	    foreach ($results['programitems']['programitem'] as $program)
            	    {
                	   $programs[$program['_attr']['id']] = $program['name'];
            	    }

            	    /**
                     * Update database with all current programs
                     */
                    update_option('ZSP_programs', $programs);
                }

                /**
                 * Check if last page is reached
                 */
                if ($page >= $number_total_pages)
                {
                    $fetch_more = false;
                }
            }
        }
        while ($fetch_more);
    }



    /**
     * Check if ConnectId is valid
     *
     * @return  boolean
     */
    function _checkApplicationID ()
    {
        require_once ZANOX_SEARCH_LIB_DIR . 'z_ws_client/zanox-api.class.php';

        $zx = new ZanoxAPI();
        $zx->setMessageCredentials($this->zws_application_id, false);
        $zx->setVersion($this->zws_version);

        $result = $zx->getPrograms(false, 1, 1);

        if ($result)
        {
            return true;
        }

        return false;
    }



    /**
     * Initialize the class properties for Web Service query
     *
     */
    function _initProperties ()
    {
        $this->zws_application_id = get_option('ZSP_application_id');
    }



    /**
     * Sort programs by name
     *
     * @param   mixed   $programs
     * @return  mixed   $programs
     */
    function _sort ( $programs )
    {
        if ($programs)
        {
    	    asort($programs);
        }

        return $programs;
    }

} // ZanoxSearchPluginAdmin

?>