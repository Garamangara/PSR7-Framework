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
} elseif ($path === '/blog') {

    $action = function (\Psr\Http\Message\ServerRequestInterface $request) {
        return new JsonResponse([
            ['id' => 2, 'title' => 'The second post'],
            ['id' => 1, 'title' => 'The first post'],
        ]);
    };
} elseif (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)) {
    $id = $matches['id'];
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param $id - Изза этого параметра, сигнатура этой функции $action не похожа на другие функции $action.
     * От этого мы уже не сможем создать для, казалось бы, функций с одинаковым предназначением единый интерфейс.
     * @return JsonResponse
     */
    $action = function (\Psr\Http\Message\ServerRequestInterface $request, $id = null) {
        if ($id > 2) {
            return new JsonResponse(['error' => 'Undefined page'], 404);
        }
        return new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
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



