<?php


namespace App\Controller;


use App\Controller\AbstractController;
use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\PostManager;
use App\Service\Session;

class AdminController extends AbstractController
{

    public function index(): Response
    {
        $container = Container::getInstance();
        $session =  $container->get(Session::class);
        if (!$session->isAuth() || !$session->isAdmin()) {
            $page = (new Page('unauthorized'))->generateContent();
        } else {
            $page = (new Page('admin-page'))->generateContent();
        }
        return new Response($page);
    }

    public function createPost(): Response
    {
        $container = Container::getInstance();
        $session =  $container->get(Session::class);
        if (!$session->isauth() && !$session->isAdmin()) {
            $page = (new Page('unauthorized'))->generateContent();
        } else {
            if ($this->request->getMethod() === "POST") {
                $postManager = $container->get(PostManager::class);
                $data = $this->checkPost();
                $data['email'] = $session->getAttribute('email');
                $data['userId'] = $session->getAttribute('id');
                $postManager->create($data);

                $page = (new Page('create-post',['formSuccess' => 'Votre post à bien été ajouté à la base de donnnées.']))->generateContent();

            } else {
                $page = (new Page('create-post'))->generateContent();
            }
        }
        return new Response($page);
    }
}