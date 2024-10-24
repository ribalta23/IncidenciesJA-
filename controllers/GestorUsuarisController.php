<?php
session_start();
include_once '../config/database.php';
include_once '../models/GestorUsuaris.php';

class GestorUsuarisController{
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function mostrarUsuaris(){
        $usuari = new GestorUsuaris($this->conn);
        $usuaris = $usuari->mostrarUsuaris();
        return $usuaris;
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