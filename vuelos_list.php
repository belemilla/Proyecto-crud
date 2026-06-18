<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
require_once 'includes/crud.php';
$crud = new CRUD();
$vuelos = $crud->readAllVuelos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🛫 Lista de Vuelos - Aerolínea Pro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
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
        .btn-agregar {
            background: #4caf50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-agregar:hover {
            background: #388e3c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #1a3a5c;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .acciones a {
            padding: 5px 10px;
            margin: 0 3px;
            border-radius: 3px;
            text-decoration: none;
            color: white;
            display: inline-block;
        }
        .btn-editar {
            background: #ff9800;
        }
        .btn-editar:hover {
            background: #e68900;
        }
        .btn-eliminar {
            background: #f44336;
        }
        .btn-eliminar:hover {
            background: #d32f2f;
        }
        .status-programado {
            background: #2196f3;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        .status-en-vuelo {
            background: #4caf50;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        .status-aterrizado {
            background: #ff9800;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        .status-cancelado {
            background: #f44336;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        .mensaje {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>🛫 Programación de Vuelos</h1>
        
        <div class="navbar">
            <a href="index.php">🏠 Inicio</a>
            <a href="aviones_list.php">✈️ Aviones</a>
            <a href="vuelos_list.php" style="background:rgba(255,255,255,0.3);">🛫 Vuelos</a>
            <a href="aviones_create.php">➕ Agregar Avión</a>
            <a href="vuelos_create.php">📋 Programar Vuelo</a>
        </div>
        
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="mensaje mensaje-exito">
                ✅ <?= htmlspecialchars($_GET['mensaje']) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="mensaje mensaje-error">
                ❌ <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        
        <a href="vuelos_create.php" class="btn-agregar">📋 Programar Nuevo Vuelo</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vuelo</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Avion</th>
                    <th>Salida</th>
                    <th>Llegada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($vuelos) > 0): ?>
                    <?php foreach ($vuelos as $vuelo): ?>
                        <tr>
                            <td><?= $vuelo['id'] ?></td>
                            <td><strong><?= htmlspecialchars($vuelo['numero_vuelo']) ?></strong></td>
                            <td><?= htmlspecialchars($vuelo['origen']) ?></td>
                            <td><?= htmlspecialchars($vuelo['destino']) ?></td>
                            <td><?= htmlspecialchars($vuelo['avion_modelo'] ?? 'N/A') ?></td>
                            <td><?= $vuelo['hora_salida'] ?></td>
                            <td><?= $vuelo['hora_llegada'] ?></td>
                            <td>
                                <?php if ($vuelo['estado'] == 'Programado'): ?>
                                    <span class="status-programado">📋 Programado</span>
                                <?php elseif ($vuelo['estado'] == 'En Vuelo'): ?>
                                    <span class="status-en-vuelo">✈️ En Vuelo</span>
                                <?php elseif ($vuelo['estado'] == 'Aterrizado'): ?>
                                    <span class="status-aterrizado">🛬 Aterrizado</span>
                                <?php else: ?>
                                    <span class="status-cancelado">❌ Cancelado</span>
                                <?php endif; ?>
                            </td>
                            <td class="acciones">
                                <a href="vuelos_update.php?id=<?= $vuelo['id'] ?>" class="btn-editar">✏️ Editar</a>
                                <a href="vuelos_delete.php?id=<?= $vuelo['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de cancelar este vuelo?')">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center;padding:30px;">
                            🚫 No hay vuelos programados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>