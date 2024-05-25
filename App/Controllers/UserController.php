<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\User;
use App\Helpers\Redirector;

class UserController extends Controller {
    private $conn;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->user = new User($this->conn);
    }

    public function index() {
        $stmt = $this->user->read();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Pasar los usuarios a la vista
        include dirname(__DIR__, 1) . '/Views/admin/users/index.php';
    }

    public function create() {
        include dirname(__DIR__, 1) . '/Views/admin/users/create.php';
    }

    public function store($data) {
        $this->user->username = $data['username'];
        $this->user->password = $data['password'];
        $this->user->email = $data['email'];
        $this->user->role = $data['role'];

        if ($this->user->create()) {
            $_SESSION['toast'] = [
                'message' => 'Usuario creado exitosamente.',
                'type' => 'success'
            ];
            Redirector::redirect('/public/admin/index.php/users');
        } else {
            $_SESSION['toast'] = [
                'message' => 'Error al crear el usuario.',
                'type' => 'error'
            ];
            Redirector::redirect('/public/admin/index.php/users');
        }
    }

    public function edit($id) {
        $this->user->id = $id;
        $this->user->readOne();
        
        include dirname(__DIR__, 1) . '/Views/admin/users/edit.php';
    }

    public function update($id, $data) {
        $this->user->id = $id;
        $this->user->username = $data['username'];
        $this->user->password = $data['password'];
        $this->user->email = $data['email'];
        $this->user->role = $data['role'];

        if ($this->user->update()) {
            $_SESSION['toast'] = [
                'message' => 'Usuario actualizado exitosamente.',
                'type' => 'success'
            ];
            Redirector::redirect('/public/admin/index.php/users');
        } else {
            $_SESSION['toast'] = [
                'message' => 'Error al actualizar el usuario.',
                'type' => 'error'
            ];
            Redirector::redirect('/public/admin/index.php/users');
        }
    }

    public function delete($id) {
        $this->user->id = $id;
        if ($this->user->delete()) {
            $_SESSION['toast'] = [
                'message' => 'Usuario eliminado exitosamente.',
                'type' => 'success'
            ];
            Redirector::redirect('/public/admin/index.php/users');
        } else {
            $_SESSION['toast'] = [
                'message' => 'Error al eliminar el usuario.',
                'type' => 'error'
            ];
            Redirector::redirect('/public/admin/index.php/users');
        }
    }
}
?>
