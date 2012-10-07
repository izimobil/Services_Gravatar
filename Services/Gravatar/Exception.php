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
 * Include the PEAR_Exception class.
 */
require_once 'PEAR/Exception.php';

/**
 * Base class for exceptions raised by the Services_Gravatar package.
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
class Services_Gravatar_Exception extends PEAR_Exception
{
    // properties {{{

    /**
     * HTTP_Request2_Response instance.
     *
     * @var HTTP_Request2_Response $response
     */
    public $response;

    // }}}
    // __construct() {{{

    /**
     * Constructor.
     *
     * @param string                 $msg  The exception message
     * @param int|Exception          $p2   Exception code or cause
     * @param HTTP_Request2_Response $resp Optional request response
     *
     * @return void
     */
    public function __construct($msg, $p2 = null, $resp = null)
    {
        parent::__construct($msg, $p2);
        $this->response = $resp;
    }

    // }}}
}
