<?php
// Configuración de la base de datos SQLite
class Database {
    private static $instance = null;
    private $db;
    private $dbPath;
    
    private function __construct() {
        // Ruta al archivo de base de datos
        $this->dbPath = __DIR__ . '/../database.db';
        
        try {
            // Verificar que el archivo existe
            if (!file_exists($this->dbPath)) {
                die("❌ El archivo de base de datos no existe en: " . $this->dbPath);
            }
            
            // Crear conexión PDO para SQLite
            $this->db = new PDO('sqlite:' . $this->dbPath);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->db;
    }
}
?>