<?php
require_once 'includes/crud.php';
$crud = new CRUD();

// Verificar que se pasó un ID
if (!isset($_GET['id'])) {
    header('Location: aviones_list.php?error=No se especificó el avión');
    exit();
}

$id = $_GET['id'];
$avion = $crud->readAvion($id);

// Si no existe el avión
if (!$avion) {
    header('Location: aviones_list.php?error=El avión no existe');
    exit();
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $capacidad = $_POST['capacidad'];
    $año_fabricacion = $_POST['año_fabricacion'];
    $estado = $_POST['estado'];
    
    if ($crud->updateAvion($id, $matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado)) {
        header('Location: aviones_list.php?mensaje=Avión actualizado exitosamente');
        exit();
    } else {
        $error = "Error al actualizar el avión. Verifica los datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✏️ Editar Avión - Aerolínea Pro</title>
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
            border-bottom: 3px solid #ff9800;
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
        .btn-actualizar {
            background: #ff9800;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-actualizar:hover {
            background: #e68900;
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
        .info-avion {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Avión</h1>
        
        <div class="navbar">
            <a href="index.php">🏠 Inicio</a>
            <a href="aviones_list.php">✈️ Aviones</a>
            <a href="vuelos_list.php">🛫 Vuelos</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error">❌ <?= $error ?></div>
        <?php endif; ?>
        
        <div class="info-avion">
            <strong>📝 Editando:</strong> <?= htmlspecialchars($avion['matricula']) ?> - <?= htmlspecialchars($avion['modelo']) ?>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label>Matrícula *</label>
                <input type="text" name="matricula" value="<?= htmlspecialchars($avion['matricula']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Modelo *</label>
                <input type="text" name="modelo" value="<?= htmlspecialchars($avion['modelo']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Fabricante *</label>
                <input type="text" name="fabricante" value="<?= htmlspecialchars($avion['fabricante']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Capacidad (pasajeros) *</label>
                <input type="number" name="capacidad" value="<?= $avion['capacidad'] ?>" required min="1">
            </div>
            
            <div class="form-group">
                <label>Año de Fabricación</label>
                <input type="number" name="año_fabricacion" value="<?= $avion['año_fabricacion'] ?>" min="1900" max="2026">
            </div>
            
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="Activo" <?= $avion['estado'] == 'Activo' ? 'selected' : '' ?>>✅ Activo</option>
                    <option value="Mantenimiento" <?= $avion['estado'] == 'Mantenimiento' ? 'selected' : '' ?>>🔧 Mantenimiento</option>
                    <option value="Retirado" <?= $avion['estado'] == 'Retirado' ? 'selected' : '' ?>>❌ Retirado</option>
                </select>
            </div>
            
            <div class="botones">
                <button type="submit" class="btn-actualizar">💾 Actualizar Avión</button>
                <a href="aviones_list.php" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>