<?php

/**
 * Чтобы функция была более удобочитаемой,
 * лучше все данные передавать в нее через аргументы
 *
 * Более того это удобно для Unit тестирования
 *
 * Лучше передавать как можно меньше параметров в функцию.
 * Для этого нужно предерживаться принципа единственной ответственности
 * Еще один выход сгруппировать параметры. В данном случае в массив $request
 */
function getLang(array $request, $default) {
    if (!empty($request['get']['lang'])) {
        $lang = $request['get']['lang'];
    } elseif (!empty($request['cookie']['lang'])) {
        $lang = $request['cookie']['lang'];
    } elseif (!empty($request['session']['lang'])) {
        $lang = $request['session']['lang'];
    } elseif (!empty($request['server']['lang'])) {
        $lang = $request['server']['lang'];
    } else {
        $lang = $default;
    }
    return $lang;
}

session_start();

$name = empty($_GET['name']) ? 'Guest' : $_GET['name'];
header('X-Developer: Kyrylo');

$request = [
    'get' => $_GET,
    'cookie' => $_COOKIE,
    'session' => $_SESSION,
    'server' => $_SERVER
];

$lang = getLang($request, 'en');

echo "Hello, $name! Your lang is $lang";