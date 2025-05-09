<?php
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['error' => 'No autorizado']));
}

$input = json_decode(file_get_contents('php://input'), true);
$file_id = $input['file_id'] ?? null;

if (!$file_id) {
    http_response_code(400);
    die(json_encode(['error' => 'ID de archivo no válido']));
}

// Verificar que el archivo pertenezca al usuario
$stmt = $db->prepare("SELECT id, ruta FROM archivos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $file_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    die(json_encode(['error' => 'Archivo no encontrado']));
}

$file = $result->fetch_assoc();

// Mover a papelera (en este caso solo marcamos como eliminado)
$stmt = $db->prepare("UPDATE archivos SET eliminado = 1, fecha_eliminacion = NOW() WHERE id = ?");
$stmt->bind_param("i", $file_id);
$success = $stmt->execute();

// Opcional: realmente mover el archivo a una carpeta de papelera
// $new_path = str_replace('/uploads/', '/uploads/trash/', $file['ruta']);
// rename($file['ruta'], $new_path);

echo json_encode(['success' => $success]);
?>