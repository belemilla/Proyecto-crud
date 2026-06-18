<?php
require_once 'includes/crud.php';

// Verificar que se pasó un ID
if (!isset($_GET['id'])) {
    header('Location: aviones_list.php?error=No se especificó el avión');
    exit();
}

$id = $_GET['id'];
$crud = new CRUD();

// Verificar que el avión existe
$avion = $crud->readAvion($id);
if (!$avion) {
    header('Location: aviones_list.php?error=El avión no existe');
    exit();
}

// Eliminar el avión
if ($crud->deleteAvion($id)) {
    header('Location: aviones_list.php?mensaje=Avión eliminado exitosamente');
} else {
    header('Location: aviones_list.php?error=Error al eliminar el avión');
}
exit();
?>