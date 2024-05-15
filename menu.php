<?php
// Archivo para mostrar las preguntas y respuestas en tarjetas Bootstrap

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

try {
    // Obtener las preguntas y respuestas de la base de datos
    $sql = "SELECT p.id AS pregunta_id, p.texto AS pregunta_texto, r.id AS respuesta_id, r.texto AS respuesta_texto 
            FROM cat_pregunta AS p 
            LEFT JOIN cat_respuesta AS r ON p.id = r.pregunta_id 
            ORDER BY p.id, r.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Variable para almacenar el ID de la pregunta anterior
    $id_pregunta_anterior = null;

    // Comienza el formulario
    echo "<form action='guardar_respuestas.php' method='post'>";
    
    // Iterar sobre el resultado de la consulta
    foreach ($preguntas as $pregunta) {
        $pregunta_id = $pregunta['pregunta_id'];
        $pregunta_texto = $pregunta['pregunta_texto'];
        $respuesta_id = $pregunta['respuesta_id'];
        $respuesta_texto = $pregunta['respuesta_texto'];

        // Si es una nueva pregunta, mostrar la tarjeta Bootstrap
        if ($pregunta_id != $id_pregunta_anterior) {
            // Cerrar la tarjeta anterior si no es la primera pregunta
            if ($id_pregunta_anterior !== null) {
                echo '</div>'; // Cerrar el div de la tarjeta
            }
            // Mostrar la tarjeta de Bootstrap para la nueva pregunta
            echo "<div class='card pregunta' id='pregunta_$pregunta_id'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>$pregunta_texto</h5>";
        }

        // Mostrar la opción de respuesta como un radio button
        echo "<div class='form-check'>";
        echo "<input class='form-check-input' type='radio' name='pregunta_$pregunta_id' value='$respuesta_id'>";
        echo "<label class='form-check-label'>$respuesta_texto</label>";
        echo "</div>";

        // Actualizar el ID de la pregunta anterior
        $id_pregunta_anterior = $pregunta_id;
    }

    // Cerrar la última tarjeta
    echo '</div>'; // Cerrar el div de la tarjeta

    // Liberar el resultado

    // Botón para enviar el formulario
    echo "<button type='submit' class='btn btn-primary'>Guardar respuestas</button>";
    echo "</form>";

} catch (PDOException $e) {
    // Si hay un error, mostrar el mensaje de error
    echo "Error al mostrar preguntas y respuestas: " . $e->getMessage();
}
?>
