<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Los mismos estilos que login.php */
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
        }
        
        .auth-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .auth-logo {
            margin-bottom: 30px;
        }
        
        .auth-logo i {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        .auth-title {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .auth-subtitle {
            color: var(--gray-color);
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.2);
            outline: none;
        }
        
        .btn-block {
            width: 100%;
        }
        
        .auth-footer {
            margin-top: 20px;
        }
        
        .auth-footer a {
            color: var(--primary-color);
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card animate__animated animate__fadeIn">
            <div class="auth-logo">
                <i class="fas fa-cloud"></i>
            </div>
            <h1 class="auth-title">Crear Cuenta</h1>
            <p class="auth-subtitle">Regístrate para empezar a usar tu almacenamiento en la nube</p>
            
            <form action="includes/auth.php" method="POST">
                <input type="hidden" name="action" value="register">
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn-primary btn-block">Registrarse</button>
                </div>
            </form>
            
            <div class="auth-footer">
                ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>
            </div>
        </div>
    </div>
</body>
</html>