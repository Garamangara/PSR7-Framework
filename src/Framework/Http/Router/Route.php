<?php
/**
 * Route
 */

namespace Framework\Http\Router;

class Route
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $pattern;

    /**
     * @var string
     */
    public $handler;

    /**
     * @var array
     */
    public $methods;

    /**
     * @var array
     */
    public $tokens;

    /**
     * @param string $name
     * @param string $pattern
     * @param string $handler
     * @param array $methods
     * @param array $tokens
     */
    public function __construct(
        string $name,
        string $pattern,
        string $handler,
        array $methods,
        array $tokens = []
    ) {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }
}