<?php
//use Framework\Http\Request;

require __DIR__ . '/../src/Framework/Http/Request.php';
/**
 * Чтобы функция была более удобочитаемой,
 * лучше все данные передавать в нее через аргументы
 *
 * Более того это удобно для Unit тестирования
 *
 * Лучше передавать как можно меньше параметров в функцию.
 * Для этого нужно предерживаться принципа единственной ответственности
 * Еще один выход сгруппировать параметры. В в прошлом коммите передавали данные в массив $request
 *
 * Теперь создаем обьект класса Request. В обьектах удобнее работать с данными, так как в IDE методы подсвечиваются и сложнее допустить ошибку в вызове параметра
 */
function getLang(Request $request, $default) {
    if (!empty($request->getQueryParams()['lang'])) {
        $lang = $request->getQueryParams()['lang'];
    } elseif (!empty($request->getCookies()['lang'])) {
        $lang = $request->getCookies()['lang'];
    } elseif (!empty($request->getSession()['lang'])) {
        $lang = $request->getSession()['lang'];
    } elseif (!empty($request->getServer()['lang'])) {
        $lang = $request->getServer()['lang'];
    } else {
        $lang = $default;
    }
    return $lang;
}

session_start();

$name = empty($_GET['name']) ? 'Guest' : $_GET['name'];
header('X-Developer: Kyrylo');

$request = new Request();

$lang = getLang($request, 'en');

echo "Hello, $name! Your lang is $lang";