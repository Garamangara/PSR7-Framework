<?php
/**
 * Request
 */

namespace Framework\Http;

class Request
{
    private $queryParams = [];

    private $parsedBody;

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function withQueryParams(array $query): array
    {
        $this->queryParams = $query;
    }

    public function getParsedBody(): array
    {
        return $this->parsedBody;
    }

    public function withParsedBody($data): array
    {
        $this->queryParams = $data;
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }
}