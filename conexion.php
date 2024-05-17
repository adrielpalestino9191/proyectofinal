<?php

// Configuración de la conexión PDO
$host = getenv('MYSQL_HOST');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$database = getenv('MYSQL_DATABASE');

$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
$pdo=null;
// Intenta realizar la conexión PDO
try {
    $pdo = new PDO($dsn, $username, $password);
    // Establece el modo de error de PDO en excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conexión exitosa"; // Esto es opcional, solo para verificar la conexión exitosa
} catch (PDOException $e) {
    // En caso de error, muestra el mensaje de error
    echo "Error de conexión: " . $e->getMessage();
}


?>