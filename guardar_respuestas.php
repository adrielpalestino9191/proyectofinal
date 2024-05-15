<?php
// Archivo para guardar las respuestas seleccionadas en la base de datos
session_start();
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el formulario con respuestas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Iniciar una transacción
        $pdo->beginTransaction();

        // Iterar sobre las respuestas enviadas en el formulario
        foreach ($_POST as $pregunta_id => $respuesta_id) {
            // Obtener el ID de la pregunta y el ID de la respuesta seleccionada
            // El nombre de las respuestas en el formulario tiene el formato 'pregunta_$pregunta_id'
            $pregunta_id = substr($pregunta_id, 9); // Eliminar 'pregunta_' del nombre
            $respuesta_id = intval($respuesta_id); // Convertir el ID de la respuesta a entero

            // Insertar la respuesta en la tabla rel_alumno_pregres
            $sql = "INSERT INTO rel_alumno_pregres (id_usuario, id_pregunta, id_respuesta) 
                    VALUES (:id_usuario, :id_pregunta, :id_respuesta)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $_SESSION['usuario']['id_usuario'],
                ':id_pregunta' => $pregunta_id,
                ':id_respuesta' => $respuesta_id
            ]);
        }

        // Confirmar la transacción
        $pdo->commit();

        // Redireccionar de vuelta al formulario después de guardar las respuestas
        echo "<script>alert('Respuestas almacenadas con éxito, ¡gracias!')</script>";
        // header("Location: formulario_preguntas.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error, hacer rollback de la transacción
        $pdo->rollBack();
        echo "Error al insertar respuestas: " . $e->getMessage();
    }
} else {
    // Si no se reciben datos por POST, redirigir a la página de inicio o mostrar un mensaje de error
    header("Location: index.php");
    exit();
}
?>
