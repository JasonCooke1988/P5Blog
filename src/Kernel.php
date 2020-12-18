<?php


namespace App;


use App\Core\Container;
use App\Core\Page;
use App\Core\Request;
use App\Core\Response;
use App\Core\Route;
use App\Model\User;

class Kernel
{
    /**
     * @var array
     */
    private $routes = [];
    /**
     * @var Container
     */
    private $container;

    /**
     * Kernel constructor.
     * @param Container $container
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->container = Container::getInstance();
    }

    /**
     * @return array
     */
    private function getRoutes(): array
    {
        return $this->routes;
    }

    public function run(Request $request): Response
    {
        $response = null;
        $uri = $request->getUri();

        if ($this->container->has('base.path')) {
            $basePath = parse_url($this->container->get('base.path'), PHP_URL_PATH);
            $uri = str_replace($basePath, '',$uri);
        }

        /**
         * @var Route $route
         */
        foreach ($this->getRoutes() as $route) {
            if (($varsValues = $route->match($uri)) !== false) {
                $controllerName = $route->getController();
                $controller = new $controllerName($request);
                $action = $route->getAction();
                $response = call_user_func_array([$controller, $action], (array)$varsValues);
                break;
            }
        }

        if ($response instanceof Response) {
            return $response;
        }
        $page = new Page('404');
        return new Response($page->generateContent(), 404);
    }
}