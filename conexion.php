<?php

// Configuración de la conexión PDO
$host = 'localhost:8080'; // Cambia 'nombre_del_host' por el nombre de tu host de MySQL
$dbname = 'tesisbd'; // Cambia 'nombre_de_la_base_de_datos' por el nombre de tu base de datos
$charset = 'utf8mb4'; // Cambia 'utf8mb4' si es necesario
$port = '3306'; // Agrega el número de puerto aquí

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
$username = 'root'; // Cambia 'nombre_de_usuario' por tu nombre de usuario de MySQL
$password = 'admin'; // Cambia 'contraseña' por tu contraseña de MySQL (si es necesario)
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