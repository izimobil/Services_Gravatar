--TEST--
Test for Services_Gravatar::getHTML() method.
--FILE--
<?php

require_once 'Services/Gravatar.php';

$gravatar = new Services_Gravatar('email@example.com');
echo $gravatar->getHTML(array('title' => 'John Doe', 'alt' => 'John Doe\'s avatar'));

?>
--EXPECT--
<img src="http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e" title="John Doe" alt="John Doe's avatar"/>
