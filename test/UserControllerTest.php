<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '/var/www/html/');
require_once 'config/Database.php';

use PHPUnit\Framework\TestCase;
use Models\UserModel;
use Controllers\UserController;

class UserControllerTest extends TestCase {
    public function testAuthenticateSuccessful() {
        $userModel = $this->createMock(UserModel::class);
        $userModel->method('getUserByUsername')->willReturn([
            'username' => 'testuser',
            'password' => password_hash('testpassword', PASSWORD_DEFAULT)
        ]);

        $controller = new UserController($userModel);
        $result = $controller->authenticate('testuser', 'testpassword');

        $this->assertIsArray($result);
    }

    public function testAuthenticateFail() {
        $userModel = $this->createMock(UserModel::class);
        $userModel->method('getUserByUsername')->willReturn(false);

        $controller = new UserController($userModel);
        $result = $controller->authenticate('nonexistentuser', 'password');

        $this->assertFalse($result);
    }
}
