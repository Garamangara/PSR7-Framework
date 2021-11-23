<?php
chdir(dirname(__DIR__));
// прописать настройки по psr4 в секцию autoload в файле composer.json
// Выполнить команду composer dump-autoload
require 'vendor/autoload.php';
//require __DIR__ . '/../vendor/autoload.php';

use Framework\Http\Request;

$request = new Request($_GET, $_POST);
$request->withQueryParams($_GET);
$request->withParsedBody($_POST);

$name = $request->getQueryParams()['name'] ?? 'Guest';
header('X-Developer: Kyrylo');
echo "Hello, $name!";

