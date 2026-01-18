<?php
// Elimina '-ejemplo' del nombre del archivo y completa los datos de conexión
$host = 'localhost';
$db = 'nombre de tu base de datos';
$user = 'nombre de usuario o root';
$password = 'contraseña de tu base de datos';
try {
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Error de conexión: " . $e->getMessage());
}
?>