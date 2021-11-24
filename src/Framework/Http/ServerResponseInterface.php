<?php

namespace Framework\Http;

interface ServerResponseInterface
{
    public function getBody();

    /**
     * @return mixed
     */
    public function withBody($body): self;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return string
     */
    public function getReasonPhrase();

    /**
     * @param $code
     * @param string $reasonPhrase
     * @return $this
     */
    public function withStatus($code, string $reasonPhrase = ''): self;

    /**
     * @return array
     */
    public function getHeaders(): array;

    public function hasHeader($header): bool;

    public function getHeader($header);

    public function withHeader($header, $value): self;
}