<?php
namespace Controllers;
use models\Users;
use View\View;

class RegistrationController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../');
    }

    public function signUp()
    {
        if(!empty($_POST)) {
            $user = Users::signUp($_POST);
        }

        $this->view->renderHtml('templates\form.php');
    }
}