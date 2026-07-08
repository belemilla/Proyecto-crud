<?php
require_once 'includes/config.php';
redirigir_si_no_logueado();
require_once 'includes/crud.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: aviones_list.php?error=No se especificó el avión');
    exit();
}

$id = (int)$_GET['id'];
$crud = new CRUD();

$avion = $crud->readAvion($id);
if (!$avion) {
    header('Location: aviones_list.php?error=El avión no existe');
    exit();
}

registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], 
    "Eliminar registro en tabla aviones - ID: $id, Matrícula: " . $avion['matricula']);

if ($crud->deleteAvion($id)) {
    header('Location: aviones_list.php?mensaje=Avión eliminado exitosamente');
} else {
    header('Location: aviones_list.php?error=Error al eliminar el avión');
}
exit();
?>
