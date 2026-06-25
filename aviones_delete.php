cat > aviones_delete.php << 'EOF'
<?php
// ===== ACTIVAR ERRORES =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ===== DESACTIVAR CACHÉ =====
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

require_once 'includes/crud.php';

// ===== VERIFICAR ID =====
if (!isset($_GET['id']) || empty($_GET['id'])) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="2; url=aviones_list.php?error=No se especificó el avión">
        <title>Error - Aerolínea Pro</title>
        <style>
            body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
            .mensaje { background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div class="mensaje">
            <h2>❌ No se especificó el avión</h2>
            <p>Redirigiendo a la lista de aviones...</p>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$id = (int)$_GET['id'];
$crud = new CRUD();

// ===== VERIFICAR QUE EXISTE =====
$avion = $crud->readAvion($id);
if (!$avion) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="2; url=aviones_list.php?error=El avión no existe">
        <title>Error - Aerolínea Pro</title>
        <style>
            body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
            .mensaje { background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div class="mensaje">
            <h2>❌ El avión no existe</h2>
            <p>Redirigiendo a la lista de aviones...</p>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// ===== INTENTAR ELIMINAR =====
$resultado = $crud->deleteAvion($id);

// ===== MOSTRAR RESULTADO =====
if ($resultado) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="1; url=aviones_list.php?mensaje=Avión eliminado exitosamente">
        <title>Eliminando - Aerolínea Pro</title>
        <style>
            body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
            .mensaje { background: #d1fae5; color: #065f46; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
            .spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #10b981;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 1s linear infinite;
                margin: 20px auto;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>
        <div class="mensaje">
            <h2>✅ Avión eliminado exitosamente</h2>
            <div class="spinner"></div>
            <p>Redirigiendo a la lista de aviones...</p>
            <p><a href="aviones_list.php" style="color:#065f46;">Haz clic aquí si no eres redirigido</a></p>
        </div>
    </body>
    </html>
    <?php
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="refresh" content="2; url=aviones_list.php?error=Error al eliminar el avión">
        <title>Error - Aerolínea Pro</title>
        <style>
            body { font-family: Arial; padding: 50px; text-align: center; background: #f0f4f8; }
            .mensaje { background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto; }
        </style>
    </head>
    <body>
        <div class="mensaje">
            <h2>❌ Error al eliminar el avión</h2>
            <p>Redirigiendo a la lista de aviones...</p>
            <p><a href="aviones_list.php" style="color:#991b1b;">Haz clic aquí si no eres redirigido</a></p>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>
EOF