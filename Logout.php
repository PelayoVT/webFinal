<?php
session_start();

// Desestablecer todas las variables de sesión.
$_SESSION = array();

// Si es deseado, destruir la sesión completamente.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Redirigir al usuario al login o a la página de inicio.
header("Location: index.php");
exit();
?>