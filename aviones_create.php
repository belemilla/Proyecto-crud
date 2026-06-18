<?php
require_once 'includes/crud.php';
$crud = new CRUD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $capacidad = $_POST['capacidad'];
    $año_fabricacion = $_POST['año_fabricacion'];
    $estado = $_POST['estado'];
    
    if ($crud->createAvion($matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado)) {
        header('Location: aviones_list.php?mensaje=Avión registrado exitosamente');
        exit();
    } else {
        $error = "Error al registrar el avión. La matrícula podría estar duplicada.";
    }
}
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
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        .botones {
            display: flex;
            gap: 10px;
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
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error">❌ <?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Matrícula *</label>
                <input type="text" name="matricula" placeholder="Ej: CC-ABC" required>
            </div>
            
            <div class="form-group">
                <label>Modelo *</label>
                <input type="text" name="modelo" placeholder="Ej: Boeing 787 Dreamliner" required>
            </div>
            
            <div class="form-group">
                <label>Fabricante *</label>
                <input type="text" name="fabricante" placeholder="Ej: Boeing" required>
            </div>
            
            <div class="form-group">
                <label>Capacidad (pasajeros) *</label>
                <input type="number" name="capacidad" placeholder="Ej: 290" required min="1">
            </div>
            
            <div class="form-group">
                <label>Año de Fabricación</label>
                <input type="number" name="año_fabricacion" placeholder="Ej: 2020" min="1900" max="2026">
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