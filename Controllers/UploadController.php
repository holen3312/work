<?php
namespace Controllers;

use View\View;
use models\Users;
use models\Upload;

class UploadController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../');
    }

    public function upload()
    {
        $error = '';
        $result = '';
        if (!empty($_FILES['attachment'])) {
            $file = $_FILES['attachment'];
            $file['comment'] = $_POST['comment'];
            $fileName = $file['name'];
            $filePath = __DIR__ . '/../uploads/' . $fileName;
            $fileSize = $file['size'];


            $allowedExtensions = ['jpg', 'png', 'gif'];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $limitBytes = 1024 * 1024 * 80;

            if ($fileSize > $limitBytes) {
                $error = 'файл слишком большой';
            } elseif (!in_array($extension, $allowedExtensions)) {
                $error = 'недопустимый формат файла';
            } elseif ($file['error'] !== UPLOAD_ERR_OK) {
                $error = 'ошибка при загрузке файла';
            } elseif (file_exists($filePath)) {
                $error = 'файл с таким именем уже существует';
            } elseif (!move_uploaded_file($file['tmp_name'], $filePath)) {
                $error = 'ошибка при загрузке файла';
            } elseif (!Users::getUserByToken()) {
                $error = 'Авторизируйтесь, пожалуйста';
            } else {
                $result = $fileName . ' успешно отправлен';
                Upload::fileUpload($file);
            }
        }
        $this->view->renderHtml('templates/upload.php', ['error' => $error, 'result' => $result]);
    }

    public function showFile()
    {
        $files = scandir(__DIR__ . '/../uploads');

        $links = [];
        foreach ($files as $fileName) {
            if ($fileName === '.' || $fileName === '..') {
                continue;
            }
            $links[] = 'uploads/' . $fileName;
        }
        $comments = [];
        foreach (Upload::getComments() as $upload) {
            $comments[] = [
                'comment' => $upload->getComment(),
                'name' => $upload->getFileName(),
                'user_id' => $upload->getUserId(),
                'id' => $upload->getId(),
            ];
        }
        if (!empty($_COOKIE['token'])) {
            $user_id = Users::getUserByToken()->getId();
            $is_admin = Users::getUserByToken()->getAdminConfirmed();
        } else {
            $user_id = '';
            $is_admin = '';
        }
        $this->view->renderHtml('templates/albom.php', ['links' => $links, 'comments' => $comments, 'user_id' => $user_id, 'is_admin' => $is_admin]);

    }

    public function edit(int $commentId)
    {
        $comment = Upload::getById($commentId);
//        var_dump($comment);
        if(!empty($_POST)) {
            $comment->editComments($_POST, $commentId);
            $comment->setComment($_POST['newComment']);
            $comment->setDateModified(date('Y-m-d H:i:s'));
        }
        $this->view->renderHtml('templates/edit.php');
    }

    public function delete(int $id)
    {
        if ($delete = Upload::getById($id)) {
        Upload::delete($id);

        unlink(__DIR__ . '/../uploads/' . $delete->getFileName() );
        }
        $this->view->renderHtml('templates/delete.php');
    }

}
