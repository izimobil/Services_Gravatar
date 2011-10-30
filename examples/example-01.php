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
 * Include the Services_Gravatar class.
 */
require_once 'Services/Gravatar.php';

$gravatar = new Services_Gravatar('johndoe@example.com', array(
    'size'   => 180,
    'rating' => Services_Gravatar::RATING_G,
));

?>
<html>
<head>
    <title>Gravatar example</title>
</head>
<body>
    <h2>Avatar url</h2>
    <p><a href="<?php echo $gravatar->getURL() ?>"><?php echo $gravatar->getURL() ?></a></p>
    <h2>Avatar html</h2>
    <p><?php echo $gravatar->getHtml(array('title' => 'John Doe', 'alt' => 'John Doe avatar')) ?></p>
</body>
</html>
