<?php
require_once 'includes/config.php';
redirigir_si_no_logueado();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once 'includes/crud.php';
$crud = new CRUD();

// Obtener lista de aviones para el select
$aviones = $crud->readAllAviones();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_vuelo = $_POST['numero_vuelo'];
    $avion_id = $_POST['avion_id'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $hora_salida = $_POST['fecha_salida'] . ' ' . $_POST['hora_salida'] . ':00';
    $hora_llegada = $_POST['fecha_llegada'] . ' ' . $_POST['hora_llegada'] . ':00';
    $estado = $_POST['estado'];
    
    if ($crud->createVuelo($numero_vuelo, $avion_id, $origen, $destino, $hora_salida, $hora_llegada, $estado)) {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        header('Location: vuelos_list.php?mensaje=Vuelo programado exitosamente');
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        exit();
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    } else {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        $error = "Error al programar el vuelo. El número de vuelo podría estar duplicado.";
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
}
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<!DOCTYPE html>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<html lang="es">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<head>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <meta charset="UTF-8">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <title>📋 Programar Vuelo - Aerolínea Pro</title>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <style>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        * { margin: 0; padding: 0; box-sizing: border-box; }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        body {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #f0f4f8;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .container {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            max-width: 600px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin: 0 auto;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 30px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        h1 {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-bottom: 3px solid #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding-bottom: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .navbar {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 8px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 25px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .navbar a {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            text-decoration: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin: 0 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: rgba(255,255,255,0.2);
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: inline-block;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .navbar a:hover {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: rgba(255,255,255,0.3);
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .form-group {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        label {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: block;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-weight: 600;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        input, select {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            width: 100%;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: 1px solid #ddd;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 14px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        input:focus, select:focus {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            outline: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .fila-horarios {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: grid;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            grid-template-columns: 1fr 1fr;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            gap: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-guardar {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #4caf50;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 12px 30px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 16px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            cursor: pointer;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-guardar:hover {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #388e3c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-cancelar {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #f44336;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 12px 30px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 16px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            cursor: pointer;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            text-decoration: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: inline-block;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .btn-cancelar:hover {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #d32f2f;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .error {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            background: #f8d7da;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #721c24;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            padding: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-bottom: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            border: 1px solid #f5c6cb;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .botones {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            display: flex;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            gap: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        .info-hint {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            font-size: 12px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            color: #6b7a8f;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            margin-top: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    </style>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
</head>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
<body>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    <div class="container">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <h1>📋 Programar Nuevo Vuelo</h1>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <div class="navbar">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <a href="index.php">🏠 Inicio</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <a href="aviones_list.php">✈️ Aviones</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <a href="vuelos_list.php">🛫 Vuelos</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <?php if (isset($error)): ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="error">❌ <?= $error ?></div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <?php endif; ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        <form method="POST">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Número de Vuelo *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <input type="text" name="numero_vuelo" placeholder="Ej: AA1234" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="info-hint">Identificador único del vuelo</div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Avion Asignado *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <select name="avion_id" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="">-- Seleccionar Avión --</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <?php foreach ($aviones as $avion): ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                        <option value="<?= $avion['id'] ?>">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                            <?= htmlspecialchars($avion['modelo']) ?> - <?= htmlspecialchars($avion['matricula']) ?> (<?= $avion['capacidad'] ?> pax)
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                        </option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <?php endforeach; ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </select>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Origen *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <input type="text" name="origen" placeholder="Ej: Santiago (SCL)" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Destino *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <input type="text" name="destino" placeholder="Ej: Miami (MIA)" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="fila-horarios">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Fecha de Salida *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="date" name="fecha_salida" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Hora de Salida *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="time" name="hora_salida" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="fila-horarios">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Fecha de Llegada *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="date" name="fecha_llegada" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <label>Hora de Llegada *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <input type="time" name="hora_llegada" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <label>Estado</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <select name="estado">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="Programado">📋 Programado</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="En Vuelo">✈️ En Vuelo</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="Aterrizado">🛬 Aterrizado</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                    <option value="Cancelado">❌ Cancelado</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                </select>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            <div class="botones">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <button type="submit" class="btn-guardar">💾 Guardar Vuelo</button>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
                <a href="vuelos_list.php" class="btn-cancelar">❌ Cancelar</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
        </form>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
    </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
</body>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
</html>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla vuelos - Vuelo: $numero_vuelo, Origen: $origen, Destino: $destino");
