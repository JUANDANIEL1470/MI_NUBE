<?php
session_start();
require 'config.php';

// Conexión a la base de datos
$db = new mysqli('localhost', 'root', '', 'mi_nube');

if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}

// Función para limpiar datos de entrada
function clean_input($data) {
    global $db;
    return htmlspecialchars(strip_tags($db->real_escape_string(trim($data))));
}
?>