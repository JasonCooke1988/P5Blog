<?php


namespace App\Controller;


use App\Controller\AbstractController;
use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Service\Session;

class AdminController extends AbstractController
{

    public function index(): Response
    {
        $session = $this->container->get(Session::class);
        if (!$session->isAuth() || !$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $page = (new Page('admin-page', ['session' => $session]))->generateContent();
        return new Response($page);
    }

    public function createPost(): Response
    {
        $session = $this->container->get(Session::class);
        if (!$session->isAdmin()) {
            return $this->unAuthorized();
        } else {
            if ($this->request->getMethod() === "POST") {
                $postManager = $this->container->get(PostManager::class);
                $data = $this->checkPost();
                $data['email'] = $session->getAttribute('email');
                $data['userId'] = $session->getAttribute('id');
                $postManager->create($data);

                $page = (new Page('create-post', ['formSuccess' => 'Votre post à bien été ajouté à la base de donnnées.']))->generateContent();

            } else {
                $page = (new Page('create-post'))->generateContent();
            }
        }
        return new Response($page);
    }

    public function modifyPostList(): Response
    {
        $session = $this->container->get(Session::class);
        if (!$session->isAdmin()) {
            return $this->unAuthorized();
        }
        $postManager = $this->container->get(PostManager::class);

        $posts = $postManager->getList();

        $page = (new Page('admin-posts', ['posts' => $posts]))->generateContent();

        return new Response($page);
    }

    public function modifyPost(int $postId): Response
    {
        $session = $this->container->get(Session::class);
        if (!$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $postManager = $this->container->get(PostManager::class);
        $commentManager = $this->container->get(CommentManager::class);

        if ($this->request->getMethod() === "POST") {
            $data = $this->checkPost();
            if (isset($data['modify'])) {
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

        $session = $this->container->get(Session::class);
        if (!$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $postManager = $this->container->get(PostManager::class);
        $commentManager = $this->container->get(CommentManager::class);


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

    public function userList(): Response
    {
        $session = $this->container->get(Session::class);

        if (!$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $userManager = $this->container->get(UserManager::class);
        $users = $userManager->getAll();
        $page = (new Page('user-list', ['users' => $users]))->generateContent();

        return new Response($page);
    }

    public function setUserAdmin(int $userId)
    {
        $session = $this->container->get(Session::class);

        if (!$session->isAdmin()) {
            return $this->unAuthorized();
        }

        $userManager = $this->container->get(UserManager::class);
        $userManager->setAdmin($userId);
        $users = $userManager->getAll();
        $page = (new Page('user-list', ['users' => $users, 'success' => 'L\'utilisateur est désormais un administrateur']))->generateContent();

        return new Response($page);
    }
}