<?php
require_once 'includes/db.php';
require_once 'includes/config.php';

redirigir_si_logueado();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = limpiar_input($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = "❌ Todos los campos son obligatorios";
    } else {
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($password, $usuario['password'])) {
            if ($usuario['activo'] == 0) {
                $error = "❌ Tu cuenta está desactivada. Contacta al administrador.";
            } else {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol'];
                
                registrar_bitacora($usuario['id'], $usuario['email'], "Inicio de sesión");
                registrar_historial($usuario['id'], $usuario['email'], "Login exitoso");
                
                header('Location: index.php');
                exit();
            }
        } else {
            registrar_bitacora(0, $email, "Intento de login fallido");
            $error = "❌ Email o contraseña incorrectos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aerolínea Pro</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        .auth-container {
            max-width: 400px;
            margin: 60px auto;
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
        .auth-container .link { text-align: center; margin-top: 15px; }
        .auth-container .link a { color: #1a3a5c; text-decoration: none; }
        .auth-container .link a:hover { text-decoration: underline; }
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
            <h1>🔐 Iniciar Sesión</h1>
            
            <?php if ($error): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="tu@email.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="Tu contraseña" required>
                </div>
                
                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>
            
            <div class="link">
                ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
            </div>
        </div>
    </div>
</body>
</html>