<?php

namespace models;

use core\Model;
use core\Utils;

class Users extends Model
{

    public function DeleteUser($id)
    {
        \core\Core::getInstance()->getDB()->delete('table_users', ['id' => $id]);
    }

    public function GetAllUsers()
    {
        $users = \core\Core::getInstance()->getDB()->select('table_users', '*');
        if (!empty($users))
            return $users;
        else
            return null;
    }

    public function UpdateUser($row)
    {
        $id = $row['id'];
        unset($row['id']);
        $fields = ['firstname', 'lastname', 'status', 'role'];
        $RowFiltered = Utils::ArrayFilter($row, $fields);
        \core\Core::getInstance()->getDB()->update('table_users', $RowFiltered, ['id' => $id]);
    }

    public function GetUserById($id)
    {
        $user = \core\Core::getInstance()->getDB()->select('users', '*', ['id' => $id]);
        if (!empty($user))
            return $user[0];
        else
            return null;
    }

    public function Validate($formRow)
    {
        $errors = [];
        if (empty($formRow['firstname']))
            $errors[] = 'Поле "firstname" не може бути порожнім';
        if (empty($formRow['lastname']))
            $errors[] = 'Поле "lastname" не може бути порожнім';
        $user = $this->GetUserByName($formRow['firstname'], $formRow['lastname']);
        if (!empty($user))
            $errors[] = 'Користувач з вказаним firstname та lastname вже існує';
        if (empty($formRow['status']))
            $errors[] = 'Поле "status" не може бути порожнім';
        if (empty($formRow['role']))
            $errors[] = 'Поле "role" не може бути порожнім';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function IsUserAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public function GetCurrentUser()
    {
        if ($this->IsUserAuthenticated())
            return $_SESSION['user'];
        else
            return null;
    }

    public function AddUser($userRow)
    {
        $fields = ['firstname', 'lastname', 'status', 'role'];
        $userRowFiltered = Utils::ArrayFilter($userRow, $fields);
        \core\Core::getInstance()->getDB()->insert('table_users', $userRowFiltered);
    }

    public function AuthUser($login, $password)
    {
        $password = md5($password);
        $users = \core\Core::getInstance()->getDB()->select('users', '*', [
            'login' => $login,
            'password' => $password
        ]);
        if (count($users) > 0) {
            $user = $users[0];
            return $user;
        } else
            return false;
    }

    public function GetUserByName($firstName, $lastName)
    {
        $rows = \core\Core::getInstance()->getDB()->select('table_users', '*',
            ['first_name' => $firstName, 'last_name' => $lastName]);
        if (count($rows) > 0)
            return $rows[0];
        else
            return null;
    }

}