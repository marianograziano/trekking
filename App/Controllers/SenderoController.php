<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Sendero;
use App\Helpers\Redirector;

class SenderoController extends Controller {
    private $conn;
    private $sendero;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->sendero = new Sendero($this->conn);
    }

    public function index() {
        $stmt = $this->sendero->read();
        $senderos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        include dirname(__DIR__, 1) . '/Views/admin/senderos/index.php';
    }

    public function create() {
        include dirname(__DIR__, 1) . '/Views/admin/senderos/create.php';
    }

    public function store($data) {
        $this->sendero->nombre = $data['nombre'];
        $this->sendero->descripcion = $data['descripcion'];
        $this->sendero->id_provincia = $data['id_provincia'];
        $this->sendero->id_localidad = $data['id_localidad'];
        $this->sendero->gpx_file = $data['gpx_file'];

        if ($this->sendero->create()) {
            $_SESSION['toast'] = [
                'message' => 'Sendero creado exitosamente.',
                'type' => 'success'
            ];
            Redirector::redirect('/public/admin/index.php/senderos');
        } else {
            $_SESSION['toast'] = [
                'message' => 'Error al crear el sendero.',
                'type' => 'error'
            ];
            Redirector::redirect('/public/admin/index.php/senderos');
        }
    }

    public function edit($id) {
        $this->sendero->id = $id;
        $this->sendero->readOne();

        include dirname(__DIR__, 1) . '/Views/admin/senderos/edit.php';
    }

    public function update($id, $data) {
        $this->sendero->id = $id;
        $this->sendero->nombre = $data['nombre'];
        $this->sendero->descripcion = $data['descripcion'];
        $this->sendero->id_provincia = $data['id_provincia'];
        $this->sendero->id_localidad = $data['id_localidad'];
        $this->sendero->gpx_file = $data['gpx_file'];

        if ($this->sendero->update()) {
            $_SESSION['toast'] = [
                'message' => 'Sendero actualizado exitosamente.',
                'type' => 'success'
            ];
            Redirector::redirect('/public/admin/index.php/senderos');
        } else {
            $_SESSION['toast'] = [
                'message' => 'Error al actualizar el sendero.',
                'type' => 'error'
            ];
            Redirector::redirect('/public/admin/index.php/senderos');
        }
    }

    public function delete($id) {
        $this->sendero->id = $id;
        if ($this->sendero->delete()) {
            $_SESSION['toast'] = [
                'message' => 'Sendero eliminado exitosamente.',
                'type' => 'success'
            ];
            Redirector::redirect('/public/admin/index.php/senderos');
        } else {
            $_SESSION['toast'] = [
                'message' => 'Error al eliminar el sendero.',
                'type' => 'error'
            ];
            Redirector::redirect('/public/admin/index.php/senderos');
        }
    }
}
?>
