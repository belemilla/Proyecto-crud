cat > aviones_delete.php << 'EOF'
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/crud.php';

echo "<!-- DEBUG: Iniciando aviones_delete.php -->\n";

// Verificar que se pasó un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<!-- DEBUG: No se recibió ID -->\n";
    header('Location: aviones_list.php?error=No se especificó el avión');
    exit();
}

$id = (int)$_GET['id'];
echo "<!-- DEBUG: ID recibido: $id -->\n";

$crud = new CRUD();

// Verificar que el avión existe
$avion = $crud->readAvion($id);
if (!$avion) {
    echo "<!-- DEBUG: Avión no encontrado -->\n";
    header('Location: aviones_list.php?error=El avión no existe');
    exit();
}

echo "<!-- DEBUG: Avión encontrado: " . $avion['matricula'] . " -->\n";

// Eliminar el avión
if ($crud->deleteAvion($id)) {
    echo "<!-- DEBUG: Eliminación exitosa -->\n";
    header('Location: aviones_list.php?mensaje=Avión eliminado exitosamente');
} else {
    echo "<!-- DEBUG: Error en eliminación -->\n";
    header('Location: aviones_list.php?error=Error al eliminar el avión');
}
exit();
?>
EOF