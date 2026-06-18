<?php
require_once 'includes/crud.php';

$crud = new CRUD();

// Probar conexión
echo "<h2>🔌 Probando conexión a la base de datos</h2>";

// Mostrar estadísticas
$stats = $crud->getEstadisticas();
echo "<pre>";
print_r($stats);
echo "</pre>";

// Mostrar aviones
echo "<h3>✈️ Lista de Aviones</h3>";
$aviones = $crud->readAllAviones();
echo "<pre>";
print_r($aviones);
echo "</pre>";
?>