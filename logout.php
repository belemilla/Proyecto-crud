<?php
// ===== REGISTRAR EN BITÁCORA - CIERRE DE SESIÓN =====
registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Cierre de sesión");
require_once 'includes/db.php';
require_once 'includes/config.php';

if (usuario_logueado()) {
    registrar_bitacora($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Cierre de sesión");
    registrar_historial($_SESSION['usuario_id'], $_SESSION['usuario_email'], "Logout");
}

$_SESSION = array();
session_destroy();

header('Location: login.php');
exit();
?>