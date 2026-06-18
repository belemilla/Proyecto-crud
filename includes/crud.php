<?php
require_once __DIR__ . '/db.php';

class CRUD {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // ==================== OPERACIONES PARA AVIONES ====================
    
    // CREATE - Agregar avión
    public function createAvion($matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado = 'Activo') {
        try {
            $sql = "INSERT INTO aviones (matricula, modelo, fabricante, capacidad, año_fabricacion, estado) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // READ - Listar todos los aviones
    public function readAllAviones() {
        try {
            $sql = "SELECT * FROM aviones ORDER BY id DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    
    // READ - Obtener un avión por ID
    public function readAvion($id) {
        try {
            $sql = "SELECT * FROM aviones WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }
    
    // UPDATE - Modificar avión
    public function updateAvion($id, $matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado) {
        try {
            $sql = "UPDATE aviones SET matricula=?, modelo=?, fabricante=?, capacidad=?, año_fabricacion=?, estado=? 
                    WHERE id=?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // DELETE - Eliminar avión
    public function deleteAvion($id) {
        try {
            $sql = "DELETE FROM aviones WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // ==================== OPERACIONES PARA VUELOS ====================
    
    // CREATE - Programar vuelo
    public function createVuelo($numero_vuelo, $avion_id, $origen, $destino, $hora_salida, $hora_llegada, $estado = 'Programado') {
        try {
            $sql = "INSERT INTO vuelos (numero_vuelo, avion_id, origen, destino, hora_salida, hora_llegada, estado) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$numero_vuelo, $avion_id, $origen, $destino, $hora_salida, $hora_llegada, $estado]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // READ - Listar todos los vuelos
    public function readAllVuelos() {
        try {
            $sql = "SELECT v.*, a.modelo as avion_modelo, a.matricula as avion_matricula 
                    FROM vuelos v 
                    LEFT JOIN aviones a ON v.avion_id = a.id 
                    ORDER BY v.hora_salida ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    
    // READ - Obtener un vuelo por ID
    public function readVuelo($id) {
        try {
            $sql = "SELECT v.*, a.modelo as avion_modelo, a.matricula as avion_matricula 
                    FROM vuelos v 
                    LEFT JOIN aviones a ON v.avion_id = a.id 
                    WHERE v.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }
    
    // UPDATE - Modificar vuelo
    public function updateVuelo($id, $numero_vuelo, $avion_id, $origen, $destino, $hora_salida, $hora_llegada, $estado) {
        try {
            $sql = "UPDATE vuelos SET numero_vuelo=?, avion_id=?, origen=?, destino=?, hora_salida=?, hora_llegada=?, estado=? 
                    WHERE id=?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$numero_vuelo, $avion_id, $origen, $destino, $hora_salida, $hora_llegada, $estado, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // DELETE - Cancelar vuelo
    public function deleteVuelo($id) {
        try {
            $sql = "DELETE FROM vuelos WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // ==================== OPERACIONES PARA PILOTOS ====================
    
    // CREATE - Agregar piloto
    public function createPiloto($nombre, $apellido, $licencia, $horas_vuelo = 0) {
        try {
            $sql = "INSERT INTO pilotos (nombre, apellido, licencia, horas_vuelo) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nombre, $apellido, $licencia, $horas_vuelo]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // READ - Listar todos los pilotos
    public function readAllPilotos() {
        try {
            $sql = "SELECT * FROM pilotos ORDER BY id DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    
    // READ - Obtener un piloto por ID
    public function readPiloto($id) {
        try {
            $sql = "SELECT * FROM pilotos WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }
    
    // UPDATE - Modificar piloto
    public function updatePiloto($id, $nombre, $apellido, $licencia, $horas_vuelo) {
        try {
            $sql = "UPDATE pilotos SET nombre=?, apellido=?, licencia=?, horas_vuelo=? WHERE id=?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$nombre, $apellido, $licencia, $horas_vuelo, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // DELETE - Eliminar piloto
    public function deletePiloto($id) {
        try {
            $sql = "DELETE FROM pilotos WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // ==================== ESTADÍSTICAS ====================
    
    public function getEstadisticas() {
        try {
            $stats = [];
            
            // Total aviones
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM aviones");
            $stats['total_aviones'] = $stmt->fetch()['total'];
            
            // Aviones activos
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM aviones WHERE estado = 'Activo'");
            $stats['aviones_activos'] = $stmt->fetch()['total'];
            
            // Aviones en mantenimiento
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM aviones WHERE estado = 'Mantenimiento'");
            $stats['aviones_mantenimiento'] = $stmt->fetch()['total'];
            
            // Total vuelos
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM vuelos");
            $stats['total_vuelos'] = $stmt->fetch()['total'];
            
            // Vuelos programados
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM vuelos WHERE estado = 'Programado'");
            $stats['vuelos_programados'] = $stmt->fetch()['total'];
            
            // Total pilotos
            $stmt = $this->db->query("SELECT COUNT(*) as total FROM pilotos");
            $stats['total_pilotos'] = $stmt->fetch()['total'];
            
            return $stats;
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>