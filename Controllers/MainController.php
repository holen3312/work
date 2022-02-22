<?php
namespace Controllers;
use View\View;
use models\Users;

class MainController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../');
    }

    public function main()
    {
        $user = Users::getUserByToken();
        $this->view->renderHtml('templates/mainpage.php', ['user' => $user]);
    }

    public function login()
    {
        if (!empty($_POST)) {
            $user = Users::login($_POST);
            Users::createToken($user);
            header('Location: /');
            exit();
        }
        $this->view->renderHtml('templates/autorizathion.php');
    }

    public function logout()
    {
        if (!empty($_COOKIE['token'])) {
            Users::logout();
            header('Location: /');
            exit();
        }
    }


}