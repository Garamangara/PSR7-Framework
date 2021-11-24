<?php
/**
 * RequestFactory
 */

namespace Framework\Http;

use Framework\Http\Request;

class RequestFactory
{
    /**
     * Удобнее использовать метод, в котором инициализируется обьект Запроса с суперглобальными массивами.
     * Он пригодится, если прийдется вызвать у глобального обьекта Запроса дополнительные методы, в таком случае нужно будет измменить код только в одном месте
     *
     * @param array|null $query
     * @param array|null $body
     * @return \Framework\Http\Request
     */
    public static function fromGlobals(array $query = null, array $body = null): Request
    {
        return (new Request())
            ->withQueryParams($query ?: $_GET)
            ->withParsedBody($body ?: $_POST);
    }
}