<?php

namespace Framework\Http;

interface ServerRequestInterface
{
    /**
     * @return array
     */
    public function getQueryParams(): array;

    /**
     * @param array $query
     * @return $this
     */
    public function withQueryParams(array $query): self;

    public function getParsedBody();

    /**
     * @param $data
     * @return $this
     */
    public function withParsedBody($data): self;
}