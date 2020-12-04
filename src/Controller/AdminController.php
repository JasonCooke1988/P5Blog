<?php


namespace App\Controller;


use App\Controller\AbstractController;
use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Service\Session;

class AdminController extends AbstractController
{

    public function index(): Response
    {
        $container = Container::getInstance();
        $session =  $container->get(Session::class);
        if (!$session->isAuth() || !$session->isAdmin()) {
            return $this->unAuthorized();
        } else {
            $page = (new Page('admin-page'))->generateContent();
        }
        return new Response($page);
    }

    public function createPost(): Response
    {
        $container = Container::getInstance();
        $session =  $container->get(Session::class);
        if (!$session->isAdmin()) {
            return $this->unAuthorized();
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

    public function modifyPostList(): Response
    {
        $container = Container::getInstance();
        $session = $container->get(Session::class);
        if(!$session->isAdmin()) {
            return $this->unAuthorized();
        }
        $postManager = $container->get(PostManager::class);

        $posts = $postManager->getList();

        $page = (new Page('admin-posts', ['posts' => $posts]))->generateContent();

        return new Response($page);
    }

    public function modifyPost(int $postId): Response
    {
        $container = Container::getInstance();
        $session = $container->get(Session::class);
        if(!$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $postManager = $container->get(PostManager::class);
        $commentManager = $container->get(CommentManager::class);

        if ($this->request->getMethod() === "POST") {
            $data = $this->checkPost();
            if(isset($data['modify'])) {
                $postManager->modify($data);
                $comments = $commentManager->getNonValidated($postId);
                $post = $postManager->getOne($postId, $comments);
                $page = (new Page('admin-single-post', ['post' => $post, 'comments' => $comments, 'formSuccess' => 'Le post à été modifié']))->generateContent();
            } else {
                $postManager->delete($postId);
                $posts = $postManager->getList();
                $page = (new Page('admin-posts', ['posts' => $posts, 'success' => 'Le post à été supprimé']))->generateContent();
            }
        } else {
            $comments = $commentManager->getNonValidated($postId);
            $post = $postManager->getOne($postId, $comments);

            $page = (new Page('admin-single-post', ['post' => $post, 'comments' => $comments]))->generateContent();
        }
        return new Response($page);
    }

    public function validateComment(int $commentId, int $postId): Response
    {

        $container = Container::getInstance();
        $session = $container->get(Session::class);
        if(!$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $postManager = $container->get(PostManager::class);
        $commentManager = $container->get(CommentManager::class);



        if ($this->request->getMethod() === "POST") {
            $data = $this->checkPost();

            if (isset($data['validate'])) {
                $commentManager->validate($commentId);
                $formSuccess = "Commentaire validé";
            } else {
                $commentManager->delete($commentId);
                $formSuccess = "Commentaire supprimé";
            }

            $comments = $commentManager->getNonValidated($postId);
            $post = $postManager->getOne($postId, $comments);
            $page = (new Page('admin-single-post', ['post' => $post, 'comments' => $comments, 'formSuccess' => $formSuccess]))->generateContent();
        } else {
            $comments = $commentManager->getNonValidated($postId);
            $post = $postManager->getOne($postId, $comments);
            $page = (new Page('admin-single-post', ['post' => $post, 'comments' => $comments]))->generateContent();
        }
        return new Response($page);
    }
}