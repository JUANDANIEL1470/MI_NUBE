<?php
require 'includes/db.php';
require 'includes/functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    die("ID de archivo no válido");
}

$file_id = $_GET['id'];
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    http_response_code(401);
    die("No autorizado");
}

// Obtener información del archivo
$stmt = $db->prepare("SELECT * FROM archivos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $file_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    die("Archivo no encontrado");
}

$file = $result->fetch_assoc();

// Verificar que el archivo exista físicamente
if (!file_exists($file['ruta'])) {
    http_response_code(404);
    die("El archivo no existe en el servidor");
}

// Configurar headers para la descarga
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file['nombre_original']) . '"');
header('Content-Length: ' . filesize($file['ruta']));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

// Leer el archivo y enviarlo al navegador
readfile($file['ruta']);
exit;
?>