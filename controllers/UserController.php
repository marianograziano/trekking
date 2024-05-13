<?php


namespace Controllers;
use Models\UserModel;

class UserController {
    private $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function authenticate($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && ($password === $user['password'])) {
            return $user;
        } else {
            error_log('Autenticación fallida para el usuario: ' . $username);
            return false;
        }
    }

  
}
