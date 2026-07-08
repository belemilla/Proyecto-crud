cat > vuelos_update.php << 'EOF'
require_once 'includes/config.php';
redirigir_si_no_logueado();
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/crud.php';
$crud = new CRUD();

// Verificar que se pasó un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: vuelos_list.php?error=No se especificó el vuelo');
    exit();
}

$id = (int)$_GET['id'];
$vuelo = $crud->readVuelo($id);

// Si no existe el vuelo
if (!$vuelo) {
    header('Location: vuelos_list.php?error=El vuelo no existe');
    exit();
}

// Obtener lista de aviones para el select
$aviones = $crud->readAllAviones();

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_vuelo = trim($_POST['numero_vuelo']);
    $avion_id = (int)$_POST['avion_id'];
    $origen = trim($_POST['origen']);
    $destino = trim($_POST['destino']);
    $hora_salida = $_POST['fecha_salida'] . ' ' . $_POST['hora_salida'] . ':00';
    $hora_llegada = $_POST['fecha_llegada'] . ' ' . $_POST['hora_llegada'] . ':00';
    $estado = $_POST['estado'];
    
    if (empty($numero_vuelo) || empty($origen) || empty($destino)) {
        $error = "❌ Todos los campos obligatorios deben ser llenados";
    } else {
        if ($crud->updateVuelo($id, $numero_vuelo, $avion_id, $origen, $destino, $hora_salida, $hora_llegada, $estado)) {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            header('Location: vuelos_list.php?mensaje=Vuelo actualizado exitosamente');
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            exit();
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        } else {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            $error = "❌ Error al actualizar el vuelo. Verifica los datos.";
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
}
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");

            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
// Extraer fecha y hora para los campos
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
$fecha_salida = date('Y-m-d', strtotime($vuelo['hora_salida']));
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
$hora_salida = date('H:i', strtotime($vuelo['hora_salida']));
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
$fecha_llegada = date('Y-m-d', strtotime($vuelo['hora_llegada']));
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
$hora_llegada = date('H:i', strtotime($vuelo['hora_llegada']));
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
?>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<!DOCTYPE html>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<html lang="es">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<head>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <meta charset="UTF-8">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <title>✏️ Editar Vuelo - BE Airlines</title>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <style>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        * { margin: 0; padding: 0; box-sizing: border-box; }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        body {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #f0f4f8;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 20px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .container {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            max-width: 600px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin: 0 auto;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: white;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 30px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 15px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        h1 {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #1a3a5c;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-bottom: 3px solid #ff9800;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding-bottom: 10px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .navbar {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #1a3a5c;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 15px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 8px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 25px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .navbar a {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: white;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            text-decoration: none;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px 20px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin: 0 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: rgba(255,255,255,0.2);
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: inline-block;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .navbar a:hover {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: rgba(255,255,255,0.3);
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .form-group {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        label {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: block;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-weight: 600;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #1a3a5c;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        input, select {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            width: 100%;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: 1px solid #ddd;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 14px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        input:focus, select:focus {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-color: #1a3a5c;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            outline: none;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .fila-horarios {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: grid;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            grid-template-columns: 1fr 1fr;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            gap: 15px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-actualizar {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #ff9800;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: white;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 12px 30px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: none;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 16px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            cursor: pointer;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-actualizar:hover {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #e68900;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-cancelar {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #f44336;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: white;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 12px 30px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: none;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 16px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            cursor: pointer;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            text-decoration: none;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: inline-block;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-cancelar:hover {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #d32f2f;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .error {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #f8d7da;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #721c24;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: 1px solid #f5c6cb;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .botones {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: flex;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            gap: 10px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .info-vuelo {
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #e3f2fd;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    </style>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
</head>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<body>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <div class="container">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <h1>✏️ Editar Vuelo</h1>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <div class="navbar">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <a href="index.php">🏠 Inicio</a>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <a href="aviones_list.php">✈️ Aviones</a>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <a href="vuelos_list.php">🛫 Vuelos</a>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <?php if (isset($error)): ?>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="error">❌ <?= $error ?></div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <?php endif; ?>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <div class="info-vuelo">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <strong>📝 Editando:</strong> Vuelo <?= htmlspecialchars($vuelo['numero_vuelo']) ?> - <?= htmlspecialchars($vuelo['origen']) ?> → <?= htmlspecialchars($vuelo['destino']) ?>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <form method="POST">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Número de Vuelo *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <input type="text" name="numero_vuelo" value="<?= htmlspecialchars($vuelo['numero_vuelo']) ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Avion Asignado *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <select name="avion_id" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="">-- Seleccionar Avión --</option>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <?php foreach ($aviones as $avion): ?>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                        <option value="<?= $avion['id'] ?>" <?= $avion['id'] == $vuelo['avion_id'] ? 'selected' : '' ?>>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                            <?= htmlspecialchars($avion['modelo']) ?> - <?= htmlspecialchars($avion['matricula']) ?> (<?= $avion['capacidad'] ?> pax)
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                        </option>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <?php endforeach; ?>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </select>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Origen *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <input type="text" name="origen" value="<?= htmlspecialchars($vuelo['origen']) ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Destino *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <input type="text" name="destino" value="<?= htmlspecialchars($vuelo['destino']) ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="fila-horarios">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Fecha de Salida *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="date" name="fecha_salida" value="<?= $fecha_salida ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Hora de Salida *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="time" name="hora_salida" value="<?= $hora_salida ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="fila-horarios">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Fecha de Llegada *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="date" name="fecha_llegada" value="<?= $fecha_llegada ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Hora de Llegada *</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="time" name="hora_llegada" value="<?= $hora_llegada ?>" required>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Estado</label>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <select name="estado">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="Programado" <?= $vuelo['estado'] == 'Programado' ? 'selected' : '' ?>>📋 Programado</option>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="En Vuelo" <?= $vuelo['estado'] == 'En Vuelo' ? 'selected' : '' ?>>✈️ En Vuelo</option>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="Aterrizado" <?= $vuelo['estado'] == 'Aterrizado' ? 'selected' : '' ?>>🛬 Aterrizado</option>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="Cancelado" <?= $vuelo['estado'] == 'Cancelado' ? 'selected' : '' ?>>❌ Cancelado</option>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </select>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="botones">
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <button type="submit" class="btn-actualizar">💾 Actualizar Vuelo</button>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <a href="vuelos_list.php" class="btn-cancelar">❌ Cancelar</a>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        </form>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    </div>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
</body>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
</html>
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
EOF
            registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Modificar registro en tabla vuelos - ID: $id, Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
