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
            $this->incidencia->estat = $_POST['estat'];
            $this->incidencia->id_usuari = $_POST['id_usuari'];
            $this->incidencia->id_tipo_incidencia = $_POST['id_tipo_incidencia'];

            if ($this->incidencia->crear()) {
                header('Location: ../public/index.php');
                exit();
            } else {
                echo "<script>alert('Error al crear la incidencia.');</script>";
            }
        }
    }

    public function actualitzar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->incidencia->id_incidencia = $_POST['id_incidencia_veure'];
            $this->incidencia->descripcio = $_POST['descripcio_veure'];
            $this->incidencia->prioritat = $_POST['prioritat_veure'];
            $this->incidencia->estat = $_POST['estat_veure'];
            $this->incidencia->id_tipo_incidencia = $_POST['id_tipo_incidencia_veure'];
            $this->incidencia->titol = $_POST['titol_veure'];
            
            if ($this->incidencia->actualitzar()) {
                header('Location: ../public/index.php');
                exit();
            } else {
                echo "<script>alert('Error al actualitzar la incidencia.');</script>";
            }
        }
    }

    public function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->incidencia->id_incidencia = $_POST['id_incidencia_veure'];

            if ($this->incidencia->eliminar()) {
                header('Location: ../public/index.php');
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
        case 'crear':
            $controller->obrirCrear();
            break;
        case 'actualitzar':
            $controller->actualitzar();
            break;
        case 'eliminar':
            $controller->eliminar();
            break;
        case 'obtenir_per_id':
            if (isset($_POST['id'])) {
                echo json_encode($controller->obtenir_per_id($_POST['id']));
            }
            break;
        case 'incidencies':
            break;
        default:
            echo "<script>alert('Acció no reconeguda.');</script>";
            break;
    }
}
