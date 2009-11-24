--TEST--
Test for Services_Gravatar::getData() method.
--FILE--
<?php

require_once 'Services/Gravatar.php';
require_once 'HTTP/Request2/Response.php';
require_once 'HTTP/Request2/Adapter/Mock.php';

$livetest = getenv('SERVICES_GRAVATAR_LIVETEST');

$gravatar = new Services_Gravatar('izimobil@gmail.com', array(
    'size'      => 120,
    'extension' => 'png',
));
$imgdata  = file_get_contents(dirname(__FILE__) . '/data/valid_image.png');
if (!$livetest) {
    $mock = new HTTP_Request2_Adapter_Mock();
    $resp = new HTTP_Request2_Response('HTTP/1.1 200 Ok', false);
    $resp->appendBody($imgdata);
    $mock->addResponse($resp);
    $gravatar->getRequest()->setAdapter($mock);
}
var_dump($gravatar->getData() === $imgdata);

$gravatar = new Services_Gravatar('email@example.com');
$imgdata  = file_get_contents(dirname(__FILE__) . '/data/gravatar_image.jpg');
if (!$livetest) {
    $mock = new HTTP_Request2_Adapter_Mock();
    $resp = new HTTP_Request2_Response('HTTP/1.1 200 Ok', false);
    $resp->appendBody($imgdata);
    $mock->addResponse($resp);
    $gravatar->getRequest()->setAdapter($mock);
}
var_dump($gravatar->getData() === $imgdata);

?>
--EXPECT--
bool(true)
bool(true)
