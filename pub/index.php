<?php
chdir(dirname(__DIR__));
// прописать настройки по psr4 в секцию autoload в файле composer.json
// Выполнить команду composer dump-autoload
require 'vendor/autoload.php';
//require __DIR__ . '/../vendor/autoload.php';

use Framework\Http\RequestFactory;

//смотрите описание в реализации метода
$request = RequestFactory::fromGlobals();

$name = $request->getQueryParams()['name'] ?? 'Guest';
header('X-Developer: Kyrylo');
echo "Hello, $name!";

