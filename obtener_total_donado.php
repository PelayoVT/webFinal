<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webfinal";

// Intentar establecer conexión
$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    $response = array("error" => "La conexión con la BBDD ha fallado: " . mysqli_connect_error());
    echo json_encode($response);
    exit();
}

$query = "SELECT cantidad FROM total_donado_global WHERE id = 1";
$result = mysqli_query($connection, $query);

if (!$result) {
    $response = array("error" => "Error al obtener la cantidad total: " . mysqli_error($connection));
    echo json_encode($response);
    exit();
}

$row = mysqli_fetch_assoc($result);
$cantidad_total = $row['cantidad'];

$response = array("cantidad_donada" => $cantidad_total);
echo json_encode($response);
exit();
?>
