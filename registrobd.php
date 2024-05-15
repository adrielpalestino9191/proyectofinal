<?php
// Aquí se realiza la conexión a la base de datos
// Datos de conexión a la base de datos
include("conexion.php");

// Verificar si se enviaron datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    try {
        // Verificar si el usuario ya existe en la base de datos
        $sql_verificar_usuario = "SELECT * FROM cat_usuario WHERE usuario = ?";
        $stmt = $pdo->prepare($sql_verificar_usuario);
        $stmt->execute([$usuario]);
        $result_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result_usuario) {
            // Si el usuario ya existe, mostrar un mensaje de error y redirigir al usuario al formulario de registro
            echo "El usuario ya existe. Por favor, elige otro nombre de usuario.";
            header("Location: registro.html");
            exit();
        } else {
            // Insertar nuevo usuario en la base de datos
            $sql_insertar_usuario = "INSERT INTO cat_usuario (usuario, contrasena, nombre, email) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql_insertar_usuario);
            $stmt->execute([$usuario, $contrasena, $nombre, $email]);

            // Redirigir al usuario a la página de inicio de sesión después del registro exitoso
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Si hay un error, mostrar el mensaje de error y redirigir al usuario al formulario de registro
        echo "Error al registrar usuario: " . $e->getMessage();
        header("Location: registro.html");
        exit();
    }
} else {
    // Si no se recibieron datos por POST, redirigir al usuario al formulario de registro
    header("Location: registro.html");
    exit();
}
?>
