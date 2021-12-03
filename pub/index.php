<?php
chdir(dirname(__DIR__));
// прописать настройки по psr4 в секцию autoload в файле composer.json
// Выполнить команду composer dump-autoload
require 'vendor/autoload.php';

use Framework\Http\ResponseSender;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

use Zend\Diactoros\Response\JsonResponse;

### Initialization

$request = ServerRequestFactory::fromGlobals();

### Action

$path = $request->getUri()->getPath();

if ($path === '/') {
    $name = $request->getQueryParams()['name'] ?? 'Guest';
    $response = new HtmlResponse("Hello, $name!");
} elseif ($path === '/about') {
    $response = new HtmlResponse("I am a simple site!");
} else {
    $response = new JsonResponse(['error' => 'Undefined page'], 404);
}

### Postprocessing

$response = $response->withHeader('X-Developer', 'Kyrylo');

### Sending
$sender = new SapiEmitter();
$sender->emit($response);



