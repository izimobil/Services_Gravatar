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
 * @version   CVS: $Id: AllTests.php,v 1.2 2009/01/23 14:21:58 izi Exp $
 * @link      http://pear.php.net/package/Services_Gravatar
 * @since     File available since release 0.1.0
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Services_Gravatar_AllTests::main');
}

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/Extensions/PhptTestSuite.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

/**
 * Services_Gravatar phpt test suite.
 *
 * Run all tests from the package root directory:
 * $ phpunit Services_Gravatar_AllTests tests/AllTests.php
 * or
 * $ php tests/AllTests.php
 *
 * @category  Services
 * @package   Services_Gravatar
 * @author    David Jean Louis <izi@php.net>
 * @copyright 2008-2009 David Jean Louis
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/Services_Gravatar
 * @since     Class available since release 0.1.0
 */
class Services_Gravatar_AllTests
{
    /**
     * Runs the test suite
     *
     * @return void
     * @static
     */
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    /**
     * Return the phpt test suite
     *
     * @return object the PHPUnit_Framework_TestSuite object
     * @static
     */
    public static function suite()
    {
        return new PHPUnit_Extensions_PhptTestSuite(dirname(__FILE__));
    }
}

if (PHPUnit_MAIN_METHOD == 'Services_Gravatar_AllTests::main') {
    Services_Gravatar_AllTests::main();
}
