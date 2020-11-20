<?php


namespace App\Core;


use App\Model\Post;

class Page
{
    /**
     * @var string
     */
    public string $pageName;
    /**
     * @var array
     */
    private array $vars = [];
    /**
     * @var Post
     */
    private Post $posts;
    /**
     * @var string
     */
    private string $dir;

    /**
     * Page constructor.
     * @param string $pageName
     * @param array $vars
     * @throws \Exception
     */
    public function __construct(string $pageName, array $vars = [])
    {

        $this->pageName = $pageName;
        $this->vars = $vars;
        $container = Container::getInstance();
        $this->dir = $container->get('dir');
    }

    /**
     * @return string
     */
    public function generateContent(): string
    {
        extract($this->vars);

        ob_start();
        require_once ($this->dir.'/template/'.$this->pageName.'.php');
        return ob_get_clean();

    }

}