<?php
require_once 'includes/config.php';
redirigir_si_no_logueado();
require_once 'includes/crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: vuelos_list.php?error=No se especificó el vuelo');
    exit();
}

$id = (int)$_GET['id'];
$crud = new CRUD();

$vuelo = $crud->readVuelo($id);
if (!$vuelo) {
    header('Location: vuelos_list.php?error=El vuelo no existe');
    exit();
}

registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], 
    "Eliminar registro en tabla vuelos - ID: $id, Vuelo: " . $vuelo['numero_vuelo']);

if ($crud->deleteVuelo($id)) {
    header('Location: vuelos_list.php?mensaje=Vuelo cancelado exitosamente');
} else {
    header('Location: vuelos_list.php?error=Error al cancelar el vuelo');
}
exit();
?>
