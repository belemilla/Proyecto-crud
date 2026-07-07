-- ============================================
-- TABLAS DEL SISTEMA
-- ============================================

-- Tabla de aviones
CREATE TABLE IF NOT EXISTS aviones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    matricula TEXT UNIQUE NOT NULL,
    modelo TEXT NOT NULL,
    fabricante TEXT NOT NULL,
    capacidad INTEGER NOT NULL,
    año_fabricacion INTEGER,
    estado TEXT DEFAULT 'Activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de vuelos
CREATE TABLE IF NOT EXISTS vuelos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    numero_vuelo TEXT UNIQUE NOT NULL,
    avion_id INTEGER NOT NULL,
    origen TEXT NOT NULL,
    destino TEXT NOT NULL,
    hora_salida DATETIME NOT NULL,
    hora_llegada DATETIME NOT NULL,
    estado TEXT DEFAULT 'Programado',
    FOREIGN KEY (avion_id) REFERENCES aviones(id) ON DELETE CASCADE
);

-- Tabla de pilotos
CREATE TABLE IF NOT EXISTS pilotos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    apellido TEXT NOT NULL,
    licencia TEXT UNIQUE NOT NULL,
    horas_vuelo INTEGER DEFAULT 0
);

-- ============================================
-- TABLAS PARA EL LOGIN
-- ============================================

-- Tabla de usuarios (para login)
CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    rol TEXT DEFAULT 'usuario',
    activo INTEGER DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de bitácora (registra todas las acciones)
CREATE TABLE IF NOT EXISTS bitacora (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER,
    usuario_email TEXT,
    accion TEXT NOT NULL,
    ip TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de historial de sesiones
CREATE TABLE IF NOT EXISTS historial_sesiones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER,
    usuario_email TEXT,
    evento TEXT NOT NULL,
    ip TEXT,
    user_agent TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- ============================================
-- DATOS DE EJEMPLO
-- ============================================

-- Aviones
INSERT OR IGNORE INTO aviones (matricula, modelo, fabricante, capacidad, año_fabricacion) VALUES 
('CC-ABC', 'Boeing 787 Dreamliner', 'Boeing', 290, 2020),
('CC-DEF', 'Airbus A320', 'Airbus', 180, 2021),
('CC-GHI', 'Boeing 737-800', 'Boeing', 150, 2019),
('CC-JKL', 'Airbus A380', 'Airbus', 500, 2022),
('AP-082', 'Boeing 737', 'Boeing', 160, 2018),
('AP-087', 'Airbus A321', 'Airbus', 200, 2019),
('AP-011', 'Boeing 767', 'Boeing', 250, 2017);

-- Vuelos
INSERT OR IGNORE INTO vuelos (numero_vuelo, avion_id, origen, destino, hora_salida, hora_llegada) VALUES 
('AA123', 1, 'SCL', 'MIA', '2026-06-20 10:30:00', '2026-06-20 18:45:00'),
('AA456', 2, 'SCL', 'BOG', '2026-06-20 12:15:00', '2026-06-20 15:30:00'),
('AA789', 3, 'SCL', 'MAD', '2026-06-20 15:45:00', '2026-06-21 08:30:00');

-- Pilotos
INSERT OR IGNORE INTO pilotos (nombre, apellido, licencia, horas_vuelo) VALUES 
('Carlos', 'Ramírez', 'PIL-001', 2500),
('Laura', 'Mendoza', 'PIL-002', 1800),
('Jorge', 'Peña', 'PIL-003', 3200);

-- Usuario admin por defecto (email: admin@aerolinea.com, password: Admin123!)
INSERT OR IGNORE INTO usuarios (nombre, email, password, rol) VALUES 
('Administrador', 'admin@aerolinea.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Usuario de prueba (email: usuario@aerolinea.com, password: User123!)
INSERT OR IGNORE INTO usuarios (nombre, email, password, rol) VALUES 
('Usuario Prueba', 'usuario@aerolinea.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'usuario');