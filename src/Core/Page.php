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
     * @var string
     */
    private string $dir;
    /**
     * @var Container
     */
    private Container $container;

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
        $this->container = Container::getInstance();
        $this->dir = $this->container->get('dir');
    }

    /**
     * @return string
     */
    public function generateContent(): string
    {

        foreach($this->vars as $key){
            if (is_string($key)) {
                $this->vars[$key] = htmlspecialchars($key);
            }
        }

        extract($this->vars);

        ob_start();
        include $this->dir.'/template/'.$this->pageName.'.php';
        return ob_get_clean();

    }

}