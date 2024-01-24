<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webfinal";

// Intentar establecer conexión
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$connection) {
    die("La conexión con la BBDD ha fallado: " . mysqli_connect_error());
}

if (!isset($_SESSION['usuario_id'])) {
    // Redirige a la página de inicio de sesión o maneja la falta de sesión de la manera que desees
    header("Location: login.php");
    exit();
}

// Recolectar datos del formulario y de la sesión del usuario
$cantidad_donada = floatval($_POST['cantidad_donada']); // Convertir a float
$fecha_donacion = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual en formato MySQL

// Preparar y ejecutar la consulta SQL para insertar la donación
$stmt = $connection->prepare("INSERT INTO donaciones (cantidad_donada, usuario_id, fecha_donacion) VALUES (?, ?, ?)");
$stmt->bind_param("dis", $cantidad_donada, $_SESSION['usuario_id'], $fecha_donacion);
if ($stmt->execute()) {
    // Actualizar la tabla total_donado_global
    $update_query = "UPDATE total_donado_global SET cantidad = cantidad + ? WHERE id = 1";
    $stmt_update = $connection->prepare($update_query);
    $stmt_update->bind_param("d", $cantidad_donada);
    $stmt_update->execute();
    $stmt_update->close();

    // Cerrar la declaración y la conexión.
    $stmt->close();
    $connection->close();

    // Mensaje de agradecimiento
    $mensaje = "Gracias por tu donación de $". htmlspecialchars($cantidad_donada) .". Serás redirigido en breve.";

    // Redirigir después de 5 segundos con JavaScript
    echo "<script>
            alert('$mensaje');
            setTimeout(function(){
                window.location.href = 'index.php';
            }, 1000);
          </script>";
} else {
    echo "Error: " . $stmt->error;
}
?>
