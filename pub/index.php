<?php
chdir(dirname(__DIR__));
// прописать настройки по psr4 в секцию autoload в файле composer.json
// Выполнить команду composer dump-autoload
require 'vendor/autoload.php';

use Framework\Http\ResponseSender;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;

### Initialization

$request = ServerRequestFactory::fromGlobals();

### Action

$name = $request->getQueryParams()['name'] ?? 'Guest';

$response = (new HtmlResponse("Hello, $name!"))
    ->withHeader('X-Developer', 'Kyrylo');

### Sending
$sender = new ResponseSender();
$sender->send($response);



