<?php

function getLang($default) {
    if (!empty($_GET['lang'])) {
        $lang = $_GET['lang'];
    } elseif (!empty($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } elseif (!empty($_SESSION['lang'])) {
        $lang = $_SESSION['lang'];
    } elseif (!empty($_SERVER['lang'])) {
        $lang = $_SERVER['lang'];
    } else {
        $lang = $default;
    }
    return $lang;
}

$name = empty($_GET['name']) ? 'Guest' : $_GET['name'];
header('X-Developer: Kyrylo');

$lang = getLang('en');

echo "Hello, $name! Your lang is $lang";