<?php
include_once '../config/database.php';
include_once '../models/Incidencia.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class IncidenciaController {
    private $conn;
    private $incidencia;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->incidencia = new Incidencia($this->conn);
    }
    
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->incidencia->titol = $_POST['titol'];
            $this->incidencia->descripcio = $_POST['descripcio'];
            $this->incidencia->prioritat = $_POST['prioritat'];
            $this->incidencia->estat = "pendent";
            $this->incidencia->id_usuari = $_POST['id_usuari'];
            $this->incidencia->id_tipo_incidencia = $_POST['id_tipo_incidencia'];
            $this->incidencia->id_usuari_creacio = $_POST['id_usuari_creacio'];

            if ($this->incidencia->crear()) {
                header('Location: ../public/index.php?action=incidencies');
                exit();
            } else {
                echo "<script>alert('Error al crear la incidencia.');</script>";
            }
        }
    }

    public function actualitzar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->incidencia->id_incidencia = $_POST['id_incidencia'];
            $this->incidencia->descripcio = $_POST['descripcio'];
            $this->incidencia->prioritat = $_POST['prioritat'];
            $this->incidencia->estat = $_POST['estat'];
            $this->incidencia->id_tipo_incidencia = $_POST['id_tipo_incidencia'];
            $this->incidencia->id_usuari = $_POST['id_usuari'];
            $this->incidencia->titol = $_POST['titol'];
            
            if ($this->incidencia->actualitzar()) {
                header('Location: ../public/index.php?action=incidencies');
                exit();
            } else {
                echo "<script>alert('Error al actualitzar la incidencia.');</script>";
            }
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->incidencia->id_incidencia = $_POST['id_incidencia'];

            if ($this->incidencia->eliminar()) {
                header('Location: ../public/index.php?action=incidencies');
                exit();
            } else {
                echo "<script>alert('Error al eliminar la incidencia.');</script>";
            }
        }
    }

    public function obtenir_totes() {
        return $this->incidencia->obtenir_totes();
    }

    public function contadorTasques($count){
        return $this->incidencia->contadorTasques($count);
    }

    public function obtenir_tipus_incidencia() {
        $query = "SELECT * FROM tipus_incidencia";
        return $this->conn->query($query);
    }
    public function obtenir_usuaris() {
        $query = "SELECT id_usuari, nom FROM usuaris";
        return $this->conn->query($query);
    }

    public function obtenir_per_id($id) {
        $this->incidencia->id_incidencia = $id;
        return $this->incidencia->obtenir_per_id();
    }

    public function filtre_estat($estat) {
        return $this->incidencia->obtenir_per_estat($estat);
    }
}

if (isset($_REQUEST['action'])) {
    $controller = new IncidenciaController();

    switch ($_REQUEST['action']) {
        case 'incidencies':
            break;
        case 'crearIncidencia':
            break;
        case 'veureIncidencia':
            break;
        case 'crear':
            $controller->crear();
            break;
        case 'actualitzar':
            $controller->actualitzar();
            break;
        case 'eliminar':
            $controller->eliminar();
            break;
        default:
            echo "<script>alert('Acció no reconeguda.');</script>";
            break;
    }
}
