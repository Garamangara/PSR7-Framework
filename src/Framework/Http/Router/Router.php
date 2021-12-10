<?php
/**
 * Router
 */

namespace Framework\Http\Router;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;

class Router
{
    /**
     * @var RouteCollection
     */
    private $routes;

    /**
     * @param RouteCollection $routes
     */
    public function __construct(
        RouteCollection $routes
    ) {
        $this->routes = $routes;
    }

    /**
     * @param ServerRequestInterface $request
     * @return Result
     */
    public function match(ServerRequestInterface $request): Result
    {
        foreach ($this->routes->getRoutes() as $route) {
            if ($route->methods && !\in_array($request->getMethod(), $route->methods, true)) {
                continue;
            }

            $pattern = $this->getRegexForPattern($route);

            if (preg_match($pattern, $request->getUri()->getPath(), $matches)) {
                return new Result(
                    $route->name,
                    $route->handler,
                    array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
                );
            }
        }

        throw new RequestNotMatchedException($request);
    }

    /**
     * @param $name
     * @param array $params
     * @return string
     */
    public function generate($name, array $params = []): string
    {
        $arguments = array_filter($params);

        foreach ($this->routes->getRoutes() as $route) {
            if ($name !== $route->name) {
                continue;
            }

            $url = $this->getUrl($route, $arguments);

            if ($url !== null) {
                return $url;
            }
        }
        throw new RouteNotFoundException($name, $params);
    }

    /**
     * @param $route
     * @return string
     */
    private function getRegexForPattern($route): string
    {
        return preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use ($route) {
            $argument = $matches[1];
            $replace = $route->tokens[$argument] ?? '[^}]+';
            return '(?P<' . $argument . '>' . $replace . ')';
        }, $route->pattern);
    }

    /**
     * @param $route
     * @param $arguments
     * @return string
     */
    private function getUrl($route, $arguments): string
    {
        return preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use (&$arguments) {
            $argument = $matches[1];
            if (!array_key_exists($argument, $arguments)) {
                throw new \InvalidArgumentException('Missing parameter "' . $argument . '"');
            }
            return $arguments[$argument];
        }, $route->pattern);
    }
}
