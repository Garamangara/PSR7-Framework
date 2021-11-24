<?php
chdir(dirname(__DIR__));
// прописать настройки по psr4 в секцию autoload в файле composer.json
// Выполнить команду composer dump-autoload
require 'vendor/autoload.php';
//require __DIR__ . '/../vendor/autoload.php';

use Framework\Http\RequestFactory;
use Framework\Http\Response;

### Initialization

//смотрите описание в реализации метода
$request = RequestFactory::fromGlobals();

### Action

$name = $request->getQueryParams()['name'] ?? 'Guest';

$response = (new Response("Hello, $name!"))
    ->withHeader('X-Developer', 'Kyrylo');

### Sending
header('HTTP/1.1 ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase());
foreach ($response->getHeaders() as $name => $value) {
    header($name . ':' . $value);
}
echo $response->getBody();



