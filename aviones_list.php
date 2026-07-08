cat > aviones_list.php << 'EOF'
<?php
require_once 'includes/config.php';
redirigir_si_no_logueado();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once 'includes/crud.php';

// ===== REGISTRAR EN BITÁCORA - CONSULTAR =====
registrar_bitacora($_SESSION['usuario_id'] ?? 0, $_SESSION['usuario_email'] ?? 'sistema', 
    "Consultar registros en tabla aviones");

$crud = new CRUD();

// ===== MOSTRAR SOLO LOS AVIONES DEL USUARIO LOGUEADO =====
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM aviones WHERE usuario_id = ? OR usuario_id IS NULL ORDER BY id DESC";
$stmt = $db->prepare($sql);
$stmt->execute([$usuario_id]);
$aviones = $stmt->fetchAll();

// También obtener las matrículas existentes para el mensaje de advertencia
$sql_existentes = "SELECT matricula FROM aviones WHERE usuario_id = ? OR usuario_id IS NULL";
$stmt_existentes = $db->prepare($sql_existentes);
$stmt_existentes->execute([$usuario_id]);
$matriculas_existentes = $stmt_existentes->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✈️ Lista de Aviones - Aerolínea Pro</title>
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
        .status-activo {
            background: #4caf50;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        .status-mantenimiento {
            background: #ff9800;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        .status-retirado {
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
        .aviso {
            background: #e8f0fe;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #1a3a5c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✈️ Flota de Aviones</h1>
        
        <div class="navbar">
            <a href="index.php">🏠 Inicio</a>
            <a href="aviones_list.php" style="background:rgba(255,255,255,0.3);">✈️ Aviones</a>
            <a href="vuelos_list.php">🛫 Vuelos</a>
            <a href="aviones_create.php">➕ Agregar Avión</a>
            <a href="vuelos_create.php">📋 Programar Vuelo</a>
        </div>
        
        <div class="aviso">
            👤 Mostrando aviones de: <strong><?= htmlspecialchars($_SESSION['usuario_email']) ?></strong>
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
        
        <a href="aviones_create.php" class="btn-agregar">➕ Agregar Nuevo Avión</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Fabricante</th>
                    <th>Capacidad</th>
                    <th>Año</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($aviones) > 0): ?>
                    <?php foreach ($aviones as $avion): ?>
                        <tr>
                            <td><?= $avion['id'] ?></td>
                            <td><strong><?= htmlspecialchars($avion['matricula']) ?></strong></td>
                            <td><?= htmlspecialchars($avion['modelo']) ?></td>
                            <td><?= htmlspecialchars($avion['fabricante']) ?></td>
                            <td><?= $avion['capacidad'] ?></td>
                            <td><?= $avion['año_fabricacion'] ?></td>
                            <td>
                                <?php if ($avion['estado'] == 'Activo'): ?>
                                    <span class="status-activo">✅ Activo</span>
                                <?php elseif ($avion['estado'] == 'Mantenimiento'): ?>
                                    <span class="status-mantenimiento">🔧 Mantenimiento</span>
                                <?php else: ?>
                                    <span class="status-retirado">❌ Retirado</span>
                                <?php endif; ?>
                            </td>
                            <td class="acciones">
                                <a href="aviones_update.php?id=<?= $avion['id'] ?>" class="btn-editar">✏️ Editar</a>
                                <a href="aviones_delete.php?id=<?= $avion['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este avión?')">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:30px;">
                            🚫 No hay aviones registrados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
EOF