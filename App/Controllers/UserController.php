<?php

namespace App\Controllers;

use App\Config\Database;

class UserController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function index() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $viewPath = dirname(__DIR__, 1) . '/Views/admin/users/index.php';
        var_dump($viewPath);
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "File not found or not readable: " . $viewPath;
        }
    }

    public function create() {
        $viewPath = dirname(__DIR__, 1) . '/Views/admin/users/create.php';
        var_dump($viewPath);
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "File not found: " . $viewPath;
        }
    }

    public function store($data) {
        $query = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':role', $data['role']);
        
        if ($stmt->execute()) {
            header("Location: /public/admin/users");
            exit();
        } else {
            echo "Error al guardar el usuario.";
        }
    }

    public function edit($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        $viewPath = dirname(__DIR__, 2) . '/Views/admin/users/edit.php';
        var_dump($viewPath);
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "File not found: " . $viewPath;
        }
    }

    public function update($id, $data) {
        $query = "UPDATE users SET username = :username, password = :password, email = :email, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':role', $data['role']);
        
        if ($stmt->execute()) {
            header("Location: /public/admin/users");
            exit();
        } else {
            echo "Error al actualizar el usuario.";
        }
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            header("Location: /public/admin/users");
            exit();
        } else {
            echo "Error al eliminar el usuario.";
        }
    }
}
