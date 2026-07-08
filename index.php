<?php
// ===== CONECTAR A LA BASE DE DATOS =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/config.php';
redirigir_si_no_logueado();
require_once 'includes/crud.php';

$crud = new CRUD();
$usuario_id = $_SESSION['usuario_id'];

// ===== CONTAR AVIONES DEL USUARIO =====
$stmt_aviones = $db->prepare("SELECT COUNT(*) as total FROM aviones WHERE usuario_id = ? OR usuario_id IS NULL");
$stmt_aviones->execute([$usuario_id]);
$total_aviones = $stmt_aviones->fetch()['total'];

$stmt_activos = $db->prepare("SELECT COUNT(*) as total FROM aviones WHERE (usuario_id = ? OR usuario_id IS NULL) AND estado = 'Activo'");
$stmt_activos->execute([$usuario_id]);
$aviones_activos = $stmt_activos->fetch()['total'];

$stmt_mantenimiento = $db->prepare("SELECT COUNT(*) as total FROM aviones WHERE (usuario_id = ? OR usuario_id IS NULL) AND estado = 'Mantenimiento'");
$stmt_mantenimiento->execute([$usuario_id]);
$aviones_mantenimiento = $stmt_mantenimiento->fetch()['total'];

// ===== CONTAR VUELOS DEL USUARIO =====
$stmt_vuelos = $db->prepare("SELECT COUNT(*) as total FROM vuelos v 
                             LEFT JOIN aviones a ON v.avion_id = a.id 
                             WHERE a.usuario_id = ? OR a.usuario_id IS NULL");
$stmt_vuelos->execute([$usuario_id]);
$total_vuelos = $stmt_vuelos->fetch()['total'];

$stmt_programados = $db->prepare("SELECT COUNT(*) as total FROM vuelos v 
                                  LEFT JOIN aviones a ON v.avion_id = a.id 
                                  WHERE (a.usuario_id = ? OR a.usuario_id IS NULL) AND v.estado = 'Programado'");
$stmt_programados->execute([$usuario_id]);
$vuelos_programados = $stmt_programados->fetch()['total'];

// ===== LISTAR VUELOS DEL USUARIO =====
$stmt_vuelos_list = $db->prepare("SELECT v.*, a.modelo as avion_modelo, a.matricula as avion_matricula 
                                   FROM vuelos v 
                                   LEFT JOIN aviones a ON v.avion_id = a.id 
                                   WHERE a.usuario_id = ? OR a.usuario_id IS NULL 
                                   ORDER BY v.hora_salida ASC");
$stmt_vuelos_list->execute([$usuario_id]);
$vuelos = $stmt_vuelos_list->fetchAll();

// ===== CONTAR PILOTOS =====
$stmt_pilotos = $db->query("SELECT COUNT(*) as total FROM pilotos");
$total_pilotos = $stmt_pilotos->fetch()['total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aerolínea Pro - Sistema de Gestión de Flota</title>
    <style>
        /* ===== ESTILOS GENERALES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
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
        
        .header h1 {
            font-size: 28px;
            font-weight: 300;
        }
        
        .header h1 span {
            font-weight: 700;
            color: #4fc3f7;
        }
        
        .header .user-info {
            background: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 8px;
        }
        
        .header .user-info a {
            color: white;
            text-decoration: none;
            margin: 0 5px;
        }
        
        .header .user-info a:hover {
            text-decoration: underline;
        }
        
        .header .user-info .logout-link {
            color: #ff6b6b;
            margin-left: 10px;
        }
        
        /* ===== MENÚ DE NAVEGACIÓN ===== */
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
        
        /* ===== TARJETAS DE ESTADÍSTICAS ===== */
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
        
        .stat-card:hover {
            transform: translateY(-3px);
        }
        
        .stat-card .icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            color: #6b7a8f;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #1a3a5c;
        }
        
        .stat-card .sub-stats {
            display: flex;
            gap: 20px;
            margin-top: 10px;
            font-size: 14px;
            color: #6b7a8f;
        }
        
        .stat-card .sub-stats span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .stat-card .sub-stats .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .dot-green { background: #4caf50; }
        .dot-orange { background: #ff9800; }
        .dot-blue { background: #2196f3; }
        
        /* ===== SECCIÓN DE VUELOS ===== */
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
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #f8f9fa;
        }
        
        th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: #6b7a8f;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 15px 20px;
            border-top: 1px solid #eef2f7;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-boarding { background: #fff3e0; color: #e65100; }
        .status-ontime { background: #e8f5e9; color: #2e7d32; }
        .status-preparing { background: #e3f2fd; color: #0d47a1; }
        
        /* ===== AVISO USUARIO ===== */
        .aviso-usuario {
            background: #e8f0fe;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #1a3a5c;
        }
        
        /* ===== INTEGRANTES ===== */
        .integrantes-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-top: 30px;
        }
        
        .integrantes-section h2 {
            color: #1a3a5c;
            margin-bottom: 15px;
        }
        
        .integrantes-section ul {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }
        
        .integrantes-section li {
            padding: 8px 0;
            border-bottom: 1px solid #eef2f7;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .navbar {
                justify-content: center;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            table {
                font-size: 14px;
            }
            
            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <!-- ===== HEADER CON LOGIN/LOGOUT ===== -->
        <div class="header">
            <h1>✈️ <span>Aerolínea</span> Pro</h1>
            <div class="user-info">
                <?php if (usuario_logueado()): ?>
                    👤 <?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?>
                    <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 'admin'): ?>
                        <span style="color:#4fc3f7;font-size:12px;">(Admin)</span>
                    <?php endif; ?>
                    <a href="bitacora.php" style="color:#4fc3f7;">📋 Bitácora</a>
                    <a href="logout.php" class="logout-link">🚪 Cerrar sesión</a>
                <?php else: ?>
                    <a href="login.php">🔐 Iniciar sesión</a>
                    |
                    <a href="register.php">📝 Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- ===== MENÚ DE NAVEGACIÓN ===== -->
        <div class="navbar">
            <a href="index.php" class="active">🏠 Inicio</a>
            <a href="aviones_list.php">✈️ Aviones</a>
            <a href="vuelos_list.php">🛫 Vuelos</a>
            <a href="aviones_create.php">➕ Agregar</a>
            <a href="vuelos_create.php">📋 Programar</a>
        </div>
        
        <!-- ===== AVISO DE USUARIO ===== -->
        <div class="aviso-usuario">
            👤 Mostrando datos de: <strong><?= htmlspecialchars($_SESSION['usuario_email']) ?></strong>
        </div>
        
        <!-- ===== ESTADÍSTICAS DEL USUARIO ===== -->
        <div class="stats-grid">
            <!-- Aviones -->
            <div class="stat-card">
                <div class="icon">✈️</div>
                <h3>Aviones</h3>
                <div class="number"><?= $total_aviones ?></div>
                <div class="sub-stats">
                    <span><span class="dot dot-green"></span> Activos: <?= $aviones_activos ?></span>
                    <span><span class="dot dot-orange"></span> Mantenimiento: <?= $aviones_mantenimiento ?></span>
                </div>
            </div>
            
            <!-- Vuelos -->
            <div class="stat-card">
                <div class="icon">🛫</div>
                <h3>Vuelos</h3>
                <div class="number"><?= $total_vuelos ?></div>
                <div class="sub-stats">
                    <span>📅 Programados: <?= $vuelos_programados ?></span>
                </div>
            </div>
        </div>
        
        <!-- ===== PRÓXIMOS VUELOS ===== -->
        <div class="section-title">
            <span>🛫 Próximos vuelos</span>
            <span class="badge"><?= count($vuelos) ?> vuelos</span>
        </div>
        
        <div class="table-wrapper">
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
                    <?php if (count($vuelos) > 0): ?>
                        <?php foreach ($vuelos as $vuelo): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($vuelo['numero_vuelo']) ?></strong></td>
                                <td><?= htmlspecialchars($vuelo['origen']) ?></td>
                                <td><?= htmlspecialchars($vuelo['destino']) ?></td>
                                <td><?= date('H:i', strtotime($vuelo['hora_salida'])) ?></td>
                                <td><?= htmlspecialchars($vuelo['avion_modelo'] ?? 'N/A') ?></td>
                                <td>
                                    <?php
                                    $estado = $vuelo['estado'];
                                    $clase = 'status-ontime';
                                    if ($estado == 'Programado') $clase = 'status-preparing';
                                    if ($estado == 'En Vuelo') $clase = 'status-boarding';
                                    if ($estado == 'Aterrizado') $clase = 'status-ontime';
                                    if ($estado == 'Cancelado') $clase = 'status-preparing';
                                    ?>
                                    <span class="status-badge <?= $clase ?>"><?= $estado ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;padding:30px;color:#6b7a8f;">
                                🚫 No hay vuelos programados
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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