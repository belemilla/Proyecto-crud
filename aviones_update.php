cat > aviones_update.php << 'EOF'
<?php
// ===== ACTIVAR ERRORES =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ===== DESACTIVAR CACHÉ =====
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

require_once 'includes/crud.php';
$crud = new CRUD();

// ===== VERIFICAR ID =====
if (!isset($_GET['id']) || empty($_GET['id'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="2; url=aviones_list.php?error=No se especificó el avión">
        <title>Error - BE Airlines</title>
        <style>
            body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
            .mensaje { background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div class="mensaje">
            <h2>❌ No se especificó el avión</h2>
            <p>Redirigiendo a la lista de aviones...</p>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$id = (int)$_GET['id'];
$avion = $crud->readAvion($id);

// ===== VERIFICAR QUE EXISTE =====
if (!$avion) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="2; url=aviones_list.php?error=El avión no existe">
        <title>Error - BE Airlines</title>
        <style>
            body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
            .mensaje { background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div class="mensaje">
            <h2>❌ El avión no existe</h2>
            <p>Redirigiendo a la lista de aviones...</p>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// ===== PROCESAR FORMULARIO =====
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = trim($_POST['matricula']);
    $modelo = trim($_POST['modelo']);
    $fabricante = trim($_POST['fabricante']);
    $capacidad = (int)$_POST['capacidad'];
    $año_fabricacion = !empty($_POST['año_fabricacion']) ? (int)$_POST['año_fabricacion'] : null;
    $estado = $_POST['estado'];
    
    if (empty($matricula) || empty($modelo) || empty($fabricante) || empty($capacidad)) {
        $error = "❌ Todos los campos obligatorios deben ser llenados";
    } else {
        $resultado = $crud->updateAvion($id, $matricula, $modelo, $fabricante, $capacidad, $año_fabricacion, $estado);
        
        if ($resultado) {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta http-equiv="refresh" content="1; url=aviones_list.php?mensaje=Avión actualizado exitosamente">
                <title>Actualizando - BE Airlines</title>
                <style>
                    body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
                    .mensaje { background: #d1fae5; color: #065f46; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
                    .spinner {
                        border: 4px solid #f3f3f3;
                        border-top: 4px solid #10b981;
                        border-radius: 50%;
                        width: 40px;
                        height: 40px;
                        animation: spin 1s linear infinite;
                        margin: 20px auto;
                    }
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            </head>
            <body>
                <div class="mensaje">
                    <h2>✅ Avión actualizado exitosamente</h2>
                    <div class="spinner"></div>
                    <p>Redirigiendo a la lista de aviones...</p>
                    <p><a href="aviones_list.php" style="color:#065f46;">Haz clic aquí si no eres redirigido</a></p>
                </div>
            </body>
            </html>
            <?php
            exit();
        } else {
            $error = "❌ Error al actualizar el avión. Verifica los datos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✏️ Editar Avión - BE Airlines</title>
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
EOF