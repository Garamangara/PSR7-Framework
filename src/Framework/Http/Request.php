<?php
/**
 * Request
 */

namespace Framework\Http;

class Request
{
    private $queryParams;

    private $parsedBody;

    public function __construct(
        array $queryParams = [],
        $parsedBody = null
    ) {
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getParsedBody(): array
    {
        return $this->parsedBody;
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }
}