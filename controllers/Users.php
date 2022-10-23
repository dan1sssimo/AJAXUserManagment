<?php

namespace controllers;

use core\Controller;

class Users extends Controller
{
    protected $usersModel;
    protected $params = [
        'MainTitle' => 'UsersTable',
    ];

    function __construct()
    {
        $this->usersModel = new \models\Users();
    }

    public function actionAdd()
    {

        $result = $this->usersModel->AddUser($_POST);
        $users = $this->usersModel->GetAllUsers();
        if ($result['error'] === false) {
            return $this->render('index', ['users' => $users], $this->params);
        } else {
            $message = implode('<br/>', $result['messages']);
            return $this->render('index', ['model' => $_POST, 'users' => $users], [
                $this->params,
                'MessageText' => $message,
                'MessageClass' => 'danger'
            ]);
        }
    }

    public function actionTask()
    {
        $result = $this->usersModel->GroupTask($_POST);
        $users = $this->usersModel->GetAllUsers();
        if ($result['error'] === false) {
            return $this->render('index', ['users' => $users], $this->params);
        } else {
            $message = implode('<br/>', $result['messages']);
            return $this->render('index', ['model' => $_POST, 'users' => $users], [
                $this->params,
                'MessageText' => $message,
                'MessageClass' => 'danger'
            ]);
        }
    }

    public function actionEdit()
    {
        $result = $this->usersModel->UpdateUser($_POST);
        $users = $this->usersModel->GetAllUsers();
        if ($result['error'] === false) {
            return $this->render('index', ['users' => $users], $this->params);
        } else {
            $message = implode('<br/>', $result['messages']);
            return $this->render('index', ['model' => $_POST, 'users' => $users], [
                $this->params,
                'MessageText' => $message,
                'MessageClass' => 'danger'
            ]);
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];
        $result = $this->usersModel->DeleteUser($id);
        $users = $this->usersModel->GetAllUsers();
        if ($result['error'] === false) {
            return $this->render('index', ['users' => $users], $this->params);
        } else {
            $message = implode('<br/>', $result['messages']);
            return $this->render('index', ['model' => $_POST, 'users' => $users], [
                $this->params,
                'MessageText' => $message,
                'MessageClass' => 'danger'
            ]);
        }
    }


    public function actionIndex()
    {
        $users = $this->usersModel->GetAllUsers();
        return $this->render('index', ['users' => $users], $this->params);
    }

}