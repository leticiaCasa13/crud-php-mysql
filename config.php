<?php
$host = 'localhost';
$db   = 'empresa'; // Nombre de tu base de datos
$user = 'usuario'; // Tu usuario de MySQL
$pass = 'usuario'; // Tu contraseña de MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
?>
