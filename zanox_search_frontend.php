<?php

/**
 * Implements the product search on the Zanox Web Services API
 * and displays the results in the search results.
 *
 *
 * @see         http://webservices.zanox.com
 * @see         http://wiki.zanox.com/en/WebServices
 *
 * @category    WordPress plugin
 * @package		Zanox Search Plugin
 * @version 	2009-07-01
 * @copyright 	Copyright © 2007-2009 ZANOX.de AG
 */
class ZanoxSearchFrontend
{
    /**
     * Search string
     *
     * @var     string
     * @access  private
     */
    var $query = "";

    /**
     * ConnectId for Zanox Web Service
     *
     * @var     string
     * @access  private
     */
    var $zws_application_id = "";

    /**
     * Array with all possible filter options for product search
     *
     * @var     mixed
     * @access  private
     */
    var $zws_filter = "";

    /**
     * Default number of items to retrieve
     *
     * @var     integer
     * @access  private
     */
    var $zws_items = "4";

    /**
     * Index of selected page
     *
     * @var     integer
     * @access  private
     */
    var $zws_page = "0";

    /**
     * REST API version
     *
     * @var     string
     * @access  private
     */
    var $zws_version = "2009-07-01";

    /**
     * Ad position
     *
     * @var     string
     * @access  private
     */
    var $ad_position = "";

    /**
     * Display image
     *
     * @var     boolean
     * @access  private
     */
    var $display_images = true;

    /**
     * Program name for search query
     *
     * @var     string
     * @access  private
     */
    var $program_name = "";

    /**
     * Link to Ad
     *
     * @var     string
     * @access  private
     */
    var $ad_link = "";

    /**
     * Maximum number of products that should be displayed
     *
     * @var     integer
     * @access  private
     */
    var $max_products = 1;



    /**
     * Constructor
     *
     * 1. Initialize properties
     * 2. Set hooks for WordPress actions & filter
     */
    function ZanoxSearchFrontend ()
    {
        $this->_initProperties();

        /**
         * Actions that are needed to render the ads if there are no search
         * results
         */
        add_action('the_posts', array(&$this, 'addSearchEntry'));
        add_action('wp_footer', array(&$this, 'printJS'));

        /**
         * Decide which hook to use depending on the ad position configuration
         */
        if ($this->ad_position == "top")
        {
            add_action('loop_start',    array(&$this, 'addSearchItem'));
        }
        else
        {
            add_action('loop_end',    array(&$this, 'addSearchItem'));
        }
    }



    /**
     * Add Javascript to remove fake page entry from result page. It is printed
     * at the the end of the page, to ensure that the fake entry is already
     * rendered.
     */
    function printJS ()
    {
        echo '  <script>
                <!--
                    var content_obj = document.getElementById("content");
                    var h3_obj      = document.getElementById("post-100000000");
                    var div_obj     = h3_obj.parentNode;
                    content_obj.removeChild(div_obj);
                //-->
                </script>';
    }



    /**
     * Add Zanox product items to search result page
     *
     * @return  void
     */
    function addSearchItem ()
    {
        global $wp_query;

        $content    = "";
        $count      = 1;

        if (!empty($wp_query->query_vars['s']) && $wp_query->current_post != -1)
        {
            $products = $this->_getProduct($wp_query->query_vars['s']);

            if ($products)
            {
                /**
                 * Render zanox ad products
                 */
                foreach ($products['productitem'] as $product)
                {
                    if ($count <= $this->max_products)
                    {
                        $content .= $this->_prepareProductPage($product);
                        $count++;
                    }
                }
            }
            else
            {
                /**
                 * If no zanox ad products could be and no blog entries could be found
                 */
                if ($wp_query->post->ID == 100000000)
                {
                    $content .= '<h2 class="center">No posts found. Try a different search?</h2>';
                    $content .= get_search_form();
                }
            }
        }

        echo $content;
    }



    /**
     * Add fake page entry if there are no search results, because otherwise
     * loop_end and loop_start hook don't work.
     *
     * @param   mixed   $content
     * @return  mixed
     */
    function addSearchEntry ( $content )
    {
        if (count($content) == 0)
        {
            $page       = new stdClass();
            $page->ID   = 100000000;

            if (count($content) == 0)
            {
                $content[] = $page;
            }
        }

        return $content;
    }



    /**************************************************************************


        PRIVATE FUNCTIONS


    **************************************************************************/

    /**
     * Get product information from Zanox Web Service
     *
     * @param   string      $search_query
     * @return  mixed       $product_information
     */
    function _getProduct ( $search_query )
    {
        require_once ZANOX_SEARCH_LIB_DIR . 'z_ws_client/zanox-api.class.php';

        $zx = new ZanoxAPI();
        $zx->setMessageCredentials($this->zws_application_id, "");
        $zx->setVersion($this->zws_version);

        if ($this->max_products > $this->zws_items)
        {
            $this->zws_items = $this->max_products;
        }

        $products = $zx->searchProducts($search_query, $this->zws_filter, $this->zws_page, $this->zws_items);

        if (!$zx->getLastErrorMessage() && $products['total'] != 0)
        {
            return $products['productitems'];
        }

        return false;
    }



    /**
     * Prepare product page for displaying in the search result list
     *
     * @param   mixed       product_item
     * @return  string      content
     */
    function _prepareProductPage ( $product_item )
    {
        $ad_date        = date('l, F jS, Y');
        $ad_title       = $product_item['name'];

        $ad_description = $product_item['descriptionlong'];
        $ad_program     = $product_item['program'];
        $price          = "";
        $currency       = "";

        if (is_array($product_item['trackinglinks'][0]['trackinglink'][0]))
        {
            $ad_link = $product_item['trackinglinks'][0]['trackinglink'][0]['ppc'];
        }

        $image_url = false;

        if (!empty($product_item['image'][0]['large']))
        {
            $image_url = $product_item['image'][0]['large'];
        }
        if (!empty($product_item['image'][0]['medium']))
        {
            $image_url = $product_item['image'][0]['medium'];
        }
        if (!empty($product_item['image'][0]['small']))
        {
            $image_url = $product_item['image'][0]['small'];
        }

        if (!empty($product_item['price']))
        {
            $price = $product_item['price'];
        }

        if (!empty($product_item['currency']))
        {
            $currency = $product_item['currency'];
        }

        if ($image_url && $this->display_images)
        {
            $ad_image = "<a href='" . $ad_link . "'><div style='background-image: url(\"" . $image_url . "\"); background-repeat: no-repeat; float: right; width: 100px; height: 100px; margin: 0px 0px 10px 10px;' class='zx_prodpic'></div></a>";
        }

        include ZANOX_SEARCH_TEMPLATE_DIR . 'search_item.inc.php';

        return $search_item;
    }



    /**
     * Check if price is set and is numeric
     *
     * @param   string      $price
     * @return  boolean
     */
    function _checkPrice ( $price )
    {
        if ($price != "" && is_numeric($price))
        {
            return true;
        }

        return false;
    }



    /**
     * Initialize the class properties for Web Service query and display options
     *
     */
    function _initProperties ()
    {
        $min_price                  = get_option('ZSP_min_price');
        $max_price                  = get_option('ZSP_max_price');

        $this->zws_application_id   = get_option('ZSP_application_id');
        $this->ad_position          = get_option('ZSP_ad_position');
        $this->display_images       = get_option('ZSP_display_images');
        $this->max_products         = get_option('ZSP_max_products');

        if (get_option('ZSP_product_category') != "" && get_option('ZSP_product_category') != 0)
        {
            $this->zws_filter['category'] = get_option('ZSP_product_category');
        }

        if ($this->_checkPrice($min_price))
        {
            $this->zws_filter['minPrice'] = $min_price;
        }

        if ($this->_checkPrice($max_price))
        {
            $this->zws_filter['maxPrice'] = $max_price;
        }

        if (get_option('ZSP_region') != "ALL" && get_option('ZSP_region') != "")
        {
            $this->zws_filter['region'] = strtolower(get_option('ZSP_region'));
        }

        if (get_option('ZSP_program') != 0)
        {
            $this->zws_filter['programs'] = get_option('ZSP_program');
        }

        if (get_option('ZSP_display_images') != 0)
        {
            $this->zws_filter['hasImages'] = 'true';
        }
    }

} // ZanoxSearchFrontend