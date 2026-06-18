<?php
echo "🔍 Probando conexión a la base de datos...<br><br>";

// Verificar que existe la base de datos
if (file_exists('database.db')) {
    echo "✅ La base de datos existe<br>";
} else {
    echo "❌ La base de datos NO existe<br>";
}

// Verificar que existe la carpeta includes
if (is_dir('includes')) {
    echo "✅ La carpeta includes existe<br>";
} else {
    echo "❌ La carpeta includes NO existe<br>";
}

// Probar la conexión
try {
    require_once 'includes/db.php';
    $db = Database::getInstance();
    $conn = $db->getConnection();
    echo "✅ Conexión exitosa a SQLite<br><br>";
    
    // Probar consulta
    $stmt = $conn->query("SELECT COUNT(*) as total FROM aviones");
    $result = $stmt->fetch();
    echo "📊 Total de aviones: " . $result['total'] . "<br>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>