<?php
//if por si no a iniciado el session
if(!isset($_SESSION)){
    session_start();
}


include_once '../config/database.php';
include_once '../models/GestorUsuaris.php';

class GestorUsuarisController{
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function mostrarUsuaris() {
        $query = "SELECT * FROM usuaris";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }


}
if (isset($_REQUEST['action'])) {
    $controller = new GestorUsuarisController();

    switch ($_REQUEST['action']) {
        case 'mostrarUsuaris':
            $controller->mostrarUsuaris();
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