<?php

namespace models;

use core\Core;
use core\Model;
use core\Utils;

class Users extends Model
{

    public function DeleteUser($id)
    {
        $user = $this->GetUserById($id);
        if (empty($user)) {
            Core::getInstance()->getDB()->delete('table_users', ['id' => $id]);
            $response = [
                'error' => false
            ];
        } else
            $response = [
                'error' => true,
                'messages' => 'Такого користувача не існує'
            ];
        echo json_encode($response);
        die();
    }

    public function GroupTask($userRow)
    {
        $validateResult = $this->ValidateTask($userRow);
        if (is_array($validateResult)) {
            $response = [
                'error' => true,
                'messages' => $validateResult
            ];
        } else {
            $task = $userRow['task'];
            unset($userRow['task']);
            switch ($task) {
                case 1:
                {
                    foreach ($userRow['arr'] as $value) {
                        Core::getInstance()->getDB()->update('table_users', ['status' => '1'], ['id' => $value]);
                    }
                    break;
                }
                case 2:
                {
                    foreach ($userRow['arr'] as $value) {
                        Core::getInstance()->getDB()->update('table_users', ['status' => '0'], ['id' => $value]);
                    }
                    break;
                }
                case 3:
                {
                    foreach ($userRow['arr'] as $value) {
                        Core::getInstance()->getDB()->delete('table_users', ['id' => $value]);
                    }
                }
            }
            $response = [
                'error' => false
            ];
        }
        echo json_encode($response);
        die();
    }

    public function ValidateTask($userRow)
    {
        $errors = [];
        if (empty($userRow['arr']))
            $errors[] = 'Не вибрано жодного користувача';
        if ($userRow['task'] == '0')
            $errors[] = 'Не вибрана групова дія';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function GetUserList()
    {
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "Load") {
                $statement = Core::getInstance()->getDB()->select('table_users', '*');
                $output = '';
                if (!empty($statement)) {
                    foreach ($statement as $row) {
                        $output .= sprintf("
                                               <tr>
                                                    <td class=\"align-middle\">
                                                        <div
                                                                class=\"custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top\">
                                                            <input type=\"checkbox\" class=\"custom-control-input items\"
                                                                  data-id=\"users\" id=\"%s\">
                                                            <label class=\"custom-control-label\" for=\"%s\"></label>
                                                        </div>
                                                    </td>
                                                    <td class=\"text-nowrap align-middle userName\"> %s %s</td>
                                                    <td class=\"text-nowrap align-middle userRole\">
                                                        <span>%s</span>
                                                        </td>     
                                                    <td class=\"text-center align-middle\">
                                                            %s
                                                    </td>
                                                    <td class=\"text-center align-middle\">
                                                        <div class=\"btn-group align-top\">
                                                            <button class=\"btn btn-sm btn-outline-secondary badge edit\"
                                                                    type=\"button\"
                                                                    data-toggle=\"modal\"
                                                                    data-target=\"#user-form-modal\"
                                                                    value=\"%s\">Edit
                                                            </button>
                                                            <button class=\"btn btn-sm btn-outline-secondary badge fa fa-trash delete\"
                                                                    type=\"button\" value=\"%s\"
                                                                 >
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                        ", $row['id'], $row['id'], $row['firstname'], $row['lastname'], $row['role'], $row['status'] == 1 ? '<i class="fa fa-circle active-circle userStatus"></i>' : '<i class="fa fa-circle circle greyCircle userStatus"></i>', $row['id'], $row['id']);
                    }
                } else {
                    $output .= '
                     <tr>
                         <td>No Users</td>
                     </tr>
                    ';
                }
                echo $output;
            }
        }
    }

    public function UpdateUser($userRow)
    {
        $validateResult = $this->ValidateEdit($userRow);
        if (is_array($validateResult)) {
            $response = [
                'error' => true,
                'messages' => $validateResult
            ];
        } else {
            $id = $userRow['id'];
            unset($userRow['id']);
            $fields = ['firstname', 'lastname', 'status', 'role'];
            $RowFiltered = Utils::ArrayFilter($userRow, $fields);
            Core::getInstance()->getDB()->update('table_users', $RowFiltered, ['id' => $id]);
            $response = [
                'error' => false,
            ];
        }
        echo json_encode($response);
        die();
    }

    public function GetUserById($id)
    {
        $user = Core::getInstance()->getDB()->select('users', '*', ['id' => $id]);
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
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function AddUser($userRow)
    {
        $validateResult = $this->Validate($userRow);
        if (is_array($validateResult)) {
            $response = [
                'error' => true,
                'messages' => $validateResult
            ];
        } else {
            $fields = ['firstname', 'lastname', 'status', 'role'];
            $userRowFiltered = Utils::ArrayFilter($userRow, $fields);
            Core::getInstance()->getDB()->insert('table_users', $userRowFiltered);
            $response = [
                'error' => false,
            ];
        }
        echo json_encode($response);
        die();
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