<?php


namespace App\Controller;


use App\Core\Container;
use App\Core\Page;
use App\Core\Response;
use App\Manager\UserManager;
use App\Model\User;
use App\Service\Session;

class UserController extends AbstractController
{

    public function loginPage(): Response
    {
        $page = (new Page('login'))->generateContent();

        return new Response($page);
    }


    public function create(): Response
    {
        if ($this->request->getMethod() === "POST") {

            $data = $this->checkPost();

            if ($data['formError'] !== null) {
                $page = (new Page('login', ['createError' => $data['formError']]))->generateContent();

            } else {
                $userManager = $this->container->get(UserManager::class);
                if ($userManager->exists($data['email'])) {
                    $page = (new Page('login', ['createError' => 'Cet adresse e-mail est déjà associé à un compte']))->generateContent();
                } else {
                    $userManager->create($data);
                    $page = (new Page('login', ['createSuccess' => 'Félicitations votre compte à été créer.']))->generateContent();
                }
            }

        } else {

            $page = (new Page('login', ['createError' => 'Veuillez remplir tous les champs du formulaire']));
        }

        return new Response($page);

    }

    public function login(): Response
    {
        if ($this->request->getMethod() === "POST") {

            $data = $this->checkPost();

            if ($data['formError'] !== null) {
                $page = (new Page('login', ['loginError' => $data['formError']]))->generateContent();

            } else {
                $userManager = $this->container->get(UserManager::class);
                if (!$userManager->exists($data['email'])) {
                    $page = (new Page('login', ['loginError' => 'Cet adresse e-mail n\'est pas associé à un compte']))->generateContent();
                } else {
                    $session = $this->container->get(Session::class);

                    $user = $userManager->login($data);

                    if ($user instanceof User) {

                        if ($userManager->isAdmin($data['email']) === 1) {
                            $session->setAdmin();
                        } else {
                            $session->setAdmin(false);
                        }

                        $session->setAttributes($user);
                        $page = (new Page('user-page',['user' => $user, 'session' => $session]))->generateContent();


                    } else {
                        $page = (new Page('login', ['loginError' => 'Mot de passe invalide']))->generateContent();
                    }

                }
            }

        } else {
            $page = (new Page('login', ['loginError' => 'Veuillez remplir tous les champs du formulaire']))->generateContent();
        }
        return new Response($page);
    }

}