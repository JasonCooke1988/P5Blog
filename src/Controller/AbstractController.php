<?php

namespace App\Controller;

use App\Core\CleanInput;
use App\Core\Container;
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
     * AbstractController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
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
        $container = Container::getInstance();
        $url = $container->get('base.path');
        header('Location: ' . $url . $page);
        die();
    }

    public function checkPost()
    {
        $data = [];
        $data['formError'] = null;

        foreach ($_POST as $key => $val) {
            if (empty($_POST[$key])) {
                if ($key === "email") {
                    $data['formError'] = $this->emailError;
                } elseif ($key === "fname") {
                    $data['formError'] = $this->fnameError;
                } elseif ($key === "lname") {
                    $data['formError'] = $this->lnameError;
                } elseif ($key === "password" || $key === "password2") {
                    $data['formError'] = $this->passError;
                } elseif ($key === "message") {
                    $formError = $this->messageError;
                }
            } else {
                $data[$key] = $this->cleanPost($_POST[$key]);
            }
        }

        if (isset($data['password']) && isset($data['password2']) && $data['password'] !== $data['password2']) {
            $data['formError'] = $this->samePassError;
        }

        return $data;
    }

    public function cleanPost($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}