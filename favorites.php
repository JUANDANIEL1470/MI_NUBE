<?php
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die(json_encode(['error' => 'No autorizado']));
}

$input = json_decode(file_get_contents('php://input'), true);
$file_id = $input['file_id'] ?? null;
$action = $input['action'] ?? null;

if (!$file_id || !in_array($action, ['add', 'remove'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Datos inválidos']));
}

// Verificar que el archivo pertenezca al usuario
$stmt = $db->prepare("SELECT id FROM archivos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $file_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    die(json_encode(['error' => 'Archivo no encontrado']));
}

// Actualizar estado de favorito
if ($action === 'add') {
    $stmt = $db->prepare("UPDATE archivos SET es_favorito = 1 WHERE id = ?");
} else {
    $stmt = $db->prepare("UPDATE archivos SET es_favorito = 0 WHERE id = ?");
}

$stmt->bind_param("i", $file_id);
$success = $stmt->execute();

echo json_encode(['success' => $success]);
?>