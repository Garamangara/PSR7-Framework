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
$action = null;

if ($path === '/') {
    /**
     * Анонимная функция, чтобы работать только с данными, переданными в аргументах функции
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    $action = function (\Psr\Http\Message\ServerRequestInterface $request) {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse("Hello, $name!");
    };

} elseif ($path === '/about') {
    /**
     * Анонимная функция, чтобы работать только с данными, переданными в аргументах функции
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    $action = function (\Psr\Http\Message\ServerRequestInterface $request) {
        return new HtmlResponse("I am a simple site!");
    };

}

if ($action) {
    $response = $action($request);
} else {
    $response = new JsonResponse(['error' => 'Undefined page'], 404);
}

### Postprocessing

$response = $response->withHeader('X-Developer', 'Kyrylo');

### Sending
$sender = new SapiEmitter();
$sender->emit($response);



