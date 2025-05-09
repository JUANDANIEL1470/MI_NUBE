<?php
require 'includes/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Obtener información del usuario
$stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Procesar actualización de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = clean_input($_POST['nombre']);
    $apellido = clean_input($_POST['apellido']);
    $email = clean_input($_POST['email']);
    $current_password = clean_input($_POST['current_password']);
    $new_password = clean_input($_POST['new_password']);
    $confirm_password = clean_input($_POST['confirm_password']);

    // Validar contraseña actual si se quiere cambiar
    if (!empty($new_password)) {
        if (!password_verify($current_password, $user['password'])) {
            $error = "La contraseña actual es incorrecta";
        } elseif ($new_password !== $confirm_password) {
            $error = "Las nuevas contraseñas no coinciden";
        } elseif (strlen($new_password) < 8) {
            $error = "La nueva contraseña debe tener al menos 8 caracteres";
        } else {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        }
    }

    // Actualizar información
    if (!isset($error)) {
        $password_to_update = isset($hashed_password) ? $hashed_password : $user['password'];
        
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $apellido, $email, $password_to_update, $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['user_name'] = $nombre . ' ' . $apellido;
            $success = "Perfil actualizado correctamente";
            // Actualizar datos del usuario
            $user['nombre'] = $nombre;
            $user['apellido'] = $apellido;
            $user['email'] = $email;
        } else {
            $error = "Error al actualizar el perfil: " . $db->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <style>
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background-color: var(--dark-color);
            color: white;
            padding: 20px 0;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .sidebar-logo i {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        .sidebar-logo span {
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 600;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: var(--transition);
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .menu-item.active {
            background-color: var(--primary-color);
        }
        
        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            flex: 1;
            background-color: #f5f7fa;
            padding: 30px;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .profile-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: var(--shadow);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            margin-right: 20px;
        }
        
        .profile-info h2 {
            margin-bottom: 5px;
        }
        
        .profile-info p {
            color: var(--gray-color);
        }
        
        .profile-form {
            max-width: 600px;
        }
        
        .form-group {
            margin-bottom: 20px;
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
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background-color: #3367d6;
        }
        
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-cloud"></i>
                    <span>Mi Nube</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar"><?php echo strtoupper(substr($user_name, 0, 1)); ?></div>
                    <div>
                        <div class="user-name"><?php echo $user_name; ?></div>
                        <div class="user-email">Mi cuenta</div>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="dashboard.php" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-upload"></i>
                    <span>Subir Archivos</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-share-alt"></i>
                    <span>Compartidos</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-star"></i>
                    <span>Favoritos</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-trash"></i>
                    <span>Papelera</span>
                </a>
                <a href="profile.php" class="menu-item active">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
                <a href="logout.php" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </div>
        <div class="main-content">
            <div class="top-bar">
                <h1 class="page-title">Mi Perfil</h1>
            </div>
            
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-avatar"><?php echo strtoupper(substr($user['nombre'], 0, 1)); ?></div>
                    <div class="profile-info">
                        <h2><?php echo $user['nombre'] . ' ' . $user['apellido']; ?></h2>
                        <p>Miembro desde <?php echo date('d/m/Y', strtotime($user['fecha_registro'])); ?></p>
                    </div>
                </div>
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form action="profile.php" method="POST" class="profile-form">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $user['nombre']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo $user['apellido']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                    </div>
                    
                    <h3 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Cambiar Contraseña</h3>
                    
                    <div class="form-group">
                        <label for="current_password">Contraseña Actual</label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña</label>
                        <input type="password" id="new_password" name="new_password" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Nueva Contraseña</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="assets/js/main.js"></script>
</body>
</html>