<?php

if(!isset($_SESSION)){
    session_start();
}


include_once '../config/database.php';
include_once '../models/GestorUsuaris.php';

class GestorUsuarisController{
    private $conn;
    private $model;
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        $this->model = new GestorUsuaris($this->conn);
    }

    public function mostrarUsuaris() {
        $query = "SELECT * FROM usuaris";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    public function afegirUsuaris() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $cognoms = $_POST['cognoms'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];
            $imatge = $_FILES['imatge']['name'];
            $imatge_tmp = $_FILES['imatge']['tmp_name'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
                
            move_uploaded_file($imatge_tmp, '../public/assets/profile/' . $imatge);
    
            
            include_once '../models/GestorUsuaris.php';
            $model = new GestorUsuaris();
            $model->insertarUsuari($nom, $cognoms, $email, $rol, $imatge, $password_hash);
    
            
            header('Location: ../public/index.php?action=mostrarUsuaris');
            exit();
        }
    }
    public function obtenirRol() {
        return $this->model->obtenirRol();
    }
    public function obtenirTipus() {
        return $this->model->obtenirTipus();
    }


}
if (isset($_REQUEST['action'])) {
    $controller = new GestorUsuarisController();

    switch ($_REQUEST['action']) {
        case 'mostrarUsuaris':
            $controller->mostrarUsuaris();
            break;
        case 'afegirUsuaris':
            $controller->afegirUsuaris();
            break;
        case 'obtenirRol':
            $controller->obtenirRol();
            break;
        case 'obtenirtipus':
            $controller->obtenirTipus();
            break;
        case 'incidencies':
            break;
        default:
            echo "<script>alert('Acció no reconeguda.');</script>";
            break;
    }
}