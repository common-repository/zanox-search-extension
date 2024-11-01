<?PHP


/**
 * The RESTful Zanox Web Services client class extends the parent factory
 * class with specific REST protocol-based methods and features.
 *
 * @category    Web Services
 * @package		zanox_API
 * @version 	2009-07-01
 * @copyright 	Copyright © 2007-2009 ZANOX.de AG
 *
 */
class zanoxAPI
{

    /**
     * RESTful action.
     *
     * Representational State Transfer might be either
     * GET, POST, PUT or DELETE.
     *
     * @var     string
     * @access  private
     */
    var $rest_action = 'GET';

    /**
     * REST protocol interface.
     *
     * @var     string
     * @access  private
     */
    var $host = 'api.zanox.com';

    /**
     * Content type.
     *
     * @var     string
     * @access  private
     */
    var $content_type = 'text/xml';

    /**
     * Raw xml data return is disabled by default.
     *
     * @var     boolean
     * @access  private
     */
    var $raw_data_disabled = true;

    /**
     * Serializer class instance.
     *
     * @var     string
     * @access  private
     */
    var $serialize = false;

    /**
     * HTTP request class instance.
     *
     * @var     string
     * @access  private
     */
    var $request = false;

    /**
     * zanox API applicationId
     *
     * @var     string      $application_id         application id from zanox
     *
     * @access  public
     */
    var $application_id = '';

    /**
     * zanox API shared secret key
     *
     * @var     string      $shared_key             secret key to sign messages
     * @access  public
     */
    var $shared_key = '';

    /**
     * Timestamp of the message
     *
     * @var     string      $timestamp              timestamp to sign the message
     * @access  public
     */
    var $timestamp = false;

    /**
     * zanox API version
     *
     * @var     string      $version                zanox API version
     * @access  public
     */
    var $version = false;

    /**
     * API security mode.
     *
     * @var     boolean
     * @access  private
     */
    var $api_security = false;



	/**
	 * Retrieve a single zanox advertiser program item.
	 *
	 * @access     public
	 *
	 * @param      int         $program_id     id of program to retrieve
	 *
	 * @return     array                       program item or false
	 *
	 * @annotation(secure => false, paging => false)
	 */
    function getProgram ( $program_id )
    {
        $resource = array('programs', 'program', $program_id);

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	if ( $result = $this->_sendRequest($resource) ){
        	return $result;
    	}

    	return false;
    }



	/**
	 * Get all zanox advertiser programs.
	 *
	 * @access     public
	 *
	 * @param      int         $category_id    filter result by program category
	 * @param      int         $page           page of result set
	 * @param      int         $items          items per page
	 *
	 * @return     array                       programs result set or false
	 *
	 * @annotation(secure => false, paging => true)
	 */
    function getPrograms ( $category_id = false, $page = 0, $items = 10 )
    {
        if ( $category_id ){
            $resource = array('programs', 'category', $category_id);
        }
        else {
            $resource = array('programs');
        }

        $query = array('page' => $page, 'items' => $items);

        $this->_setHTTPVerb('GET');
        $this->enableAPISecurity();

    	if ( $result = $this->_sendRequest($resource, $query) ){
        	return $result;
    	}

    	return false;
    }



	/**
	 * Search zanox advertiser programs.
	 *
	 * @access     public
	 *
	 * @param      string      $q              search string
	 * @param      int         $page           page of result set
	 * @param      int         $items          items per page
	 *
	 * @return     array                       programs result set or false
	 *
	 * @annotation(secure => false, paging => true)
	 */
    function searchPrograms ( $q, $page = 0, $items = 10 )
    {
        $resource = array('programs');
        $query   = array('q' => $q, 'page' => $page, 'items' => $items);

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	$result = $this->_sendRequest($resource, $query);

    	return $result;
    }



	/**
	 * Method returns the last 20 advertiser program news.
	 *
	 * @access     public
	 *
	 * @return     array                       program news result set or false
	 *
	 * @annotation(secure => false, paging => false)
	 */
    function getProgramNews ()
    {
        $resource = array('programs', 'news');

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	$result = $this->_sendRequest($resource);

    	return $result;
    }



	/**
	 * Get advertiser program categories.
	 *
	 * Categories can be used to filter programs by a specific category.
	 *
	 * @access     public
	 *
	 * @return     array                       category result set or false
	 *
	 * @annotation(secure => false, paging => false)
	 */
    function getProgramCategories ()
    {
        $resource = array('programs', 'categories');

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	$result = $this->_sendRequest($resource);

    	return $result;
    }



	/**
	 * Get a single product.
	 *
	 * @access     public
	 *
	 * @param      string      $zup_id         zanox unified product id
	 *
	 * @return     array                       single product item or false
	 *
	 * @annotation(secure => false, paging => false)
	 */
    function getProduct ( $zup_id )
    {
        $resource = array('products', 'product', $zup_id);

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	if ( $result = $this->_sendRequest($resource) ){
    	    return $result;
    	}

    	return false;
    }



	/**
	 * Get products by advertiser program.
	 *
	 * Sample usage:
	 * <code>
	 *
	 *     $zx = ZanoxAPI::factory('xml');
	 *
	 *     $filter = array(
	 *         'adspace' => '12233',             // return only tracking links for this adspace
	 *         'modified' => '2007-01-04'        // only return modified product data sets
	 *     );
	 *
	 *     // keyword search
	 *     $zx->getProductsByProgram( 1212 , $filter);
	 *
	 * </code>
	 *
	 * @access     public
	 *
	 * @param      int         $program_id     advertiser program id
	 * @param      array       $filter         additional filter parameter
	 * @param      int         $page           page of result set
	 * @param      int         $items          items per page
     *
	 * @return     array                       product result set or false
	 *
	 * @annotation(secure => false, paging => true)
	 */
    function getProductsByProgram ( $program_id, $filter = false, $page = 0, $items = 10 )
    {
        if ( !empty($filter['adspace']) ){
            $resource = array('products', 'program', $program_id, 'adspace', $filter['adspace']);
        }
        else {
            $resource = array('products', 'program', $program_id);
        }

        $query = array('page' => $page, 'items' => $items);

        if ( !empty($filter['modified']) ){
            $query['modified'] = $filter['modified'];
        }

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	if ( $result = $this->_sendRequest($resource, $query) ){
    	    return $result;
    	}

    	return false;
    }



	/**
	 * Search for products.
	 *
	 * This function can be used in two different ways. If the search phrase
	 * exceeds a word count of 5 it returns the result based on a n-gram
	 * matching. If the search phrase word count is below 10 an ordinary
	 * keyword search index match is returned.
	 *
	 * N-Gram indicies are for contextual matching. To make use of this feature
	 * please provide the whole web page document that needs to be analysed.
	 *
	 * Sample usage:
	 * <code>
	 *
	 *     $zx = ZanoxAPI::factory('xml');
	 *
	 *     $filter = array(
	 *         'adspace' => '12233',       // return only tracking links for this adspace
	 *         'region' => 'en',           // filter by sales region
	 *         'minprice => '10',          // return only products with > minprice
	 *         'maxprice => '50'           // return only products with < maxprice
	 *         'ip' => 'xxx.xxx.xxx.xxx'   // filtering by region by ip address
	 *     );
	 *
	 *     // keyword search
	 *     $zx->searchProducts( 'iphone', $filter);
	 *
	 *     // n-gram search
	 *     $zx->searchProducts( 'more than five words uses zanox n-gram search' );
	 *
	 * </code>
	 *
	 * @access     public
	 *
	 * @param      string      $q              search string
	 * @param      array       $filter         additional filter parameter
	 * @param      int         $page           page of result set
	 * @param      int         $items          items per page
	 *
	 * @return     array                       product result set or false
	 *
	 * @annotation(secure => false, paging => true)
	 */
    function searchProducts ( $q, $filter = false, $page = 0, $items = 10 )
    {
        if ( !empty($filter['adspace']) ){
            $resource = array('products', 'adspace', $filter['adspace']);
        }
        else {
            $resource = array('products');
        }

        $query = array('q' => $q, 'page' => $page, 'items' => $items);

        if ( !empty($filter['region']) && strlen($filter['region']) == 2 ){
            $query['region'] = $filter['region'];
        }

        if ( !empty($filter['minPrice'])){
            $query['minprice'] = $filter['minPrice'];
        }

        if ( !empty($filter['maxPrice'])){
            $query['maxprice'] = $filter['maxPrice'];
        }

        if ( !empty($filter['programs'])){
            $query['programs'] = $filter['programs'];
        }

        if ( !empty($filter['category'])){
            $query['category'] = $filter['category'];
        }

        if ( !empty($filter['ip']) ){
            $query['ip'] = $filter['ip'];
        }

        if ( !empty($filter['hasImages']) ){
            $query['hasimages'] = $filter['hasImages'];
        }

        $this->_setHTTPVerb('GET');
        $this->enableAPISecurity();

    	if ( $result = $this->_sendRequest($resource, $query) )
    	{
    	    return $result;
    	}

    	return false;
    }



	/**
	 * Get a single admedium.
	 *
	 * @access     public
	 *
	 * @param      string      $admedium_id    advertising medium id
	 *
	 * @return     array                       single product item or false
	 *
	 * @annotation(secure => false, paging => false)
	 */
    function getAdmedium ( $admedium_id )
    {
        $resource = array('admedia', 'admedium', $admedium_id);

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	if ( $result = $this->_sendRequest($resource) ){
    	    return $result;
    	}

    	return false;
    }



	/**
	 * Get all advertiser program advertising media items.
	 *
	 * The retrieved admedium items can be filtered by program category
	 * and admedium type.
	 *
	 * Note: The admedium categories are specific to each advertiser program.
	 *
	 * Supported admedium types are
	 *
     *    801: Text
     *    802: Image
     *    803: Image with text
     *    804: HTML (may also include Flash)
     *    805: Script (may also include Flash)
	 *
	 * Sample usage:
	 * <code>
	 *
	 *     $zx = ZanoxAPI::factory('xml');
	 *
	 *     $filter = array(
	 *         'category' => '1',            // return only items from this program category
	 *         'type' => '802'               // return only items of this admedium type
	 *     );
	 *
	 *     $zx->getAdmediaByProgram( 1212 , $filter);
	 *
	 * </code>
	 *
	 * @access     public
	 *
	 * @param      int         $program_id     advertiser program id
	 * @param      array       $filter         additional filter parameter
	 * @param      int         $page           page of result set
	 * @param      int         $items          items per page
     *
	 * @return     array                       admedia result set or false
	 *
	 * @annotation(secure => false, paging => true)
	 */
    function getAdmediaByProgram (  $program_id, $filter = false, $page = 0, $items = 10 )
    {
        if ( !empty($filter['category']) ){
            $resource = array('admedia', 'program', $program_id, 'category', $filter['category']);
        }
        elseif ( !empty($filter['type']) ) {
            $resource = array('admedia', 'program', $program_id, 'type', $filter['type']);
        }
        else {
            $resource = array('admedia', 'program', $program_id);
        }

        $query = array('page' => $page, 'items' => $items);

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	if ( $result = $this->_sendRequest($resource, $query) ){
    	    return $result;
    	}

    	return false;
    }



	/**
	 * Get admedia categories for a specific advertiser program.
	 *
	 * @access     public
	 *
	 * @param      int         $program_id     advertiser program id
	 *
	 * @return     array                       advertiser admedia categories or false
	 *
	 * @annotation(secure => false, paging => false)
	 */
    function getAdmediaCategoriesByProgram (  $program_id )
    {
        $resource = array('admedia', 'program', $program_id, 'categories');

        $this->_setHTTPVerb('GET');
        $this->disableAPISecurity();

    	if ( $result = $this->_sendRequest($resource) ){
    	    return $result;
    	}

    	return false;
    }



    /**
	 * Returns the current REST timestamp.
	 *
	 * If there hasn't already been set a datetime we create one automatically.
	 * As a format the HTTP Header protocol RFC format is taken.
	 *
	 * @see        see HTTP RFC for the datetime format
	 *
	 * @access     public
	 *
	 * @return     string                      message timestamp
	 */
	function getTimestamp ( )
    {
        if ( !$this->timestamp ){
            $this->timestamp = gmdate('D, d M Y H:i:s T');
        }

        return $this->timestamp;
    }



    /**
	 * Enables raw data return.
	 *
	 * If enabled the methods return plain xml.
	 *
	 * @access     public
	 *
	 * @return     string                      message timestamp
	 */
    function enableRawData()
    {
        $this->raw_data_disabled = false;
    }


	/**
	 * Sets the Message Credentials.
	 *
	 * @access     public
	 * @final
	 *
	 * @param      string      $application_id     your application id
	 * @param      string      $shared_key         your shared key
	 *
	 * @return     string                          returns http response
	 */
	function setMessageCredentials ($application_id, $shared_key)
	{
		$this->application_id = $application_id;
		$this->shared_key     = $shared_key;
	}



	/**
	 * Encodes the given message parameters with Base64.
	 *
	 * @param      string          $str            string to encode
	 *
	 * @return                                     encoded string
	 *
	 * @access     public
	 * @final
	 */
	function encodeBase64( $str )
	{
	    $encode = '';

	    for ($i=0; $i < strlen($str); $i+=2){
	        $encode .= chr(hexdec(substr($str, $i, 2)));
	    }

	    return base64_encode($encode);
	}



	/**
	 * Creates secured HMAC signature of the message parameters.
	 *
	 * Uses the hash_hmac function if available (PHP needs to be >= 5.1.2).
	 * Otherwise it uses the PEAR/CRYP_HMAC library to sign and crypt the message.
	 * Make sure you have at least one of the options working on your system.
	 *
	 * @param      string      $message            message to sign
	 *
	 * @return     string                          signed sha1 message hash
	 *
	 * @access     public
	 * @final
	 */
	function getHMACSignature( $mesgparams )
	{
        if ( function_exists('hash_hmac') ) {
			$hmac = hash_hmac('sha1', utf8_encode($mesgparams), $this->shared_key);
			$hmac = $this->encodeBase64($hmac);
		} else {
			require_once 'Crypt/HMAC.php';

			$hashobj = new Crypt_HMAC($this->shared_key, "sha1");
			$hmac = $this->encodeBase64($hashobj->hash(utf8_encode($mesgparams)));
		}

		return $hmac;
	}



	/**
	 * Sets the message timestamp.
	 *
	 * @param      string      $timestamp          message timestamp to use
	 *
	 * @return     void
	 *
	 * @access     public
	 * @final
	 */
	function setTimestamp ( $timestamp )
	{
		$this->timestamp = $timestamp;
	}



	/**
	 * Sets the API version to use.
	 *
	 * @param      string      $version            API version (e.g. 2008-05-21)
	 *
	 * @return     void
	 *
	 * @access     public
	 * @final
	 */
	function setVersion ( $version )
	{
		$this->version = $version;
	}



	/**
	 * Sets the message timestamp.
	 *
	 * @param      string      $timestamp          message timestamp to use
	 *
	 * @return     void
	 *
	 * @access     public
	 *
	 * @final
	 */
	function getApplicationId()
	{
	    return $this->application_id;
	}



	/**
	 * Get last API error message response.
	 *
	 * @return     string or object                error message
	 *
	 * @access     public
	 *
	 * @final
	 */
	function getLastErrorMessage()
	{
	    return $this->last_error_msg;
	}



	/**
	 * Enables the API authentication.
	 *
	 * Authentication is only required and therefore enabled for some privacy related
	 * functions like accessing your profile or reports.
	 *
	 * @access     private
	 *
	 * @return     void
	 */
	function enableAPISecurity ()
    {
        $this->api_security = true;
    }



	/**
	 * Enables the API authentication.
	 *
	 * Authentication is only required and therefore enabled for some privacy related
	 * functions like accessing your profile or reports.
	 *
	 * @access     private
	 *
	 * @return     void
	 */
	function disableAPISecurity ()
    {
        $this->api_security = false;
    }



    /**
	 * Disable raw data return.
	 *
	 * If disabled the methods return array items.
	 *
	 * @access     public
	 *
	 * @return     string                      message timestamp
	 */
    function disableRawData()
    {
        $this->raw_data_disabled = true;
    }



	/**
	 * Sets the HTTP RESTful action verb.
	 *
	 * The given action might be GET, POST, PUT or DELETE. Be aware
	 * that no any action can be performed on any resource.
	 *
	 * @access     private
	 *
	 * @param      string      $action         http action verb
	 *
	 * @return     void
	 */
	function _setHTTPVerb ( $action )
    {
        $this->rest_action = strtoupper($action);
    }



	/**
	 * Returns the HTTP RESTful action verb (GET/POST/PUT/DELETE).
	 *
	 * @access     public
	 *
	 * @return     string                      http action verb
	 */
	function _getHTTPVerb ()
    {
        return $this->rest_action;
    }



	/**
	 * Performs REST request.
	 *
	 * The function creates the RESTful request URL out of the given resource URI
	 * and the given REST interface.  A REST URI for example to request a program
	 * with the id 49 looks like this: /programs/program/49
	 *
	 * @access     private
	 *
	 * @param      array       $resource       RESTful resource e.g. /programs
	 * @param      array       $query          HTTP query parameter e.g. /programs?q=telecom
	 * @param      string      $body           HTTP xml body message
	 *
	 * @return     string      $result         returns http response
	 *
	 */
	function _sendRequest ( $resource, $query = false, $body = false )
	{
		$version  = false;
		$uri_path = "/" . implode("/", $resource);


        if ( is_array($query) ){
		    $uri_path = $uri_path . '?' . $this->_http_build_query($query);
		}

		$uri_path .= "&connectid=" . $this->getApplicationId();

        if ( $this->version ){
            $version =  "/". $this->version;
        }

        $result = $this->http_request($this->host, $this->rest_action, '/xml' . $version . $uri_path, $body);

        if ( $result )
        {
            if ( $this->raw_data_disabled ){
        	    $result = $this->_unserialize($result);
        	}

    		return $result;
        }

	    return false;
	}


    function _http_build_query($data, $prefix='', $sep='', $key='')
    {
        $ret = array();

        foreach ((array)$data as $k => $v)
        {
            if (is_int($k) && $prefix != null)
            {
                $k = urlencode($prefix . $k);
            }

            if ((!empty($key)) || ($key === 0))
            {
                $k = $key.'['.urlencode($k).']';
            }

            if (is_array($v) || is_object($v))
            {
                // array_push($ret, http_build_query($v, '', $sep, $k));
                array_push($ret, $k . '=' . implode(",", $v));
            }
            else
            {
                array_push($ret, $k.'='.urlencode($v));
            }
        }

        if (empty($sep)) $sep = ini_get('arg_separator.output');

        return implode($sep, $ret);
    }


	/**
	 * HTTP REST Connection (GET/POST)
	 *
	 * @access         private
	 *
	 * @param          string      $host           request hostname
	 * @param          string      $method         request method (POST/GET)
	 * @param          string      $path           request path
	 * @param          string      $data           POST data
	 *
	 * @return         mixed                       response data or false
	 */
    function http_request( $host, $method, $path, $data = false )
    {
        $method = strtoupper($method);

        $fp = fsockopen($host, 80, $errorNumber, $errorString);

        if ( !$fp )
        {
            return false;
        }

        $requestHeader  = $method . " " . $path . " HTTP/1.1\r\n";
        $requestHeader .= "Host: " . $host . "\r\n";
        $requestHeader .= "User-Agent: zanox PHP API Client\r\n";

		$timestamp = $this->getTimestamp();

		$requestHeader .= "Date: $timestamp\r\n";

		if ( $this->api_security )
		{
            $shash = $this->_buildSignature($uri_path, $timestamp);
    		$authorization = "ZXWS " . $this->getApplicationId() . ":" . $shash;
		}
        else
        {
            $authorization = "ZXWS " . $this->getApplicationId();
        }

        $requestHeader .= "Authorization: ". $authorization. "\r\n";

        if ( $method == "POST" )
        {
            $requestHeader .= "Content-Type: " . $this->content_type . "\r\n";
            $requestHeader .= "Content-Length: " . strlen($data) . "\r\n";
        }

        $requestHeader .= "Connection: close\r\n\r\n";

        if ($method == "POST")
        {
            $requestHeader .= $data;
        }

        fwrite($fp, $requestHeader);

        $responseHeader  = '';
        $responseContent = '';

        do
        {
            $responseHeader .= fread($fp, 1);
        }
        while (!preg_match('/\\r\\n\\r\\n$/', $responseHeader));

        if ( $this->_check_header($responseHeader) )
        {

            if (!strstr($responseHeader, "Transfer-Encoding: chunked"))
            {
                while (!feof($fp))
                {
                    $responseContent .= fgets($fp, 128);
                }
            }
            else
            {

                while ( $chunk_length = hexdec(fgets($fp)) )
                {
                    $responseContentChunk = '';

                    $read_length = 0;

                    while ( $read_length < $chunk_length )
                    {
                        $responseContentChunk .= fread($fp, $chunk_length - $read_length);
                        $read_length = strlen($responseContentChunk);
                    }

                    $responseContent .= $responseContentChunk;

                    fgets($fp);

                }

            }

            return chop($responseContent);
        }

        return false;
    }



	/**
	 * Returns if http response is valid.
	 *
	 * Method checks if request response returns HTTP status code 200
	 * or not. If the status code is different from 200 the method
	 * returns false.
	 *
	 * @access     private
	 *
	 * @param      string      $uri        request uri
	 * @param      string      $uri        request uri
	 *
	 * @return     string                  encoded string
	 */
    function _check_header ( $response_header )
    {
        $header = explode("\n", $response_header);

        if ( count($header) > 0 )
        {
            $status_line = explode(" ", $header[0]);

            if ( count($status_line) >= 3 && $status_line[1] == '200' )
            {
                return true;
            }
        }

        return false;
    }



	/**
	 * Returns the crypted hash signature for the message.
	 *
	 * Builds the signed string consisting of the rest action verb, the uri used and
	 * the timestamp of the message. Be aware of the 15 minutes timeframe when setting
	 * the time manually.
	 *
	 * @access     private
	 *
	 * @param      string      $uri        request uri
	 * @param      string      $uri        request uri
	 *
	 * @return     string                  encoded string
	 */
	function _buildSignature ( $uri, $timestamp )
    {
        $rest_action = $this->_getHTTPVerb();

        $sign = $rest_action . $uri . $timestamp;

        if ( $hmac = $this->getHMACSignature($sign) )
        {
            return $hmac;
        }

        return false;
    }



    /**
	 * Unserialize XML to array.
	 *
	 * @param      string      $xml            xml data to serialize
	 *
	 * @access     private
	 *
	 * @return     array                       array or false
	 */
    function _unserialize( $xml )
    {
        $result = $this->parse_xml($xml);

        if (isset($result['response']))
            return $result['response'];


        return false;
    }




    /**
	 * Transforms XML into Array Structure.
	 *
	 * @param      dom object     $xml           xml data to serialize
	 *
	 * @access     private
	 *
	 * @return     array                         array or false
	 */
    function parse_xml( $xml )
    {
        $p = xml_parser_create('UTF-8');

        xml_parser_set_option($p, XML_OPTION_SKIP_WHITE, 1);

        if (xml_parse_into_struct($p, $xml, $values, $index))
        {
            xml_parser_free($p);

            $level = 0;
            $return = array();

            foreach ($values as $key => $value)
            {
                if ($value['type'] == 'open')
                {
                    $level++;

                    $open[$level] = strtolower($value['tag']);
                    if (isset($value['attributes']))
                    {
                        foreach ( $value['attributes'] as $k => $v)
                        {
                            $return[$level]['_attr'][strtolower($k)] = $v;
                        }
                    }

                }
                else if ($value['type'] == 'close')
                {
                    $tmp  = $return[$level];
                    $item = $open[$level];

                    $level--;

                    if (count($index[$value['tag']]) > 2)
                    {
                        $return[$level][$item][] = $tmp;
                    }
                    else
                    {
                        $return[$level][$item] = $tmp;
                    }

                    foreach (array_keys($tmp) as $key)
                    {
                    	unset($return[ $level + 1 ][$key]);
                    }
                }
                else
                {
                    $tag = strtolower($value['tag']);

                    if ( isset($value['value']) )
                    {
                        if ( !isset($return[$level][$tag]) )
                        {
                            $return[$level][$tag] = $value['value'];
                        }
                        else
                        {
                            if ( !is_array($return[$level][$tag]) )
                            {
                                $tmp = $return[$level][$tag];

                                $return[$level][$tag] = array();
                                $return[$level][$tag][] = $tmp;
                            }

                            $return[$level][$tag][] = $value['value'];
                        }
                    }
                    else
                    {
                        $return[$level][$tag][] = false;
                    }
                }

            }

            return $return[0];
        }

        return false;
    }


} // end class

?>