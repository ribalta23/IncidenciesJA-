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
}
