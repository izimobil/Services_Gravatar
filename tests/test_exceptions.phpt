--TEST--
Test for Services_Gravatar exceptions
--FILE--
<?php

require_once 'Services/Gravatar.php';
require_once 'HTTP/Request2/Response.php';
require_once 'HTTP/Request2/Adapter/Mock.php';

$livetest = getenv('SERVICES_GRAVATAR_LIVETEST');

try {
    $gravatar = new Services_Gravatar('email@example.com');
    $gravatar->url = 'Some invalid url...';
    $gravatar->getData();
} catch (Services_Gravatar_Exception $exc) {
    echo $exc->getMessage() . "\n";
}

try {
    $gravatar = new Services_Gravatar('email@example.com');
    if (!$livetest) {
        $mock = new HTTP_Request2_Adapter_Mock();
        $resp = new HTTP_Request2_Response('HTTP/1.1 404 Not Found', false);
        $mock->addResponse($resp);
        $request = $gravatar->getRequest();
        $request->setAdapter($mock);
    } else {
        $request = new HTTP_Request2();
    }
    $gravatar->setRequest($request);
    $gravatar->url = 'http://www.example.com/test/';
    $gravatar->getData();
} catch (Services_Gravatar_Exception $exc) {
    echo $exc->getMessage() . "\n";
    echo get_class($exc->response);
}

?>
--EXPECT--
Absolute URL required
Not Found
HTTP_Request2_Response
