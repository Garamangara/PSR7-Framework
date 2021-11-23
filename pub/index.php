<?php

/**
 * Чтобы функция была более удобочитаемой,
 * лучше все данные передавать в нее через аргументы
 *
 * Более того это удобно для Unit тестирования
 */
function getLang(array $get, array $cookie, array $session, array $server, $default) {
    if (!empty($get['lang'])) {
        $lang = $get['lang'];
    } elseif (!empty($cookie['lang'])) {
        $lang = $cookie['lang'];
    } elseif (!empty($session['lang'])) {
        $lang = $session['lang'];
    } elseif (!empty($server['lang'])) {
        $lang = $server['lang'];
    } else {
        $lang = $default;
    }
    return $lang;
}

session_start();

$name = empty($_GET['name']) ? 'Guest' : $_GET['name'];
header('X-Developer: Kyrylo');

$lang = getLang($_GET, $_COOKIE, $_SESSION, $_SERVER, 'en');

echo "Hello, $name! Your lang is $lang";