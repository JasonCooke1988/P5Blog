<?php


namespace App\Core;


class Container
{

    /**
     * @var array
     */
    private array $services = [];

    /**
     * @var array
     */
    private array $objects = [];

    /***
     * @var Container
     */
    private static $instance;

    /**
     * Container constructor.
     * @param array $services
     */
    public function __construct(array $services)
    {
        $this->services = $services;
    }

    /**
     * @param array $services
     * @return mixed
     */
    public static function getInstance(): Container
    {
        return Container::$instance;
    }

    /**
     * @param array $services
     * @return mixed
     */
    public static function init(array $services): void
    {
        Container::$instance = new Container($services);
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $this->objects)) {
            return $this->objects[$key];
        }

        if ($this->has($key)) {
            $data = $this->services[$key];
            if (is_callable($data)) {
                $data = $data($this);
                $this->objects[$key] = $data;
            }

            return $data;
        }
        throw new \Exception($key.' Not found in container');
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key) : bool
    {
        return array_key_exists($key, $this->services);
    }

}