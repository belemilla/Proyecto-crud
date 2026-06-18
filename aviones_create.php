<?php
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
            $mensaje = "✅ Avión registrado exitosamente";
            $tipo_mensaje = 'exito';
        } else {
            $mensaje = "❌ Error: La matrícula '$matricula' ya existe en la base de datos.";
            $tipo_mensaje = 'error';
        }
    }
}

$aviones_existentes = $crud->readAllAviones();
$matriculas_existentes = array_column($aviones_existentes, 'matricula');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>➕ Agregar Avión - Aerolínea Pro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1a3a5c;
            border-bottom: 3px solid #1a3a5c;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .navbar {
            background: #1a3a5c;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
            display: inline-block;
        }
        .navbar a:hover {
            background: rgba(255,255,255,0.3);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1a3a5c;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus, select:focus {
            border-color: #1a3a5c;
            outline: none;
        }
        .btn-guardar {
            background: #4caf50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-guardar:hover {
            background: #388e3c;
        }
        .btn-cancelar {
            background: #f44336;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-cancelar:hover {
            background: #d32f2f;
        }
        .mensaje {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .mensaje-exito {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .mensaje-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .botones {
            display: flex;
            gap: 10px;
        }
        .info-hint {
            font-size: 12px;
            color: #6b7a8f;
            margin-top: 5px;
        }
        .matriculas-existente {
            background: #fff3cd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        .debug-info {
            background: #e8f0fe;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 12px;
            color: #1a3a5c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Agregar Nuevo Avión</h1>
        
        <div class="navbar">
            <a href="index.php">🏠 Inicio</a>
            <a href="aviones_list.php">✈️ Aviones</a>
            <a href="vuelos_list.php">🛫 Vuelos</a>
            <a href="vuelos_create.php">📋 Programar Vuelo</a>
        </div>
        
        <?php if ($mensaje): ?>
            <div class="mensaje mensaje-<?= $tipo_mensaje ?>">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>
        
        <div class="matriculas-existente">
            <strong>⚠️ Matrículas ya usadas:</strong> 
            <?= implode(', ', $matriculas_existentes) ?>
            <br><small>Usa una matrícula diferente a las anteriores</small>
        </div>
        
        <div class="debug-info">
            📌 Modo de errores: <strong>ACTIVADO</strong> ✅
            <br>Si ves este mensaje, PHP está funcionando correctamente.
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label>Matrícula *</label>
                <input type="text" name="matricula" placeholder="Ej: CC-MNO" required>
                <div class="info-hint">Ejemplos: CC-MNO, CC-PQR, CC-STU, CC-VWX</div>
            </div>
            
            <div class="form-group">
                <label>Modelo *</label>
                <input type="text" name="modelo" placeholder="Ej: Embraer E190" required>
            </div>
            
            <div class="form-group">
                <label>Fabricante *</label>
                <input type="text" name="fabricante" placeholder="Ej: Embraer" required>
            </div>
            
            <div class="form-group">
                <label>Capacidad (pasajeros) *</label>
                <input type="number" name="capacidad" placeholder="Ej: 100" required min="1">
            </div>
            
            <div class="form-group">
                <label>Año de Fabricación</label>
                <input type="number" name="año_fabricacion" placeholder="Ej: 2023" min="1900" max="2026">
            </div>
            
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="Activo">✅ Activo</option>
                    <option value="Mantenimiento">🔧 Mantenimiento</option>
                    <option value="Retirado">❌ Retirado</option>
                </select>
            </div>
            
            <div class="botones">
                <button type="submit" class="btn-guardar">💾 Guardar Avión</button>
                <a href="aviones_list.php" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
