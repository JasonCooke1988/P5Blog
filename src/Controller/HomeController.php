<?php

namespace App\Controller;

use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use Exception;


class HomeController extends AbstractController
{

    /**
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        $container = Container::getInstance();


        $page = (new Page('index'))->generateContent();

        return new Response($page);
    }

    public function singlePost(string $id): Response
    {

        $container = Container::getInstance();
        $postManager = $container->get(PostManager::class);
        $commentManager = $container->get(CommentManager::class);

        $comments = $commentManager->getAll($id);
        $post = $postManager->getOne($id,$comments);

        $page = (new Page('post', ['post' => $post]))->generateContent();

        return new Response($page);
    }

    public function allPost(): Response
    {
        $container = Container::getInstance();

        $postManager = $container->get(PostManager::class);

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

            } else {
                $to = "jason.cooke@hotmail.fr";
                $subject = "Message de contact depuis P5 blog";

                $message = "<b>Message recue du formulaire de contact sur P5 Blog</b>";
                $message .= "Auteur du message : " . $data['fname'] . " " . $data['lname'];
                $message .= $data['message'];

                $header = "From:".$data['email']." \r\n";

                $retval = mail ($to,$subject,$message,$header);


                if( $retval == true ) {
                    $data['formSuccess'] = "Message sent successfully...";
                    $page = (new Page('index', ['formSuccess' => $data['formSuccess']]))->generateContent();
                }else {
                    $data['formError'] =  "Message could not be sent...";
                    $page = (new Page('index', ['formError' => $data['formError']]))->generateContent();
                }
            }

            return new Response($page);
        }

    }

    public function createComment()
    {
        if ($this->request->getMethod() === "POST") {

            $data = $this->checkPost();

            if ($data['formError'] !== null) {
                $page = (new Page('post', ['formError' => $data['formError']]))->generateContent();
                return new Response($page);

            } else {
                $data['userId'] = $_SESSION['id'];
                $container = Container::getInstance();
                $commentManager = $container->get(CommentManager::class);
                $commentManager->create($data);

                $page = (new Page('post', ['formSuccess' => 'Votre commentaire viens d\'etre soumis et sera traité par l\'admin']))->generateContent();
                return new Response($page);
            }
        }
    }

}