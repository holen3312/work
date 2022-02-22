<?php
namespace models;
use Services\Work;

class Users
{
    private $id;
    private $name;
    private $surname;
    private $login;
    private $hash;
    private $descriprion;
    private $auth_token;
    private $admin_confirmed;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getDescription()
    {
        return $this->descriprion;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getAuthToken(): string
    {
        return $this->auth_token;
    }

    public function getAdminConfirmed()
    {
        return $this->admin_confirmed;
    }

    public static function signUp(array $userData)
    {
        if (empty($userData['name'])) {
            echo 'Hе передано имя';
        }

        if (empty($userData['surname'])) {
            echo 'Hе передана фамилия';
        }

        if (empty($userData['login'])) {
            echo 'Hе передан логин';
        }

        if (empty($userData['password'])) {
            echo 'Hе передан пароль';
        }

        $user = new Users();
        $user->name = $userData['name'];
        $user->surname = $userData['surname'];
        $user->login = $userData['login'];
        $user->hash = password_hash($userData['password'], PASSWORD_DEFAULT);

        $db = new Work();
        $insert = "INSERT INTO work.users (name, surname, login, hash) VALUES ('" . $userData['name'] . "', '" . $userData['surname'] . "', '" . $userData['login'] . "', '" . $user->getHash() . "');";
        $db->query($insert);
        $user->id = $db->getLastInsertId();
    }

    public static function login(array $loginData)
    {
        if (!empty($loginData['login']) and !empty($loginData['password'])) {
            $user = Users::getUserByLogin($loginData['login']);
            if ($user) {
                if (!password_verify($loginData['password'], $user->getHash())) {
                    return null;
                }
            }
            return $user;
        }
    }

    public static function getUserByLogin($login): ?Users
    {
        $db = new Work();
        $sql = "SELECT * FROM work.users WHERE login = '" . $login . "';";
        $result = $db->query($sql, [], Users::class);
        $user = $result[0];
        return $user;
    }

    public static function getById(int $id): ?self
    {
        $db = new Work();
        $entities = $db->query(
            'SELECT * FROM work.users WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;

    }
    public static function createToken(Users $users) : void
    {
        $token =$users->getId() .':' . $users->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }
    public static function getUserByToken(): ?Users
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token))
        {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);
        $user = Users::getById((int)$userId);

        if ($user == null) {
            return null;
        }

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }
        return $user;
    }
    public static function logout()
    {
        setcookie('token', '', 0, '/', '', false, true);
    }
}