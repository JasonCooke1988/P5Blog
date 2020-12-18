<?php

namespace App\Controller;

use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Service\Session;
use Exception;


class HomeController extends AbstractController
{

    /**
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        $css = "<style>
            .masthead {
                height: auto!important;
            }

            .logo {
                display: initial!important;
            }
        </style>";

        $page = (new Page('index', ['css' => $css]))->generateContent();

        return new Response($page);
    }

    public function singlePost(string $postId, string $formSuccess = ""): Response
    {

        $postManager = $this->container->get(PostManager::class);
        $commentManager = $this->container->get(CommentManager::class);
        $session = $this->container->get(Session::class);

        $comments = $commentManager->getValidated($postId);
        $post = $postManager->getOne($postId, $comments);

        $page = (new Page('post', ['formSuccess' => $formSuccess, 'post' => $post, 'session' => $session]))->generateContent();

        return new Response($page);
    }

    public function allPost(): Response
    {

        $postManager = $this->container->get(PostManager::class);

        $posts = $postManager->getList();

        $page = (new Page('post-archive', ['posts' => $posts]))->generateContent();

        return new Response($page);
    }

    public function contactForm(): Response
    {
        if ($this->request->getMethod() === "POST") {

            $data = $this->checkPost();

            if ($data['formError'] !== null) {
                $page = (new Page('index', ['formError' => $data['formError']]))->generateContent();
                return new Response($page);

            }

            $to = "jason.cooke@hotmail.fr";
            $subject = "Message de contact depuis P5 blog";

            $message = "<b>Message recue du formulaire de contact sur P5 Blog</b>";
            $message .= "Auteur du message : " . $data['fname'] . " " . $data['lname'];
            $message .= $data['message'];

            $header = "From:" . $data['email'] . " \r\n";

            $retval = mail($to, $subject, $message, $header);


            if ($retval == true) {
                $data['formSuccess'] = "Message sent successfully...";
                $page = (new Page('index', ['formSuccess' => $data['formSuccess']]))->generateContent();
                return new Response($page);
            }

            $data['formError'] = "Message could not be sent...";
            $page = (new Page('index', ['formError' => $data['formError']]))->generateContent();
            return new Response($page);

        }

    }

    public function createComment(): Response
    {
        if ($this->request->getMethod() === "POST") {

            $data = $this->checkPost();

            $post = $this->request->getPost();

            $session = $this->container->get(Session::class);


            if ($data['formError'] !== null) {
                $page = (new Page('post', ['formError' => $data['formError'], 'session' => $session]))->generateContent();
                return new Response($page);

            }
                $commentManager = $this->container->get(CommentManager::class);

                $data['userId'] = $session->getAttribute('id');

                $commentManager->create($data);

                return $this->singlePost($post['postId'], "Votre commentaire viens d'être soumis et sera traité par un administrateur");

        }
    }

}