<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '/var/www/html/');
require_once 'config/Database.php';

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase {
    public function testGetConnection() {
        $database = new Database();

        $conn = $database->getConnection();

        $this->assertInstanceOf(\PDO::class, $conn);
    }
}