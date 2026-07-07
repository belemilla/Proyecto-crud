<?php
// ===== CONFIGURACIÓN DEL SISTEMA =====

// Activar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de sesiones
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== VALIDACIONES DE SEGURIDAD =====

// 1. Validar contraseña: mínimo 8 caracteres, 1 mayúscula, 1 minúscula, 1 número
function validar_password($password) {
    if (strlen($password) < 8) {
        return ["valido" => false, "mensaje" => "La contraseña debe tener al menos 8 caracteres"];
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return ["valido" => false, "mensaje" => "La contraseña debe tener al menos 1 mayúscula"];
    }
    if (!preg_match('/[a-z]/', $password)) {
        return ["valido" => false, "mensaje" => "La contraseña debe tener al menos 1 minúscula"];
    }
    if (!preg_match('/[0-9]/', $password)) {
        return ["valido" => false, "mensaje" => "La contraseña debe tener al menos 1 número"];
    }
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return ["valido" => false, "mensaje" => "La contraseña debe tener al menos 1 carácter especial"];
    }
    return ["valido" => true, "mensaje" => "Contraseña válida"];
}

// 2. Validar email
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// 3. Limpiar entrada de usuario
function limpiar_input($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// ===== FUNCIONES DE BITÁCORA =====

function registrar_bitacora($usuario_id, $usuario_email, $accion) {
    global $db;
    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $sql = "INSERT INTO bitacora (usuario_id, usuario_email, accion, ip) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$usuario_id, $usuario_email, $accion, $ip]);
    } catch (PDOException $e) {
        return false;
    }
}

function registrar_historial($usuario_id, $usuario_email, $evento) {
    global $db;
    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconocido';
        $sql = "INSERT INTO historial_sesiones (usuario_id, usuario_email, evento, ip, user_agent) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$usuario_id, $usuario_email, $evento, $ip, $user_agent]);
    } catch (PDOException $e) {
        return false;
    }
}

// ===== FUNCIONES DE USUARIO =====

function usuario_logueado() {
    return isset($_SESSION['usuario_id']);
}

function get_usuario_actual() {
    if (!usuario_logueado()) {
        return null;
    }
    global $db;
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION['usuario_id']]);
    return $stmt->fetch();
}

function redirigir_si_no_logueado() {
    if (!usuario_logueado()) {
        header('Location: login.php');
        exit();
    }
}

function redirigir_si_logueado() {
    if (usuario_logueado()) {
        header('Location: index.php');
        exit();
    }
}
?>