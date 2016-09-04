<?php

namespace Rumguru\Repositories;

use Nette\Security\Passwords;
use Nette\Utils\DateTime;

class UserRepository extends BaseRepository
{

    public function getUserById($userId)
    {
        $res = $this->database->query("SELECT * FROM users WHERE id = ?", $userId);
        return $res->fetch();
    }

    public function getUserByNickname($nickname)
    {
        $res = $this->database->query("SELECT * FROM users WHERE nickname = ?", $nickname);
        return $res->fetch();
    }

    public function getUserForLogin($login)
    {
        $res = $this->database->query("SELECT * FROM users WHERE nickname = ? OR email = ?", $login, $login);
        return $res->fetch();
    }

    public function createUser($email, $nickname, $password)
    {
        $data = [
            'nickname' => $nickname,
            'email' => $email,
            'password' => Passwords::hash($password),
            'created' => new DateTime(),
        ];
        $this->database->table('users')->insert($data);
    }

    public function updateUser($userId, $data)
    {
        $this->database->table('users')->where('id', $userId)->update($data);
    }


}