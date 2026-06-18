-- Tabla de aviones
CREATE TABLE aviones (
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
CREATE TABLE vuelos (
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
CREATE TABLE pilotos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    apellido TEXT NOT NULL,
    licencia TEXT UNIQUE NOT NULL,
    horas_vuelo INTEGER DEFAULT 0
);

-- DATOS DE EJEMPLO - Aviones
INSERT INTO aviones (matricula, modelo, fabricante, capacidad, año_fabricacion) VALUES 
('CC-ABC', 'Boeing 787 Dreamliner', 'Boeing', 290, 2020),
('CC-DEF', 'Airbus A320', 'Airbus', 180, 2021),
('CC-GHI', 'Boeing 737-800', 'Boeing', 150, 2019),
('CC-JKL', 'Airbus A380', 'Airbus', 500, 2022),
('AP-082', 'Boeing 737', 'Boeing', 160, 2018),
('AP-087', 'Airbus A321', 'Airbus', 200, 2019),
('AP-011', 'Boeing 767', 'Boeing', 250, 2017);

-- DATOS DE EJEMPLO - Vuelos
INSERT INTO vuelos (numero_vuelo, avion_id, origen, destino, hora_salida, hora_llegada) VALUES 
('AA123', 1, 'SCL', 'MIA', '2026-06-20 10:30:00', '2026-06-20 18:45:00'),
('AA456', 2, 'SCL', 'BOG', '2026-06-20 12:15:00', '2026-06-20 15:30:00'),
('AA789', 3, 'SCL', 'MAD', '2026-06-20 15:45:00', '2026-06-21 08:30:00');

-- DATOS DE EJEMPLO - Pilotos
INSERT INTO pilotos (nombre, apellido, licencia, horas_vuelo) VALUES 
('Carlos', 'Ramírez', 'PIL-001', 2500),
('Laura', 'Mendoza', 'PIL-002', 1800),
('Jorge', 'Peña', 'PIL-003', 3200);