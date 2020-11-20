<?php


namespace App\Controller;


use App\Controller\AbstractController;
use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\PostManager;

class AdminController extends AbstractController
{

    public function index(): Response
    {

        if (!isset($_SESSION['auth']) && !isset($_SESSION['admin'])) {

            $page = (new Page('unauthorized'))->generateContent();
        } else {
            $page = (new Page('admin-page'))->generateContent();
        }
        return new Response($page);
    }

    public function createPost(): Response
    {
        if (!isset($_SESSION['auth']) && !isset($_SESSION['admin'])) {
            $page = (new Page('unauthorized'))->generateContent();
        } else {
            if ($this->request->getMethod() === "POST") {
                $container = Container::getInstance();
                $postManager = $container->get(PostManager::class);
                $data = $this->checkPost();
                $data['email'] = $_SESSION['email'];
                $data['userId'] = $_SESSION['id'];
                $postManager->create($data);

                $page = (new Page('create-post',['formSuccess' => 'Votre post à bien été ajouté à la base de donnnées.']))->generateContent();

            } else {
                $page = (new Page('create-post'))->generateContent();
            }
        }
        return new Response($page);
    }
}