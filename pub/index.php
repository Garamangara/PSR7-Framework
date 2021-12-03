<?php
chdir(dirname(__DIR__));
// прописать настройки по psr4 в секцию autoload в файле composer.json
// Выполнить команду composer dump-autoload
require 'vendor/autoload.php';

use Framework\Http\ResponseSender;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

### Initialization

$request = ServerRequestFactory::fromGlobals();

### Preprocessing

if (preg_match('#json#i', $request->getHeader('Content-Type'))) {
    $request = $request->withParsedBody(jsont_decode($request->getBody()->getContents()));
}

### Action

$name = $request->getQueryParams()['name'] ?? 'Guest';
$response = new HtmlResponse("Hello, $name!");

### Postprocessing

$response = $response->withHeader('X-Developer', 'Kyrylo');

### Sending
$sender = new SapiEmitter();
$sender->emit($response);



