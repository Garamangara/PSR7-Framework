<?php
/**
 * Request
 */

namespace Framework\Http;

class Request implements ServerRequestInterface
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

    public function withQueryParams(array $query): self
    {
        $new = clone $this;
        // имеем доступ к приватным свойствам не из обьекта $this,
        // потому что находимся внутри класса, у обьекта которого обращаемся к приватным свойствам
        $new->queryParams = $query;
        return $new;
    }

    public function getParsedBody()
    {
        return $this->parsedBody;
    }

    public function withParsedBody($data): self
    {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }
}