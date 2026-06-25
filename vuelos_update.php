cat > vuelos_update.php << 'EOF'
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
            header('Location: vuelos_list.php?mensaje=Vuelo actualizado exitosamente');
            exit();
        } else {
            $error = "❌ Error al actualizar el vuelo. Verifica los datos.";
        }
    }
}

// Extraer fecha y hora para los campos
$fecha_salida = date('Y-m-d', strtotime($vuelo['hora_salida']));
$hora_salida = date('H:i', strtotime($vuelo['hora_salida']));
$fecha_llegada = date('Y-m-d', strtotime($vuelo['hora_llegada']));
$hora_llegada = date('H:i', strtotime($vuelo['hora_llegada']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✏️ Editar Vuelo - BE Airlines</title>
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
        .fila-horarios {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
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
        .info-vuelo {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Vuelo</h1>
        
        <div class="navbar">
            <a href="index.php">🏠 Inicio</a>
            <a href="aviones_list.php">✈️ Aviones</a>
            <a href="vuelos_list.php">🛫 Vuelos</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="error">❌ <?= $error ?></div>
        <?php endif; ?>
        
        <div class="info-vuelo">
            <strong>📝 Editando:</strong> Vuelo <?= htmlspecialchars($vuelo['numero_vuelo']) ?> - <?= htmlspecialchars($vuelo['origen']) ?> → <?= htmlspecialchars($vuelo['destino']) ?>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <label>Número de Vuelo *</label>
                <input type="text" name="numero_vuelo" value="<?= htmlspecialchars($vuelo['numero_vuelo']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Avion Asignado *</label>
                <select name="avion_id" required>
                    <option value="">-- Seleccionar Avión --</option>
                    <?php foreach ($aviones as $avion): ?>
                        <option value="<?= $avion['id'] ?>" <?= $avion['id'] == $vuelo['avion_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($avion['modelo']) ?> - <?= htmlspecialchars($avion['matricula']) ?> (<?= $avion['capacidad'] ?> pax)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Origen *</label>
                <input type="text" name="origen" value="<?= htmlspecialchars($vuelo['origen']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Destino *</label>
                <input type="text" name="destino" value="<?= htmlspecialchars($vuelo['destino']) ?>" required>
            </div>
            
            <div class="fila-horarios">
                <div class="form-group">
                    <label>Fecha de Salida *</label>
                    <input type="date" name="fecha_salida" value="<?= $fecha_salida ?>" required>
                </div>
                <div class="form-group">
                    <label>Hora de Salida *</label>
                    <input type="time" name="hora_salida" value="<?= $hora_salida ?>" required>
                </div>
            </div>
            
            <div class="fila-horarios">
                <div class="form-group">
                    <label>Fecha de Llegada *</label>
                    <input type="date" name="fecha_llegada" value="<?= $fecha_llegada ?>" required>
                </div>
                <div class="form-group">
                    <label>Hora de Llegada *</label>
                    <input type="time" name="hora_llegada" value="<?= $hora_llegada ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="Programado" <?= $vuelo['estado'] == 'Programado' ? 'selected' : '' ?>>📋 Programado</option>
                    <option value="En Vuelo" <?= $vuelo['estado'] == 'En Vuelo' ? 'selected' : '' ?>>✈️ En Vuelo</option>
                    <option value="Aterrizado" <?= $vuelo['estado'] == 'Aterrizado' ? 'selected' : '' ?>>🛬 Aterrizado</option>
                    <option value="Cancelado" <?= $vuelo['estado'] == 'Cancelado' ? 'selected' : '' ?>>❌ Cancelado</option>
                </select>
            </div>
            
            <div class="botones">
                <button type="submit" class="btn-actualizar">💾 Actualizar Vuelo</button>
                <a href="vuelos_list.php" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
EOF