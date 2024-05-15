<?php
// Aquí se realiza la conexión a la base de datos
// Datos de conexión a la base de datos
include("conexion.php");

// Verificar si se enviaron datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    try {
        // Realizar la consulta SQL para verificar las credenciales
        // Recuerda usar sentencias preparadas para evitar inyecciones SQL
        $sql = "SELECT * FROM cat_usuario WHERE correo = ? AND pwd = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuario, $contrasena]);
        
        // Obtener el resultado de la consulta
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($user) {
            // Iniciar sesión
            session_start();
            $_SESSION['usuario'] = $usuario;
            // Redirigir al usuario a la página de inicio
            header("Location: menu.php");
            exit();
        } else {
            // Si las credenciales no son válidas, mostrar un mensaje de error y redirigir al usuario al formulario de inicio de sesión
            echo "Usuario o contraseña incorrectos";
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Manejar cualquier error de PDO
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se recibieron datos por POST, redirigir al usuario al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}
?>
