<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This file is part of the PEAR Services_Gravatar package.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to the MIT license that is available
 * through the world-wide-web at the following URI:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Services
 * @package   Services_Gravatar
 * @author    David Jean Louis <izi@php.net>
 * @copyright 2008-2009 David Jean Louis
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @version   CVS: $Id$
 * @link      http://pear.php.net/package/Services_Gravatar
 * @link      http://en.gravatar.com/site/implement/
 * @since     File available since release 0.1.0
 * @filesource
 */

/**
 * Dependencies.
 */
require_once 'Services/Gravatar/Exception.php';

/**
 * PHP5 interface to {@link http://www.gravatar.com Gravatar} service.
 *
 * @category  Services
 * @package   Services_Gravatar
 * @author    David Jean Louis <izi@php.net>
 * @copyright 2008-2009 David Jean Louis
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/Services_Gravatar
 * @link      http://en.gravatar.com/site/implement/
 * @since     Class available since release 0.1.0
 */
class Services_Gravatar
{
    // constants {{{

    /**#@+
     * Rating constants, default is RATING_G.
     */
    const RATING_G  = 'g';
    const RATING_PG = 'pg';
    const RATING_R  = 'r';
    const RATING_X  = 'x';
    /**#@-*/

    /**#@+
     * Default image types.
     */
    const DEFAULT_IDENTICON = 'identicon';
    const DEFAULT_MONSTERID = 'monsterid';
    const DEFAULT_WAVATAR   = 'wavatar';
    /**#@-*/

    // }}}
    // properties {{{

    /**
     * Url of the GeoNames web service.
     *
     * @var string $url
     */
    public $url = 'http://www.gravatar.com/avatar/';

    /**
     * The HTTP_Request2 instance, you can customize the request if you want to
     * (proxy, auth etc...) with the get/setRequest() methods.
     *
     * @var HTTP_Request2 $request
     * @see Services_Gravatar::getRequest()
     * @see Services_Gravatar::setRequest()
     */
    protected $request;

    /**
     * Email corresponding to the avatar.
     *
     * @var string $email
     * @see Services_Gravatar::__construct()
     */
    protected $email;

    /**
     * Optional parameters (size, rating, default...).
     * The array can have the following keys:
     *   - size: an integer between 1 and 512 (pixels), the default is 80;
     *   - rating: one of the rating constants (you can pass the string
     *     directly but it is recommended to use the provided constants), the
     *     default is Services_Gravatar::RATING_G;
     *   - default: a default image path or one of the default constants, if
     *     no default is given, the blue 'G' default image is used;
     *   - extension: if given, the extension to be added at the end of
     *     the email hash (useful for some places on the internet which
     *     require that image URLs have filename extensions).
     *
     * @var array $properties
     * @see Services_Gravatar::__construct()
     */
    protected $properties = array(
        'size'      => null,
        'rating'    => null,
        'default'   => null,
        'extension' => null,
    );

    // }}}
    // __construct() {{{

    /**
     * Constructor, you must pass a valid email and optionally an array of
     * parameters that can be as follows:
     *
     * <code>
     * array(
     *     'size'    => 250,
     *     'rating'  => Services_Gravatar::RATING_G,
     *     'default' => Services_Gravatar::DEFAULT_WAVATAR,
     * );
     * </code>
     *
     * @param string $email  Avatar email
     * @param array  $params Optional parameters (size, rating, default...)
     *
     * @return void
     * @throws Services_Gravatar_Exception If an invalid email is given.
     * @access public
     */
    public function __construct($email, $params = array())
    {
        $this->email = $email;
        foreach ($params as $key => $val) {
            if (array_key_exists($key, $this->properties)) {
                $this->properties[$key] = $val;
            }
        }
    }

    // }}}
    // getURL() {{{

    /**
     * Returns the gravatar image URL.
     *
     * @return string
     */
    public function getURL()
    {
        $url = $this->url . md5(strtolower($this->email));
        if (isset($this->properties['extension'])) {
            if (substr($this->properties['extension'], 0, 1) !== '.') {
                $url .= '.';
            }
            $url .= $this->properties['extension'];
        }
        $params = array();
        if (isset($this->properties['size'])) {
            $params['s'] = $this->properties['size'];
        }
        if (isset($this->properties['rating'])) {
            $params['r'] = $this->properties['rating'];
        }
        if (isset($this->properties['default'])) {
            $params['d'] = urlencode($this->properties['default']);
        }
        if (count($params)) {
            $url .= '?';
            $pad  = '';
            foreach ($params as $k => $v) {
                $url .= $pad . $k . '=' . $v;
                $pad  = '&';
            }
        }
        return $url;
    }

    // }}}
    // getHTML() {{{

    /**
     * Returns the gravatar image html tag.
     *
     * @param array $params An array of img tag attributes (optional)
     *
     * @return string
     */
    public function getHTML(array $params = array())
    {
        $return = '<img src="' . $this->getURL() . '"';
        foreach ($params as $attr => $val) {
            $return .= ' ' . $attr . '="' . $val . '"';
        }
        $return .= '/>';
        return $return;
    }

    // }}}
    // getData() {{{

    /**
     * Fetch image data and returns it.
     *
     * @return string
     * @throws Services_Gravatar_Exception When something goes wrong.
     */
    public function getData()
    {
        try {
            $request = clone $this->getRequest();
            $request->setUrl($this->getURL());
            $response = $request->send();
        } catch (Exception $exc) {
            throw  new Services_Gravatar_Exception($exc->getMessage(), $exc);
        }
        if ($response->getStatus() != 200) {
            throw  new Services_Gravatar_Exception(
                $response->getReasonPhrase(),
                $response->getStatus(),
                $response
            );
        }
        return $response->getBody();
    }

    // }}}
    // getRequest() {{{

    /**
     * Returns the HTTP_Request2 instance, if it's not yet set it is
     * instanciated on the fly.
     *
     * @return HTTP_Request2 The request
     * @see Services_Gravatar::$request
     */
    public function getRequest()
    {
        if (!$this->request instanceof HTTP_Request2) {
            include_once 'HTTP/Request2.php';
            $this->request = new HTTP_Request2();
        }
        return $this->request;
    }

    // }}}
    // setRequest() {{{

    /**
     * Sets the HTTP_Request2 instance.
     *
     * @param HTTP_Request2 $request The request to set
     *
     * @return void
     * @see Services_Gravatar::$request
     */
    public function setRequest(HTTP_Request2 $request)
    {
        $this->request = $request;
    }

    // }}}
}
