<?php


namespace App\Core;


class Request
{

    private $uri;
    private $post;
    private $method;
    private $get;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->post = $_POST;
        $this->get = $_GET;
        $this->method = null;
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->method = $_SERVER['REQUEST_METHOD'];
        }
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
    }


}