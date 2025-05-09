<?php
require 'includes/db.php';
require 'includes/functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de archivo no válido");
}

$file_id = $_GET['id'];

// Obtener información del archivo
$stmt = $db->prepare("SELECT archivos.*, usuarios.nombre, usuarios.apellido 
                      FROM archivos 
                      JOIN usuarios ON archivos.usuario_id = usuarios.id
                      WHERE archivos.id = ?");
$stmt->bind_param("i", $file_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Archivo no encontrado");
}

$file = $result->fetch_assoc();

// Verificar que el archivo exista físicamente
if (!file_exists($file['ruta'])) {
    die("El archivo no existe en el servidor");
}

// Mostrar información del archivo compartido
?>
<!DOCTYPE html>
<html>
<head>
    <title>Archivo compartido: <?= htmlspecialchars($file['nombre_original']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="shared-file-container">
        <h1>Archivo compartido</h1>
        <div class="file-info">
            <p><strong>Nombre:</strong> <?= htmlspecialchars($file['nombre_original']) ?></p>
            <p><strong>Tamaño:</strong> <?= format_size($file['tamano']) ?></p>
            <p><strong>Subido por:</strong> <?= htmlspecialchars($file['nombre'] . ' ' . $file['apellido']) ?></p>
            <p><strong>Fecha de subida:</strong> <?= date('d/m/Y H:i', strtotime($file['fecha_subida'])) ?></p>
        </div>
        <a href="download.php?id=<?= $file['id'] ?>" class="download-btn">Descargar archivo</a>
    </div>
</body>
</html>