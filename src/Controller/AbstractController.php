<?php

namespace App\Controller;

use App\Core\CleanInput;
use App\Core\Container;
use App\Core\Page;
use App\Core\Request;
use App\Core\Response;

abstract class AbstractController
{

    protected string $emailError = "Veuillez renseigner une adresse e-mail.";
    protected string $fnameError = "Veuillez renseigner un prénom";
    protected string $lnameError = "Veuillez renseigner un nom";
    protected string $passError = "Veuillez renseigner un mot de passe";
    protected string $samePassError = "Les mots de passe saisie ne sont pas valide";
    protected string $messageError = "Veuillez renseigner un message";

    /**
     * @var Request
     */
    protected Request $request;
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * AbstractController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)

    {
        $this->container = Container::getInstance();
        $this->request = $request;
    }

    public function createNotFoundResponse(): Response
    {
        return new Response('', 404);
    }

    public function createAccessDeniedResponse(): Response
    {
        return new Response('', 403);
    }

    public function createNotAuthorizedResponse(): Response
    {
        return new Response('', 401);
    }

    public function redirect($page)
    {
        $url = $this->container->get('base.path');
        header('Location: ' . $url . $page);
    }

    public function checkPost(): array
    {
        $data = [];
        $data['formError'] = null;
        $post = $this->request->getpost();

        foreach ($post as $key => $val) {
            if (empty($post[$key])) {
                switch ($key) {
                    case 'email':
                        $data['formError'] = $this->emailError;
                        break;
                    case 'fname':
                        $data['formError'] = $this->fnameError;
                        break;
                    case 'lname':
                        $data['formError'] = $this->lnameError;
                        break;
                    case 'password':
                    case 'password2':
                        $data['formError'] = $this->passError;
                        break;
                    case 'message':
                        $data['formError'] = $this->messageError;
                        break;
                }
            }

            if ($key !== "password" && $key !== "password2") {
                $data[$key] = $this->cleanPost($post[$key]);
            } else {
                $data[$key] = $post[$key];
            }

        }

        if (isset($data['password']) && isset($data['password2']) && $data['password'] !== $data['password2']) {
            $data['formError'] = $this->samePassError;
        }

        return $data;
    }

    public function cleanPost($data): string
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function unAuthorized(): Response
    {
        $page = (new Page('unauthorized'))->generateContent();
        return new Response($page);
    }
}