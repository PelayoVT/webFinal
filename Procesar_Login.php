<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webfinal";

// Intentar establecer conexión
$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("La conexión con la BBDD ha fallado: " . mysqli_connect_error());
}

if (isset($_POST['uname'])) {
    $uname = $_POST['uname'];
    $pswd = $_POST['pswd'];

    // Consulta para obtener la contraseña y el id del usuario
    $sql = "SELECT id, contrasena, usuario FROM usuarios WHERE usuario = '$uname'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pswd, $row['contrasena'])) {
            // La contraseña es correcta
            $_SESSION['usuario_id'] = $row['id'];  // Almacena el id en la sesión
            $_SESSION['uname'] = $uname;
            header("Location: index.php");
            exit();
        } else {
            // La contraseña es incorrecta
            echo "Usuario o contraseña incorrectos";
            exit();
        }
    } else {
        // El usuario no existe
        echo "El Usuario No está registrado";
        exit();
    }
}

// Resto del código HTML (sin la sección de los Reyes Magos)
?>
