<?php
require 'includes/db.php';
require 'includes/functions.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['error' => 'No autorizado']));
}

$user_id = $_SESSION['user_id'];

// Verificar si hay archivos subidos
if (empty($_FILES['files'])) {
    http_response_code(400);
    die(json_encode(['error' => 'No se han subido archivos']));
}

// Directorio de subida del usuario
$user_dir = UPLOAD_DIR . $user_id . '/';

// Crear directorio si no existe
if (!file_exists($user_dir)) {
    mkdir($user_dir, 0777, true);
}

// Procesar cada archivo
$uploaded_files = [];
$errors = [];

foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
    $file_name = $_FILES['files']['name'][$key];
    $file_size = $_FILES['files']['size'][$key];
    $file_tmp = $_FILES['files']['tmp_name'][$key];
    $file_type = $_FILES['files']['type'][$key];
    
    // Validar tamaño del archivo
    if ($file_size > MAX_FILE_SIZE) {
        $errors[$file_name] = "El archivo excede el tamaño máximo permitido";
        continue;
    }
    
    // Verificar espacio disponible
    $stmt = $db->prepare("SELECT espacio_utilizado, espacio_maximo FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    
    if (($user_data['espacio_utilizado'] + $file_size) > $user_data['espacio_maximo']) {
        $errors[$file_name] = "No hay suficiente espacio disponible";
        continue;
    }
    
    // Generar nombre único para el archivo
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $stored_name = uniqid() . '.' . $file_ext;
    $file_path = $user_dir . $stored_name;
    
    // Mover el archivo
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Guardar en la base de datos
        $stmt = $db->prepare("INSERT INTO archivos (usuario_id, nombre_original, nombre_almacenado, ruta, tipo, tamano) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssi", $user_id, $file_name, $stored_name, $file_path, $file_type, $file_size);
        
        if ($stmt->execute()) {
            // Actualizar espacio utilizado
            $db->query("UPDATE usuarios SET espacio_utilizado = espacio_utilizado + $file_size WHERE id = $user_id");
            
            $uploaded_files[] = [
                'original_name' => $file_name,
                'stored_name' => $stored_name,
                'size' => $file_size,
                'type' => $file_type
            ];
        } else {
            $errors[$file_name] = "Error al guardar en la base de datos";
            unlink($file_path); // Eliminar el archivo subido
        }
    } else {
        $errors[$file_name] = "Error al mover el archivo";
    }
}

header('Content-Type: application/json');
echo json_encode([
    'success' => count($errors) === 0,
    'uploaded_files' => $uploaded_files,
    'errors' => $errors
]);
?>