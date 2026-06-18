<?php
require_once 'includes/crud.php';

// Verificar que se pasó un ID
if (!isset($_GET['id'])) {
    header('Location: vuelos_list.php?error=No se especificó el vuelo');
    exit();
}

$id = $_GET['id'];
$crud = new CRUD();

// Verificar que el vuelo existe
$vuelo = $crud->readVuelo($id);
if (!$vuelo) {
    header('Location: vuelos_list.php?error=El vuelo no existe');
    exit();
}

// Eliminar el vuelo
if ($crud->deleteVuelo($id)) {
    header('Location: vuelos_list.php?mensaje=Vuelo cancelado exitosamente');
} else {
    header('Location: vuelos_list.php?error=Error al cancelar el vuelo');
}
exit();
?>