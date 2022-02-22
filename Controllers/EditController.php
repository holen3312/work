<?php
namespace Controllers;

use models\Upload;
use View\View;
use models\Users;

class EditController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../');
    }

    public function edit()
    {
        if(!empty($_POST)) {
            Upload::editComments($_POST);
        }
        $this->view->renderHtml('templates/edit.php');
    }
}