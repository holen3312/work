<?php
namespace models;
use Services\Work;
use models\Users;

class Upload
{
    private $id;
    private $file_name;
    private $date_added;
    private $date_modified;
    private $user_id;
    private $comment;

    public function getComment()
    {
        return $this->comment;
    }

    public function getFileName()
    {
        return $this->file_name;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    public function setDateModified($date_modified): void
    {
        $this->date_modified = $date_modified;
    }

    public static function fileUpload(array $uploadData)
    {
        $user = Users::getUserByToken();
        $upload = new Upload();
        $upload->file_name = $uploadData['name'];
        $upload->date_added = date('Y-m-d H:i:s');
        $upload->date_modified = date('Y-m-d H:i:s');
        $upload->user_id = $user->getId();
        $upload->comment = $uploadData['comment'];

        $db = new Work();
        $insert = "INSERT INTO work.uploads (file_name, date_added, date_modified, user_id, comment) VALUES ('" . $uploadData['name'] . "' , '" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "','" . $user->getId() . "','" . $uploadData['comment'] . "')";
        $db->query($insert);
    }

    public static function getComments()
    {
        $upload = new Upload();
        $db = new Work();
        $sql = "SELECT id, file_name, comment, user_id FROM work.uploads;";
        $upload = $db->query($sql, [], Upload::class);
        return $upload;
    }

    public static function editComments(array $editData, $id)
    {
        if (empty($editData['newComment'])) {
            echo 'Bнесите изменения!';
        } else {
            $db = new Work();
            $sql = "UPDATE work.uploads SET comment = '" . $editData['newComment'] . "', date_modified = '" . date('Y-m-d H:i:s') . "' WHERE id = '" . $id . "';";
            $db->query($sql);
        }
    }

    public static function getById(int $id): ?self
    {
        $db = new Work();
        $entities = $db->query(
            "SELECT * FROM work.uploads WHERE id = '" . $id . "';",
            [],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    public static function delete($id)
    {
        $db = new Work();
        $delete = $db->query("DELETE FROM work.uploads WHERE id = '" . $id . "';", [], static::class);
    }

}