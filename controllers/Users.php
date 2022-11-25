<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Utils;

class Users extends Controller
{
    protected $usersModel;
    protected $params = [
        'MainTitle' => 'UsersTable',
    ];
    protected $role = ['User' => 1, 'Admin' => 2];

    function __construct()
    {
        $this->usersModel = new \models\Users();
    }

    public function actionAdd()
    {
        if ($this->isPost()) {
            $userRow = $_POST;
            $validateResult = $this->usersModel->Validate($userRow);
            if (is_array($validateResult)) {
                $response = [
                    'status' => false,
                    'error' => ['code' => 100, 'message' => $validateResult],
                ];
                echo json_encode($response);
                die();
            }
            $textRole = $userRow['role'];
            $userRow['role'] = $this->role[$userRow['role']];
            $fields = ['firstname', 'lastname', 'status', 'role'];
            $userRowFiltered = Utils::ArrayFilter($userRow, $fields);
            $id = $this->usersModel->AddUserToDB($userRowFiltered);
            $response = [
                'status' => true,
                'error' => null,
                'user' => ['id' => $id,
                    'firstname' => $userRowFiltered['firstname'],
                    'lastname' => $userRowFiltered['lastname'],
                    'status' => $userRowFiltered['status'],
                    'role' => $textRole
                ]];
            echo json_encode($response);
            die();
        } else   return $this->render('notfound/index', null, $this->params);
    }

    public function actionTask()
    {
        if ($this->isPost()) {
            $userRow = $_POST;
            $validateResult = $this->usersModel->ValidateTask($userRow);
            if (is_array($validateResult)) {
                $response = [
                    'status' => false,
                    'error' => ['code' => 100, 'message' => $validateResult]
                ];
                echo json_encode($response);
                die();
            }
            $task = $userRow['task'];
            unset($userRow['task']);
            switch ($task) {
                case 1:
                {
                    $this->usersModel->GroupTaskSetActive($userRow);
                    break;
                }
                case 2:
                {
                    $this->usersModel->GroupTaskSetNotActive($userRow);
                    break;
                }
                case 3:
                {
                    $this->usersModel->GroupTaskDelete($userRow);
                }
            }
            $response = [
                'status' => true,
                'error' => null,
                'user' => $userRow['arr']
            ];
            echo json_encode($response);
            die();
        } else   return $this->render('notfound/index', null, $this->params);
    }

    public function actionEdit()
    {
        if ($this->isPost()) {
            $userRow = $_POST;
            $validateResult = $this->usersModel->ValidateEdit($userRow);
            if (is_array($validateResult)) {
                $response = [
                    'status' => false,
                    'error' => ['code' => 100, 'message' => $validateResult]
                ];
                echo json_encode($response);
                die();
            }
            $textRole = $userRow['role'];
            $userRow['role'] = $this->role[$userRow['role']];
            $id = $userRow['id'];
            $fields = ['firstname', 'lastname', 'status', 'role'];
            $RowFiltered = Utils::ArrayFilter($userRow, $fields);
            $this->usersModel->UpdateUserInDB($userRow);
            $response = [
                'status' => true,
                'error' => null,
                'user' => ['id' => $id,
                    'firstname' => $RowFiltered['firstname'],
                    'lastname' => $RowFiltered['lastname'],
                    'status' => $RowFiltered['status'],
                    'role' => $textRole
                ]
            ];
            echo json_encode($response);
            die();
        } else   return $this->render('notfound/index', null, $this->params);
    }

    public
    function actionDelete()
    {
        if ($this->isPost()) {
            $userRow = $_POST;
            $user = $this->usersModel->GetUserById($userRow['id']);
            if (empty($user)) {
                $response = [
                    'status' => false,
                    'error' => ['code' => 100, 'message' => 'Такого користувача не існує']
                ];
                echo json_encode($response);
                die();
            }
            $this->usersModel->DeleteUserFromDB($userRow);
            $response = [
                'status' => true,
                'error' => null,
                'user' => ['id' => $userRow['id']]
            ];
            echo json_encode($response);
            die();
        } else   return $this->render('notfound/index', null, $this->params);
    }

    public
    function actionIndex()
    {
        return $this->render('index', null, $this->params);
    }

    public
    function actionList()
    {
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "Load") {
                $statement = $this->usersModel->SelectAllUserFromDB();
                $response = [
                    'status' => true,
                    'error' => null,
                    'user' => $statement
                ];
                echo json_encode($response);
                die();
            }
        }
    }

}