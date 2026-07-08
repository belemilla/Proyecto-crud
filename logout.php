cat > logout.php << 'EOF'
<?php
// ===== PRIMERO CARGAR CONFIGURACIÓN =====
require_once 'includes/config.php';

// ===== REGISTRAR CIERRE DE SESIÓN EN BITÁCORA =====
if (usuario_logueado()) {
    // Verificar que la función existe
    if (function_exists('registrar_bitacora')) {
        registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Cierre de sesión");
    }
    if (function_exists('registrar_historial')) {
        registrar_historial($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Logout");
    }
}

// ===== DESTRUIR SESIÓN =====
$_SESSION = array();
session_destroy();

// ===== REDIRIGIR AL LOGIN =====
header('Location: login.php');
exit();
?>
EOF