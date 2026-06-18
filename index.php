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
        
        /* ===== PILOTOS EN VUELO ===== */
        .pilotos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .piloto-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 4px solid #4fc3f7;
        }
        
        .piloto-card .nombre {
            font-weight: 700;
            color: #1a3a5c;
        }
        
        .piloto-card .vuelo {
            font-size: 14px;
            color: #6b7a8f;
            margin-top: 5px;
        }
        
        /* ===== MANTENIMIENTO ===== */
        .mantenimiento-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .mantenimiento-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .mantenimiento-card .avion {
            font-weight: 700;
            color: #1a3a5c;
        }
        
        .mantenimiento-card .tarea {
            font-size: 14px;
            color: #6b7a8f;
            margin: 5px 0 10px 0;
        }
        
        .progress-bar {
            background: #eef2f7;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-bar .fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s;
        }
        
        .fill-70 { width: 70%; background: #ff9800; }
        .fill-40 { width: 40%; background: #f44336; }
        .fill-15 { width: 15%; background: #ff9800; }
        
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
        
        <!-- ===== HEADER ===== -->
        <div class="header">
            <h1>✈️ <span>Aerolínea</span> Pro</h1>
            <div class="user-info">
                <span>👤 Grupo [Nombre]</span>
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
        
        <!-- ===== ESTADÍSTICAS ===== -->
        <div class="stats-grid">
            <!-- Aviones -->
            <div class="stat-card">
                <div class="icon">✈️</div>
                <h3>Aviones</h3>
                <div class="number">15</div>
                <div class="sub-stats">
                    <span><span class="dot dot-green"></span> Activos: 12</span>
                    <span><span class="dot dot-orange"></span> Mantenimiento: 3</span>
                </div>
            </div>
            
            <!-- Vuelos -->
            <div class="stat-card">
                <div class="icon">🛫</div>
                <h3>Vuelos</h3>
                <div class="number">8 <span style="font-size:16px;color:#6b7a8f;">hoy</span></div>
                <div class="sub-stats">
                    <span>📅 Esta semana: 45</span>
                    <span><span class="dot dot-blue"></span> En curso: 3</span>
                </div>
            </div>
            
            <!-- Pilotos -->
            <div class="stat-card">
                <div class="icon">👨‍✈️</div>
                <h3>Pilotos</h3>
                <div class="number">25</div>
                <div class="sub-stats">
                    <span>✅ Activos: 25</span>
                    <span>✈️ En vuelo: 3</span>
                    <span>📋 Disponibles: 22</span>
                </div>
            </div>
        </div>
        
        <!-- ===== PRÓXIMOS VUELOS ===== -->
        <div class="section-title">
            <span>🛫 Próximos vuelos</span>
            <span class="badge">8 hoy</span>
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
                    <tr>
                        <td><strong>AA123</strong></td>
                        <td>SCL</td>
                        <td>MIA</td>
                        <td>10:30</td>
                        <td>Boeing 787</td>
                        <td><span class="status-badge status-boarding">🔴 Abordando</span></td>
                    </tr>
                    <tr>
                        <td><strong>AA456</strong></td>
                        <td>SCL</td>
                        <td>BOG</td>
                        <td>12:15</td>
                        <td>Airbus A320</td>
                        <td><span class="status-badge status-ontime">✅ A tiempo</span></td>
                    </tr>
                    <tr>
                        <td><strong>AA789</strong></td>
                        <td>SCL</td>
                        <td>MAD</td>
                        <td>15:45</td>
                        <td>Boeing 777</td>
                        <td><span class="status-badge status-preparing">🔄 Preparando</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- ===== PILOTOS EN VUELO ===== -->
        <h2 style="color:#1a3a5c; margin-bottom:15px;">👨‍✈️ Pilotos en vuelo</h2>
        <div class="pilotos-grid">
            <div class="piloto-card">
                <div class="nombre">👨‍✈️ Carlos Ramírez</div>
                <div class="vuelo">AA123 · SCL → MIA</div>
            </div>
            <div class="piloto-card">
                <div class="nombre">👩‍✈️ Laura Mendoza</div>
                <div class="vuelo">AA456 · SCL → BOG</div>
            </div>
            <div class="piloto-card">
                <div class="nombre">👨‍✈️ Jorge Peña</div>
                <div class="vuelo">AA789 · SCL → MAD</div>
            </div>
        </div>
        
        <!-- ===== MANTENIMIENTO ===== -->
        <h2 style="color:#1a3a5c; margin-bottom:15px;">🔧 Mantenimiento activo</h2>
        <div class="mantenimiento-grid">
            <div class="mantenimiento-card">
                <div class="avion">✈️ Boeing 737 - AP-082</div>
                <div class="tarea">Revisión de motores</div>
                <div class="progress-bar">
                    <div class="fill fill-70"></div>
                </div>
                <span style="font-size:13px;color:#6b7a8f;margin-top:5px;display:block;">70% completado</span>
            </div>
            <div class="mantenimiento-card">
                <div class="avion">✈️ Airbus A321 - AP-087</div>
                <div class="tarea">Inspección hidráulica</div>
                <div class="progress-bar">
                    <div class="fill fill-40"></div>
                </div>
                <span style="font-size:13px;color:#6b7a8f;margin-top:5px;display:block;">40% completado</span>
            </div>
            <div class="mantenimiento-card">
                <div class="avion">✈️ Boeing 767 - AP-011</div>
                <div class="tarea">Chequeo de aviónica</div>
                <div class="progress-bar">
                    <div class="fill fill-15"></div>
                </div>
                <span style="font-size:13px;color:#6b7a8f;margin-top:5px;display:block;">15% completado</span>
            </div>
        </div>
        
        <!-- ===== INTEGRANTES ===== -->
        <div class="integrantes-section">
            <h2>👥 Integrantes del Grupo</h2>
            <ul>
                <li><strong>1.</strong> [Nombre Integrante 1] - [Rol]</li>
                <li><strong>2.</strong> [Nombre Integrante 2] - [Rol]</li>
                <li><strong>3.</strong> [Nombre Integrante 3] - [Rol]</li>
                <li><strong>4.</strong> [Nombre Integrante 4] - [Rol]</li>
            </ul>
            <p style="margin-top:15px;color:#6b7a8f;font-size:14px;">
                <strong>📝 Descripción:</strong> Sistema de Gestión de Flota Aérea que permite administrar aviones, 
                programar vuelos y controlar el estado de la operación aérea en tiempo real.
            </p>
        </div>
        
    </div>
</body>
</html>