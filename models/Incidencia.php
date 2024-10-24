<?php
class Incidencia {
    private $conn;
    private $table = 'incidencia';

    public $id_incidencia;
    public $titol;
    public $descripcio;
    public $prioritat;
    public $data_creacio;
    public $estat;
    public $id_usuari;
    public $id_tipo_incidencia;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table . " (titol, descripcio, prioritat, estat, data_creacio, id_usuari, id_tipus_incidencia) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssssss", $this->titol, $this->descripcio, $this->prioritat, $this->estat, $this->id_usuari, $this->id_tipo_incidencia);
        return $stmt->execute();
    }

    public function obtenir_totes() {
        $query = "SELECT i.*, ti.nom as tipus_incidencia, u.nom as nom_usuari_supervisor FROM " . $this->table . " i INNER JOIN tipus_incidencia ti ON i.id_tipus_incidencia = ti.id_tipus_incidencia INNER JOIN usuaris u ON i.id_usuari = u.id_usuari";
        $result = $this->conn->query($query);
        
        if ($result === false) {
            echo "Error en la consulta: " . $this->conn->error;
            return null;
        }
        return $result;
    }

    public function contadorTasques(&$count) {
        $query = "SELECT COUNT(*) FROM tasques WHERE id_incidencia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_incidencia);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }
    

    public function actualitzar() {
        $query = "UPDATE " . $this->table . " SET titol = ?, descripcio = ?, id_tipus_incidencia = ?, prioritat = ?, estat = ?  WHERE id_incidencia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->titol, $this->descripcio, $this->id_tipo_incidencia, $this->prioritat, $this->estat, $this->id_incidencia);
        return $stmt->execute();
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_incidencia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_incidencia);
        return $stmt->execute();
    }

    public function obtenir_per_id() {
        $query = "SELECT i.*, u.nom FROM " . $this->table . " i INNER JOIN usuaris u on u.id_usuari = i.id_usuari WHERE id_incidencia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_incidencia);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function obtenir_per_estat($estat) {
        $query = "SELECT i.*, ti.nom as tipus_incidencia, u.nom as nom_usuari_supervisor 
                  FROM " . $this->table . " i 
                  INNER JOIN tipus_incidencia ti ON i.id_tipus_incidencia = ti.id_tipus_incidencia 
                  INNER JOIN usuaris u ON i.id_usuari = u.id_usuari 
                  WHERE estat = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $estat);
        $stmt->execute();
        return $stmt->get_result();
    }
    
}
