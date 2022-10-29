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
        $this->usersModel->AddUser($_POST);
    }

    public function actionTask()
    {
        $this->usersModel->GroupTask($_POST);
    }

    public function actionEdit()
    {
        $this->usersModel->UpdateUser($_POST);
    }

    public function actionDelete()
    {
        $this->usersModel->DeleteUser($_POST);
    }

    public function actionIndex()
    {
        return $this->render('index', null, $this->params);
    }

    public function actionList()
    {
        $this->usersModel->GetUserList();
    }

}