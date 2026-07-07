<?php
require_once 'includes/db.php';
require_once 'includes/config.php';

redirigir_si_logueado();

$error = '';
$exito = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = limpiar_input($_POST['nombre']);
    $email = limpiar_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($nombre) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "❌ Todos los campos son obligatorios";
    } elseif (!validar_email($email)) {
        $error = "❌ El email no es válido";
    } elseif ($password !== $confirm_password) {
        $error = "❌ Las contraseñas no coinciden";
    } else {
        $validacion = validar_password($password);
        if (!$validacion['valido']) {
            $error = "❌ " . $validacion['mensaje'];
        } else {
            $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error = "❌ El email ya está registrado";
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
                if ($stmt->execute([$nombre, $email, $password_hash])) {
                    $usuario_id = $db->lastInsertId();
                    registrar_bitacora($usuario_id, $email, "Registro de usuario");
                    registrar_historial($usuario_id, $email, "Usuario registrado");
                    $exito = "✅ Usuario registrado exitosamente. <a href='login.php'>Iniciar sesión</a>";
                } else {
                    $error = "❌ Error al registrar usuario";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Aerolínea Pro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        .auth-container {
            max-width: 450px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .auth-container h1 { color: #1a3a5c; text-align: center; margin-bottom: 25px; }
        .auth-container .form-group { margin-bottom: 18px; }
        .auth-container label { display: block; font-weight: 500; margin-bottom: 5px; color: #333; }
        .auth-container input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        .auth-container input:focus { border-color: #1a3a5c; outline: none; }
        .auth-container .btn {
            width: 100%;
            padding: 12px;
            background: #1a3a5c;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
        }
        .auth-container .btn:hover { background: #0f2a44; }
        .auth-container .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .auth-container .exito {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .auth-container .link { text-align: center; margin-top: 15px; }
        .auth-container .link a { color: #1a3a5c; text-decoration: none; }
        .auth-container .link a:hover { text-decoration: underline; }
        .requisitos {
            background: #f8f9fa;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
            color: #666;
        }
        .requisitos ul { margin: 5px 0 0 20px; }
        .header-simple {
            background: linear-gradient(135deg, #0a1628, #1a3a5c);
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
        }
        .header-simple h1 { font-size: 24px; font-weight: 300; }
        .header-simple h1 span { font-weight: 700; color: #4fc3f7; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-simple">
            <h1>✈️ <span>Aerolínea</span> Pro</h1>
        </div>
        
        <div class="auth-container">
            <h1>📝 Crear Cuenta</h1>
            
            <?php if ($error): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            
            <?php if ($exito): ?>
                <div class="exito"><?= $exito ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Nombre completo *</label>
                    <input type="text" name="nombre" placeholder="Tu nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" placeholder="tu@email.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label>Contraseña *</label>
                    <input type="password" name="password" placeholder="Mínimo 8 caracteres" required>
                </div>
                
                <div class="form-group">
                    <label>Confirmar contraseña *</label>
                    <input type="password" name="confirm_password" placeholder="Repite tu contraseña" required>
                </div>
                
                <div class="requisitos">
                    <strong>Requisitos de contraseña:</strong>
                    <ul>
                        <li>Mínimo 8 caracteres</li>
                        <li>Al menos 1 mayúscula (A-Z)</li>
                        <li>Al menos 1 minúscula (a-z)</li>
                        <li>Al menos 1 número (0-9)</li>
                        <li>Al menos 1 carácter especial (!@#$%^&*)</li>
                    </ul>
                </div>
                
                <button type="submit" class="btn">Registrarse</button>
            </form>
            
            <div class="link">
                ¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a>
            </div>
        </div>
    </div>
</body>
</html>