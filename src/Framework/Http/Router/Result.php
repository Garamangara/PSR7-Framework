<?php
/**
 * Result
 */

namespace Framework\Http\Router;

use Psr\Http\Message\ServerRequestInterface;

class Result
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $handler;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @param string $name
     * @param string $handler
     * @param array $attributes
     */
    public function __construct(
        string $name,
        string $handler,
        array $attributes
    ) {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}