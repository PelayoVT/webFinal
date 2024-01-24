<!DOCTYPE html>
<?php
session_start();
?>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./CSS/LogReg_Style.css">
</head>

<body>
    <header>
        <div id="head_title">
            <h1>¡Regístrate!</h1>
        </div>
    </header>

    <main>
        <section>
            <?php
            if (isset($_SESSION['uname'])) {
                echo "<p>Has iniciado sesión como: " . $_SESSION['uname'] . "</p>";
                echo "<p><a href='logout.php'>Cerrar Sesión</a></p>";
            } else { ?>


            <form action="Pro_Registro.php" onsubmit="submitForm(event)" method="post" id="formulario">

                    <div class="container">
                        <label for="nombre"><b>Nombre</b></label>
                        <input type="text" placeholder="Escribe el nombre" name="nombre" required>

                        <label for="apellido"><b>Apellidos</b></label>
                        <input type="text" placeholder="Escribe los apellidos" name="apellido" required>

                        <label for="edad"><b>Edad</b></label>
                        <input type="number" placeholder="Edad" name="edad" min="2" max="100" required>

                        <label for="usuario"><b>Usuario</b></label>
                        <input type="text" placeholder="Escribe tu usuario" name="usuario" required>

                        <label for="contraseña"><b>Contraseña</b></label>
                        <input type="password" placeholder="Tu contraseña" name="contrasena" required>

                        <button type="submit">Registrarse</button>
                    </div>

                    <div class="container">
                        <button type="reset" class="cancelbtn">Limpiar Formulario</button>
                        <span class="pswd"> <a class="link_web" href="Login.php">¿Ya tienes una cuenta? Inicia
                                sesión</a></span>
                    </div>

                    <div id="successMessage" style="display:none;" class="success-popup">
                        ¡Registro exitoso!
                    </div>

                    <div id="errorMessage" class="error-popup">
                        El nombre de Usuario ya existe 
                    </div>
                    
                </form>
            <?php } ?>
        </section>
    </main>

    <script>
        function submitForm(event) {
            event.preventDefault();

            var form = document.getElementById("formulario");
            var formData = new FormData(form);

            fetch("Pro_Registro.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    var successMessage = document.getElementById("successMessage");
                    var errorMessage = document.getElementById("errorMessage");

                    if (data.success) {
                        // Mostrar mensaje de éxito
                        successMessage.style.display = "block";
                        setTimeout(function () {
                            successMessage.style.display = "none";
                        }, 3000);
                    } else {
                        // Mostrar mensaje de error
                        errorMessage.textContent = data.error; // Establecer el texto del mensaje de error
                        errorMessage.style.display = "block";
                        setTimeout(function () {
                            errorMessage.style.display = "none";
                        }, 3000);
                    }
                });
        }
    </script>
</body>

</html>
