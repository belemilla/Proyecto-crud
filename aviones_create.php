<?php
require_once 'includes/config.php';
redirigir_si_no_logueado();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
// ===== ACTIVAR ERRORES - VA AL INICIO =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/crud.php';
$crud = new CRUD();

$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = trim($_POST['matricula']);
    $modelo = trim($_POST['modelo']);
    $fabricante = trim($_POST['fabricante']);
    $capacidad = (int)$_POST['capacidad'];
    $año_fabricacion = !empty($_POST['año_fabricacion']) ? (int)$_POST['año_fabricacion'] : null;
    $estado = $_POST['estado'];
    
    if (empty($matricula) || empty($modelo) || empty($fabricante) || empty($capacidad)) {
        $mensaje = "❌ Todos los campos obligatorios deben ser llenados";
        $tipo_mensaje = 'error';
    } else {
        if ($crud->createAvion($matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado)) {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            $mensaje = "✅ Avión registrado exitosamente";
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            $tipo_mensaje = 'exito';
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        } else {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            $mensaje = "❌ Error: La matrícula '$matricula' ya existe en la base de datos.";
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            $tipo_mensaje = 'error';
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
}
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");

        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
$aviones_existentes = $crud->readAllAviones();
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
$matriculas_existentes = array_column($aviones_existentes, 'matricula');
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
<!DOCTYPE html>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
<html lang="es">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
<head>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    <meta charset="UTF-8">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    <title>➕ Agregar Avión - Aerolínea Pro</title>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    <style>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        * { margin: 0; padding: 0; box-sizing: border-box; }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        body {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #f0f4f8;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .container {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            max-width: 600px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin: 0 auto;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 30px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        h1 {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-bottom: 3px solid #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding-bottom: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .navbar {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 8px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 25px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .navbar a {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            text-decoration: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 10px 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin: 0 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: rgba(255,255,255,0.2);
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            display: inline-block;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .navbar a:hover {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: rgba(255,255,255,0.3);
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .form-group {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        label {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            display: block;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-weight: 600;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        input, select {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            width: 100%;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border: 1px solid #ddd;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-size: 14px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        input:focus, select:focus {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            outline: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .btn-guardar {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #4caf50;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 12px 30px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-size: 16px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            cursor: pointer;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .btn-guardar:hover {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #388e3c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .btn-cancelar {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #f44336;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: white;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 12px 30px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-size: 16px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            cursor: pointer;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            text-decoration: none;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            display: inline-block;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .btn-cancelar:hover {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #d32f2f;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .mensaje {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 20px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-weight: 500;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .mensaje-exito {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #d4edda;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: #155724;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border: 1px solid #c3e6cb;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .mensaje-error {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #f8d7da;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: #721c24;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border: 1px solid #f5c6cb;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .botones {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            display: flex;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            gap: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .info-hint {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-size: 12px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: #6b7a8f;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-top: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .matriculas-existente {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #fff3cd;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-size: 13px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        .debug-info {
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            background: #e8f0fe;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            padding: 10px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            border-radius: 5px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            margin-bottom: 15px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            font-size: 12px;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            color: #1a3a5c;
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        }
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    </style>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
</head>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
<body>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    <div class="container">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <h1>➕ Agregar Nuevo Avión</h1>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <div class="navbar">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <a href="index.php">🏠 Inicio</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <a href="aviones_list.php">✈️ Aviones</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <a href="vuelos_list.php">🛫 Vuelos</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <a href="vuelos_create.php">📋 Programar Vuelo</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <?php if ($mensaje): ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="mensaje mensaje-<?= $tipo_mensaje ?>">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <?= $mensaje ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <?php endif; ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <div class="matriculas-existente">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <strong>⚠️ Matrículas ya usadas:</strong> 
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <?= implode(', ', $matriculas_existentes) ?>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <br><small>Usa una matrícula diferente a las anteriores</small>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <div class="debug-info">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            📌 Modo de errores: <strong>ACTIVADO</strong> ✅
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <br>Si ves este mensaje, PHP está funcionando correctamente.
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        <form method="POST">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <label>Matrícula *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <input type="text" name="matricula" placeholder="Ej: CC-MNO" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <div class="info-hint">Ejemplos: CC-MNO, CC-PQR, CC-STU, CC-VWX</div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <label>Modelo *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <input type="text" name="modelo" placeholder="Ej: Embraer E190" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <label>Fabricante *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <input type="text" name="fabricante" placeholder="Ej: Embraer" required>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <label>Capacidad (pasajeros) *</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <input type="number" name="capacidad" placeholder="Ej: 100" required min="1">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <label>Año de Fabricación</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <input type="number" name="año_fabricacion" placeholder="Ej: 2023" min="1900" max="2026">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="form-group">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <label>Estado</label>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <select name="estado">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                    <option value="Activo">✅ Activo</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                    <option value="Mantenimiento">🔧 Mantenimiento</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                    <option value="Retirado">❌ Retirado</option>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                </select>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            <div class="botones">
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <button type="submit" class="btn-guardar">💾 Guardar Avión</button>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
                <a href="aviones_list.php" class="btn-cancelar">❌ Cancelar</a>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
            </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
        </form>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
    </div>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
</body>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
</html>
        $id_nuevo = $db->lastInsertId();
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Crear registro en tabla aviones - Matrícula: $matricula, Modelo: $modelo");
