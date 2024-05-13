<?php

namespace Models;

use PDO;

class UserModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
