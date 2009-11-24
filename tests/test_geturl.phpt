--TEST--
Test for Services_Gravatar::getURL() method.
--FILE--
<?php

require_once 'Services/Gravatar.php';

$gravatar = new Services_Gravatar('email@example.com');
echo $gravatar->getURL() . "\n";

$gravatar = new Services_Gravatar('email@example.com', array(
    'rating'  => Services_Gravatar::RATING_R,
    'default' => 'http://example.com/path/to/image.png',
    'extension' => 'png',
));
echo $gravatar->getURL() . "\n";

$gravatar = new Services_Gravatar('email@example.com', array(
    'size'  => 256,
    'extension' => '.png',
));
echo $gravatar->getURL() . "\n";

?>
--EXPECT--
http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e
http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.png?r=r&d=http%3A%2F%2Fexample.com%2Fpath%2Fto%2Fimage.png
http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.png?s=256
