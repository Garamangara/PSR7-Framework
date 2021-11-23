<?php

namespace Tests\Framework\Http;

use Framework\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testEmpty(): void
    {
        $request = new Request();

        self::assertEquals([], $request->getQueryParams());
        self::assertEquals(null, $request->getParsedBody());
    }

    public function testQueryParams(): void
    {
        $request = (new Request())
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
        $request = (new Request())
            ->withParsedBody($data);

        self::assertEquals([], $request->getQueryParams());
        self::assertEquals($data, $request->getParsedBody());
    }
}