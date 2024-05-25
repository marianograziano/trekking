<?php

namespace App\Models;

use PDO;

class Sendero {
    private $conn;
    private $table_name = "senderos";

    public $id;
    public $nombre;
    public $descripcion;
    public $id_provincia;
    public $id_localidad;
    public $gpx_file;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT s.*, p.nombre AS provincia, l.nombre AS localidad FROM " . $this->table_name . " s
                  JOIN provincias p ON s.id_provincia = p.id
                  JOIN localidades l ON s.id_localidad = l.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, descripcion, id_provincia, id_localidad, gpx_file) VALUES (:nombre, :descripcion, :id_provincia, :id_localidad, :gpx_file)";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->id_provincia = htmlspecialchars(strip_tags($this->id_provincia));
        $this->id_localidad = htmlspecialchars(strip_tags($this->id_localidad));
        $this->gpx_file = htmlspecialchars(strip_tags($this->gpx_file));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id_provincia', $this->id_provincia);
        $stmt->bindParam(':id_localidad', $this->id_localidad);
        $stmt->bindParam(':gpx_file', $this->gpx_file);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nombre = $row['nombre'];
        $this->descripcion = $row['descripcion'];
        $this->id_provincia = $row['id_provincia'];
        $this->id_localidad = $row['id_localidad'];
        $this->gpx_file = $row['gpx_file'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, descripcion = :descripcion, id_provincia = :id_provincia, id_localidad = :id_localidad, gpx_file = :gpx_file WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->id_provincia = htmlspecialchars(strip_tags($this->id_provincia));
        $this->id_localidad = htmlspecialchars(strip_tags($this->id_localidad));
        $this->gpx_file = htmlspecialchars(strip_tags($this->gpx_file));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id_provincia', $this->id_provincia);
        $stmt->bindParam(':id_localidad', $this->id_localidad);
        $stmt->bindParam(':gpx_file', $this->gpx_file);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
