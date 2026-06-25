<?php
// ===== CONEXIÓN A LA BASE DE DATOS =====
try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/aerolinea.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// ===== CONSULTAS DE ESTADÍSTICAS =====

// Total de aviones
$totalAviones = $pdo->query("SELECT COUNT(*) FROM aviones")->fetchColumn();

// Aviones activos
$avionesActivos = $pdo->query("SELECT COUNT(*) FROM aviones WHERE estado = 'Activo'")->fetchColumn();

// Aviones en mantenimiento
$avionesMantenimiento = $pdo->query("SELECT COUNT(*) FROM aviones WHERE estado = 'En mantenimiento'")->fetchColumn();

// Vuelos de hoy
$vuelosHoy = $pdo->query("SELECT COUNT(*) FROM vuelos WHERE DATE(hora_salida) = DATE('now')")->fetchColumn();

// Vuelos esta semana
$vuelosSemana = $pdo->query("SELECT COUNT(*) FROM vuelos WHERE DATE(hora_salida) >= DATE('now', 'weekday 0', '-7 days') AND DATE(hora_salida) <= DATE('now', 'weekday 0')")->fetchColumn();

// Vuelos en curso (salida ya pasó, llegada aún no)
$vuelosEnCurso = $pdo->query("SELECT COUNT(*) FROM vuelos WHERE hora_salida <= DATETIME('now') AND hora_llegada >= DATETIME('now')")->fetchColumn();

// Próximos vuelos de hoy con info de avión
$proximosVuelos = $pdo->query("
    SELECT v.numero_vuelo, v.origen, v.destino, v.hora_salida, v.estado,
           a.modelo AS aeronave
    FROM vuelos v
    JOIN aviones a ON v.avion_id = a.id
    WHERE DATE(v.hora_salida) = DATE('now')
    ORDER BY v.hora_salida ASC
")->fetchAll(PDO::FETCH_ASSOC);

// Función para mapear estado de vuelo a clase CSS y etiqueta
function estadoVuelo($estado) {
    switch ($estado) {
        case 'Abordando':   return ['class' => 'status-boarding',  'label' => '🔴 Abordando'];
        case 'En curso':    return ['class' => 'status-ontime',    'label' => '✅ En curso'];
        case 'Programado':  return ['class' => 'status-preparing', 'label' => '🔄 Programado'];
        case 'Aterrizado':  return ['class' => 'status-ontime',    'label' => '✅ Aterrizado'];
        case 'Cancelado':   return ['class' => 'status-boarding',  'label' => '❌ Cancelado'];
        default:            return ['class' => 'status-preparing', 'label' => htmlspecialchars($estado)];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerolínea Pro - Sistema de Gestión de Flota</title>
    <style>
        /* ===== ESTILOS GENERALES ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }

        .container { max-width: 1400px; margin: 0 auto; }

        /* ===== HEADER ===== */
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
        .header .user-info {
            background: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 8px;
        }

        /* ===== NAVBAR ===== */
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
        .navbar a:hover, .navbar a.active { background: #1a3a5c; color: white; }

        /* ===== ESTADÍSTICAS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-card .icon { font-size: 32px; margin-bottom: 10px; }
        .stat-card h3 {
            color: #6b7a8f;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        .stat-card .number { font-size: 32px; font-weight: 700; color: #1a3a5c; }
        .stat-card .sub-stats {
            display: flex;
            gap: 20px;
            margin-top: 10px;
            font-size: 14px;
            color: #6b7a8f;
        }
        .stat-card .sub-stats span { display: flex; align-items: center; gap: 5px; }
        .stat-card .sub-stats .dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .dot-green  { background: #4caf50; }
        .dot-orange { background: #ff9800; }
        .dot-blue   { background: #2196f3; }

        /* ===== TABLA VUELOS ===== */
        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a3a5c;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-title .badge {
            background: #e8f0fe;
            color: #1a3a5c;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
        }
        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f8f9fa; }
        th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: #6b7a8f;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td { padding: 15px 20px; border-top: 1px solid #eef2f7; }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .status-boarding  { background: #fff3e0; color: #e65100; }
        .status-ontime    { background: #e8f5e9; color: #2e7d32; }
        .status-preparing { background: #e3f2fd; color: #0d47a1; }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6b7a8f;
            font-size: 15px;
        }

        /* ===== INTEGRANTES ===== */
        .integrantes-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-top: 30px;
        }
        .integrantes-section h2 { color: #1a3a5c; margin-bottom: 15px; }
        .integrantes-section ul {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }
        .integrantes-section li { padding: 8px 0; border-bottom: 1px solid #eef2f7; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header { flex-direction: column; text-align: center; gap: 10px; }
            .navbar { justify-content: center; }
            .stats-grid { grid-template-columns: 1fr; }
            table { font-size: 14px; }
            th, td { padding: 10px; }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- ===== HEADER ===== -->
    <div class="header">
        <h1>✈️ <span>Aerolínea</span> Pro</h1>
        <div class="user-info">
            <span>👤 Belén y Ema</span>
        </div>
    </div>

    <!-- ===== NAVBAR ===== -->
    <div class="navbar">
        <a href="index.php" class="active">🏠 Inicio</a>
        <a href="aviones_list.php">✈️ Aviones</a>
        <a href="vuelos_list.php">🛫 Vuelos</a>
        <a href="aviones_create.php">➕ Agregar</a>
        <a href="vuelos_create.php">📋 Programar</a>
    </div>

    <!-- ===== ESTADÍSTICAS ===== -->
    <div class="stats-grid">

        <!-- Aviones -->
        <div class="stat-card">
            <div class="icon">✈️</div>
            <h3>Aviones</h3>
            <div class="number"><?= $totalAviones ?></div>
            <div class="sub-stats">
                <span><span class="dot dot-green"></span> Activos: <?= $avionesActivos ?></span>
                <span><span class="dot dot-orange"></span> Mantenimiento: <?= $avionesMantenimiento ?></span>
            </div>
        </div>

        <!-- Vuelos -->
        <div class="stat-card">
            <div class="icon">🛫</div>
            <h3>Vuelos</h3>
            <div class="number"><?= $vuelosHoy ?> <span style="font-size:16px;color:#6b7a8f;">hoy</span></div>
            <div class="sub-stats">
                <span>📅 Esta semana: <?= $vuelosSemana ?></span>
                <span><span class="dot dot-blue"></span> En curso: <?= $vuelosEnCurso ?></span>
            </div>
        </div>

    </div>
    <!-- FIN stats-grid -->

    <!-- ===== PRÓXIMOS VUELOS ===== -->
    <div class="section-title">
        <span>🛫 Próximos vuelos</span>
        <span class="badge"><?= $vuelosHoy ?> hoy</span>
    </div>

    <div class="table-wrapper">
        <?php if (empty($proximosVuelos)): ?>
            <div class="empty-state">No hay vuelos programados para hoy.</div>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Vuelo</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Hora</th>
                    <th>Aeronave</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proximosVuelos as $vuelo):
                    $est = estadoVuelo($vuelo['estado']);
                ?>
                <tr>
                    <td><strong><?= htmlspecialchars($vuelo['numero_vuelo']) ?></strong></td>
                    <td><?= htmlspecialchars($vuelo['origen']) ?></td>
                    <td><?= htmlspecialchars($vuelo['destino']) ?></td>
                    <td><?= date('H:i', strtotime($vuelo['hora_salida'])) ?></td>
                    <td><?= htmlspecialchars($vuelo['aeronave']) ?></td>
                    <td><span class="status-badge <?= $est['class'] ?>"><?= $est['label'] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>

    <!-- ===== INTEGRANTES ===== -->
    <div class="integrantes-section">
        <h2>👥 Integrantes del Grupo</h2>
        <ul>
            <li><strong>1.</strong> Belén Muñoz</li>
            <li><strong>2.</strong> Ema Arraño</li>
        </ul>
        <p style="margin-top:15px;color:#6b7a8f;font-size:14px;">
            <strong>📝 Descripción:</strong> Sistema de Gestión de Flota Aérea que permite administrar aviones,
            programar vuelos y controlar el estado de la operación aérea en tiempo real.
        </p>
    </div>

</div>
</body>
</html>