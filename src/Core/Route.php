<?php


namespace App\Core;


class Route
{
    /**
     * @var string
     */
    private $uri;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $action;
    /**
     * @var array
     */
    private array $vars;

    /**
     * Route constructor.
     * @param string $uri
     * @param string $controller
     * @param string $action
     * @param array $vars
     */
    public function __construct(string $uri, string $controller, string $action, array $vars = [])
    {

        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
        $this->vars = $vars;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    public function match(string $url)
    {
        if (preg_match('`^' . $this->uri . '$`', $url, $matches)) {
            array_shift($matches);
            return $matches;
        }
        return false;
    }

    public function hasVars()
    {
        return !empty($this->vars);
    }


}