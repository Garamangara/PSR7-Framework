<?php

namespace Tests\Framework\Http;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class RequestTest extends TestCase
{
    public function testEmpty(): void
    {
        $request = new ServerRequest();

        self::assertEquals([], $request->getQueryParams());
        self::assertEquals(null, $request->getParsedBody());
    }

    public function testQueryParams(): void
    {
        $request = (new ServerRequest())
            ->withQueryParams($data = [
                'name' => 'John',
                'age' => 28,
            ]);

        self::assertEquals($data, $request->getQueryParams());
        self::assertEquals(null, $request->getParsedBody());
    }

    public function testParsedBody(): void
    {
        $data = ['title' => 'Title'];
        $request = (new ServerRequest())
            ->withParsedBody($data);

        self::assertEquals([], $request->getQueryParams());
        self::assertEquals($data, $request->getParsedBody());
    }
}