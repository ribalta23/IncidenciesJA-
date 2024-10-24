<?php 
class GestorUsuaris {

    private $conn;
    private $table = 'usuaris';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function mostrarUsuaris() {
        $query = "SELECT u.*, ti.nom, ti.id_tipus_incidencia
                  FROM usuaris u 
                  LEFT JOIN tipus_incidencia ti ON u.id_sector = ti.id_tipus_incidencia";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuaris = array();

        while ($row = $result->fetch_assoc()) {
            $usuaris[] = $row;
        }

        return $usuaris;
    }

    public function insertarUsuari($nom, $cognoms, $email, $rol, $imatge, $password_hash, $tipus_id) {
        $stmt = $this->conn->prepare("INSERT INTO usuaris (nom, cognoms, email, rol, imatge, contrasenya, id_sector) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nom, $cognoms, $email, $rol, $imatge, $password_hash, $tipus_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function obtenirRol() {
        $result = $this->conn->query("SHOW COLUMNS FROM usuaris LIKE 'rol'");
        $row = $result->fetch_assoc();
        $enum = $row['Type'];
        preg_match("/^enum\((.*)\)$/", $enum, $matches);
        $enum = str_getcsv($matches[1], ',', "'");
        $enum = array_filter($enum, function($value) { return !empty($value); }); // Filtrar valores vacíos
        return $enum;
    }
    public function obtenirTipus() {
        $result = $this->conn->query("SELECT id_tipus_incidencia, nom FROM tipus_incidencia");
        $tipus = array();
        while ($row = $result->fetch_assoc()) {
            $tipus[] = $row;
        }
        return $tipus;
    }
    
}
