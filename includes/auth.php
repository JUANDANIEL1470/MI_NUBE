<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = clean_input($_POST['action']);
    
    if ($action === 'register') {
        // Proceso de registro
        $nombre = clean_input($_POST['nombre']);
        $apellido = clean_input($_POST['apellido']);
        $email = clean_input($_POST['email']);
        $password = clean_input($_POST['password']);
        $confirm_password = clean_input($_POST['confirm_password']);
        
        // Validaciones
        if ($password !== $confirm_password) {
            die("Las contraseñas no coinciden");
        }
        
        if (strlen($password) < 8) {
            die("La contraseña debe tener al menos 8 caracteres");
        }
        
        // Verificar si el email ya existe
        $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            die("Este correo electrónico ya está registrado");
        }
        
        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Insertar nuevo usuario
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $hashed_password);
        
        if ($stmt->execute()) {
            // Crear carpeta para el usuario
            $user_id = $stmt->insert_id;
            $user_folder = UPLOAD_DIR . $user_id;
            
            if (!file_exists($user_folder)) {
                mkdir($user_folder, 0777, true);
            }
            
            header("Location: ../login.php?registered=1");
            exit();
        } else {
            die("Error al registrar el usuario: " . $db->error);
        }
    } elseif ($action === 'login') {
        // Proceso de login
        $email = clean_input($_POST['email']);
        $password = clean_input($_POST['password']);
        
        // Buscar usuario
        $stmt = $db->prepare("SELECT id, nombre, apellido, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // Iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'] . ' ' . $user['apellido'];
                
                header("Location: ../dashboard.php");
                exit();
            } else {
                die("Contraseña incorrecta");
            }
        } else {
            die("Usuario no encontrado");
        }
    }
}
?>