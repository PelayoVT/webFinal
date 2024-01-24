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
// Recoger los datos del formulario y sanearlos
$nombre = $connection->real_escape_string($_POST['nombre']);
$apellido = $connection->real_escape_string($_POST['apellido']);
$edad = (int)$_POST['edad'];
$usuario = $connection->real_escape_string($_POST['usuario']);
$contrasena = $connection->real_escape_string($_POST['contrasena']);

// Verificar si el usuario ya existe
$sql = "SELECT id FROM `usuarios` WHERE usuario = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Enviar una respuesta de error
    echo json_encode(["success" => false, "error" => "El nombre de usuario ya está en uso"]);
    $stmt->close();
    $connection->close();
    exit();
} else {
    $stmt->close();

    // Encriptar la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $sql = "INSERT INTO `usuarios` (nombre, apellido, edad, usuario, contrasena) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssiss", $nombre, $apellido, $edad, $usuario, $hashed_password);  // Reemplaza $contrasena
    

    if ($stmt->execute()) {
        // Enviar una respuesta de éxito
        echo json_encode(["success" => true]);
    } else {
        // En caso de error, enviar un mensaje de error
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
}

$connection->close();

