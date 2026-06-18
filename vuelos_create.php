<?php
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
        header('Location: vuelos_list.php?mensaje=Vuelo programado exitosamente');
        exit();
    } else {
        $error = "Error al programar el vuelo. El número de vuelo podría estar duplicado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📋 Programar Vuelo - Aerolínea Pro</title>
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
        .fila-horarios {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
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
        .info-hint {
            font-size: 12px;
            color: #6b7a8f;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Programar Nuevo Vuelo</h1>
        
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
                <label>Número de Vuelo *</label>
                <input type="text" name="numero_vuelo" placeholder="Ej: AA1234" required>
                <div class="info-hint">Identificador único del vuelo</div>
            </div>
            
            <div class="form-group">
                <label>Avion Asignado *</label>
                <select name="avion_id" required>
                    <option value="">-- Seleccionar Avión --</option>
                    <?php foreach ($aviones as $avion): ?>
                        <option value="<?= $avion['id'] ?>">
                            <?= htmlspecialchars($avion['modelo']) ?> - <?= htmlspecialchars($avion['matricula']) ?> (<?= $avion['capacidad'] ?> pax)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Origen *</label>
                <input type="text" name="origen" placeholder="Ej: Santiago (SCL)" required>
            </div>
            
            <div class="form-group">
                <label>Destino *</label>
                <input type="text" name="destino" placeholder="Ej: Miami (MIA)" required>
            </div>
            
            <div class="fila-horarios">
                <div class="form-group">
                    <label>Fecha de Salida *</label>
                    <input type="date" name="fecha_salida" required>
                </div>
                <div class="form-group">
                    <label>Hora de Salida *</label>
                    <input type="time" name="hora_salida" required>
                </div>
            </div>
            
            <div class="fila-horarios">
                <div class="form-group">
                    <label>Fecha de Llegada *</label>
                    <input type="date" name="fecha_llegada" required>
                </div>
                <div class="form-group">
                    <label>Hora de Llegada *</label>
                    <input type="time" name="hora_llegada" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Estado</label>
                <select name="estado">
                    <option value="Programado">📋 Programado</option>
                    <option value="En Vuelo">✈️ En Vuelo</option>
                    <option value="Aterrizado">🛬 Aterrizado</option>
                    <option value="Cancelado">❌ Cancelado</option>
                </select>
            </div>
            
            <div class="botones">
                <button type="submit" class="btn-guardar">💾 Guardar Vuelo</button>
                <a href="vuelos_list.php" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>