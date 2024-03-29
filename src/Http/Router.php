<?php declare(strict_types=1);

namespace App\Http;

class Router
{
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    public function __call($name, $args): void
    {
        list($route, $method) = $args;
        if(!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param $route (string)
     *
     * @return string
     */
    private function formatRoute(string $route): string
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler(): void
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler(): void
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * Resolves a route
     */
    public function resolve()
    {
        $methodDictionary    = $this->{strtolower($this->request->requestMethod)};
        $formattedRoute      = $this->formatRoute($this->request->requestUri);
        $method              = @$methodDictionary[$formattedRoute];

        if(is_null($method)) {
            $this->defaultRequestHandler();
            return null;
        }
        echo call_user_func_array($method, array($this->request));
    }

    public function __destruct()
    {
        $this->resolve();
    }

}
