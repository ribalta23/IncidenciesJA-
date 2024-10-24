<?php
session_start();
$action = $_GET['action'] ?? 'dashboard';

if (!isset($_SESSION['usuari']) && $action !== 'login') {
    $action = 'login';
}

switch ($action) {
    case 'login':
        include '../views/login.php';
        break;
    
    case 'incidencies':
        $title = "Incidencies".$_SESSION['usuari']['nom'];
        $content = "../views/incidencies.php";
        $styles = [
            "../public/css/incidencies.css"
        ];
        include '../views/layout.php';
        break;
    case 'dashboard':
        if($_SESSION['usuari']['rol'] != 'usuari'){
            $title = "Dashboard - ".$_SESSION['usuari']['nom'];
            $content = "../views/dashboard.php";
            $styles = [
                "../public/css/dashboard.css"
            ];
            include '../views/layout.php';
        } else {
            $action = 'incidencies';
        }
        break;
    case 'mostrarUsuaris':
        if($_SESSION['usuari']['rol'] == 'administrador'){
            $title = "Gestio usuaris";
            $content = "../views/usuaris/mostrarusuaris.php";
            $styles = [
                "../public/css/gestionarusuaris.css"
            ];
            include '../views/layout.php';
        } else {
            $action = 'incidencies';
        }
        break;
    case 'crearIncidencia':
        $title = "Crear incidencia";
        $content = "../views/crearincidencia.php";
        $styles = [
            "../public/css/incidencies.css"
        ];
        include '../views/layout.php';
    case 'afegirUsuaris':
        $title = "Afegir usuaris";
        $content = "../views/usuaris/afegirusuaris.php";
        $styles = [
            "../public/css/incidencies.css"
        ];
        include '../views/layout.php';
}
?>
