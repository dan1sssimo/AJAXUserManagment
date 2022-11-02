<?php

namespace models;

use core\Core;
use core\Model;

class Users extends Model
{
    public function SelectAllUserFromDB()
    {
        return Core::getInstance()->getDB()->select('table_users', '*');
    }

    public function AddUserToDB($userRow)
    {
        return Core::getInstance()->getDB()->insert('table_users', $userRow);
    }

    public function DeleteUserFromDB($userRow)
    {
        Core::getInstance()->getDB()->delete('table_users', ['id' => $userRow['id']]);
    }

    public function UpdateUserInDB($userRow)
    {
        $id = $userRow['id'];
        unset($userRow['id']);
        Core::getInstance()->getDB()->update('table_users', $userRow, ['id' => $id]);
    }

    public function GroupTaskSetActive($userRow)
    {
        foreach ($userRow['arr'] as $value) {
            Core::getInstance()->getDB()->update('table_users', ['status' => '1'], ['id' => $value]);
        }
    }

    public function GroupTaskSetNotActive($userRow)
    {
        foreach ($userRow['arr'] as $value) {
            Core::getInstance()->getDB()->update('table_users', ['status' => '0'], ['id' => $value]);
        }
    }

    public function GroupTaskDelete($userRow)
    {
        foreach ($userRow['arr'] as $value) {
            Core::getInstance()->getDB()->delete('table_users', ['id' => $value]);
        }
    }

    public function ValidateTask($userRow)
    {
        $count = 0;
        $errors = [];
        if (empty($userRow['arr']))
            $errors[] = 'Не вибрано жодного користувача';
        if ($userRow['task'] == '0')
            $errors[] = 'Не вибрана групова дія';
        if ($userRow['arr']) {
            foreach ($userRow['arr'] as $value) {
                $user = $this->GetUserById($value);
                if (empty($user)) {
                    $count += 1;
                }
            }
        }
        if ($count != 0) {
            $errors[] = "Помилка операції, вибрано $count не існуючих юзерів.";
        }
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function GetUserById($id)
    {
        $user = Core::getInstance()->getDB()->select('table_users', '*', ['id' => $id]);
        if (count($user) > 0)
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
        if ($formRow['role'] == 'Select role')
            $errors[] = 'Поле "role" не може бути порожнім';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function ValidateEdit($formRow)
    {
        $errors = [];
        if (empty($formRow['firstname']))
            $errors[] = 'Поле "firstname" не може бути порожнім';
        if (empty($formRow['lastname']))
            $errors[] = 'Поле "lastname" не може бути порожнім';
        if ($formRow['role'] == 'Select role')
            $errors[] = 'Поле "role" не може бути порожнім';
        $user = $this->GetUserById($formRow['id']);
        if (empty($user)) {
            $errors[] = 'Такого користувача не існує';
        }
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function GetUserByName($firstName, $lastName)
    {
        $rows = Core::getInstance()->getDB()->select('table_users', '*',
            ['firstname' => $firstName, 'lastname' => $lastName]);
        if (count($rows) > 0)
            return $rows[0];
        else
            return null;
    }

}