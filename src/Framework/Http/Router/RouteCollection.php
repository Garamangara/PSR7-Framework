<?php

namespace Framework\Http\Router;

class RouteCollection
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param Route $route
     * @return void
     */
    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param string $handler
     * @param array $methods
     * @param array $tokens
     * @return void
     */
    public function add(
        string $name,
        string $pattern,
        string $handler,
        array $methods,
        array $tokens = []
    ): void {
        $this->addRoute(new Route($name, $pattern, $handler, $methods, $tokens));
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param string $handler
     * @param array $tokens
     * @return void
     */
    public function any(
        string $name,
        string $pattern,
        string $handler,
        array $tokens = []
    ): void {
        $this->addRoute(new Route($name, $pattern, $handler, [], $tokens));
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param string $handler
     * @param array $tokens
     * @return void
     */
    public function get(
        string $name,
        string $pattern,
        string $handler,
        array $tokens = []
    ): void {
        $this->addRoute(new Route($name, $pattern, $handler, ['GET'], $tokens));
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param string $handler
     * @param array $tokens
     * @return void
     */
    public function post(
        string $name,
        string $pattern,
        string $handler,
        array $tokens = []
    ): void {
        $this->addRoute(new Route($name, $pattern, $handler, ['POST'], $tokens));
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
