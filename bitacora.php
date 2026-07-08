cat > bitacora.php << 'EOF'
<?php
require_once 'includes/db.php';
require_once 'includes/config.php';

// ===== ZONA HORARIA =====
date_default_timezone_set('America/Santiago');

redirigir_si_no_logueado();

$usuario = get_usuario_actual();
$es_admin = $usuario && $usuario['rol'] == 'admin';

if ($es_admin) {
    $sql = "SELECT * FROM bitacora ORDER BY id DESC LIMIT 100";
    $stmt = $db->query($sql);
} else {
    $sql = "SELECT * FROM bitacora WHERE usuario_id = ? ORDER BY id DESC LIMIT 100";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION['usuario_id']]);
}
$registros = $stmt->fetchAll();

if ($es_admin) {
    $sql_historial = "SELECT * FROM historial_sesiones ORDER BY id DESC LIMIT 100";
    $stmt_historial = $db->query($sql_historial);
} else {
    $sql_historial = "SELECT * FROM historial_sesiones WHERE usuario_id = ? ORDER BY id DESC LIMIT 100";
    $stmt_historial = $db->prepare($sql_historial);
    $stmt_historial->execute([$_SESSION['usuario_id']]);
}
$historial = $stmt_historial->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácora - Aerolínea Pro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        .header {
            background: linear-gradient(135deg, #0a1628, #1a3a5c);
            color: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 28px; font-weight: 300; }
        .header h1 span { font-weight: 700; color: #4fc3f7; }
        .header .user-info { background: rgba(255,255,255,0.1); padding: 10px 20px; border-radius: 8px; }
        .header .user-info a { color: #ff6b6b; margin-left: 15px; text-decoration: none; }
        .navbar {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .navbar a {
            color: #1a3a5c;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .navbar a:hover,
        .navbar a.active {
            background: #1a3a5c;
            color: white;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #1a3a5c;
        }
        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        .table-wrapper h3 {
            padding: 15px 20px;
            background: #f8f9fa;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background: #f8f9fa;
        }
        th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #6b7a8f;
            font-size: 13px;
            text-transform: uppercase;
        }
        td {
            padding: 12px 16px;
            border-top: 1px solid #eef2f7;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #1a3a5c;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }
        .btn:hover { background: #0f2a44; }
        .fecha-correcta {
            color: #065f46;
            font-weight: 500;
        }
        .zona-horaria-info {
            background: #e8f0fe;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 13px;
            color: #1a3a5c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✈️ <span>Aerolínea</span> Pro</h1>
            <div class="user-info">
                👤 <?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?>
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </div>
        
        <div class="navbar">
            <a href="index.php">🏠 Inicio</a>
            <a href="aviones_list.php">✈️ Aviones</a>
            <a href="vuelos_list.php">🛫 Vuelos</a>
            <a href="bitacora.php" class="active">📋 Bitácora</a>
        </div>
        
        <h1 style="color:#1a3a5c;margin-bottom:20px;">📋 Bitácora de Eventos</h1>
        
        <div class="zona-horaria-info">
            🕐 Hora local: <strong><?= date('Y-m-d H:i:s') ?></strong> (Zona horaria: Chile)
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>📊 Total registros</h3>
                <div class="number"><?= count($registros) ?></div>
            </div>
            <div class="stat-card">
                <h3>📅 Últimos eventos</h3>
                <div class="number"><?= count($historial) ?></div>
            </div>
        </div>
        
        <div class="table-wrapper">
            <h3>📝 Bitácora de acciones</h3>
            <table>
                <thead>
                    <tr><th>ID</th><th>Usuario</th><th>Acción</th><th>IP</th><th>Fecha (Chile)</th></tr>
                </thead>
                <tbody>
                    <?php if (count($registros) > 0): ?>
                        <?php foreach ($registros as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['usuario_email']) ?></td>
                                <td><?= htmlspecialchars($row['accion']) ?></td>
                                <td><?= htmlspecialchars($row['ip']) ?></td>
                                <td class="fecha-correcta">
                                    <?php 
                                    // Convertir la fecha a hora de Chile
                                    $fecha = new DateTime($row['fecha'], new DateTimeZone('UTC'));
                                    $fecha->setTimezone(new DateTimeZone('America/Santiago'));
                                    echo $fecha->format('Y-m-d H:i:s');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align:center;padding:30px;color:#6b7a8f;">🚫 No hay registros</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="table-wrapper">
            <h3>📜 Historial de sesiones</h3>
            <table>
                <thead>
                    <tr><th>ID</th><th>Usuario</th><th>Evento</th><th>IP</th><th>Navegador</th><th>Fecha (Chile)</th></tr>
                </thead>
                <tbody>
                    <?php if (count($historial) > 0): ?>
                        <?php foreach ($historial as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['usuario_email']) ?></td>
                                <td><?= htmlspecialchars($row['evento']) ?></td>
                                <td><?= htmlspecialchars($row['ip']) ?></td>
                                <td><?= htmlspecialchars(substr($row['user_agent'] ?? 'Desconocido', 0, 40)) ?>...</td>
                                <td class="fecha-correcta">
                                    <?php 
                                    $fecha = new DateTime($row['fecha'], new DateTimeZone('UTC'));
                                    $fecha->setTimezone(new DateTimeZone('America/Santiago'));
                                    echo $fecha->format('Y-m-d H:i:s');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center;padding:30px;color:#6b7a8f;">🚫 No hay historial</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <a href="index.php" class="btn">🏠 Volver al inicio</a>
    </div>
</body>
</html>
EOF