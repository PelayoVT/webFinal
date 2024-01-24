<!DOCTYPE html>
<?php
session_start();
?>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Iniciar Sesión</title>
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./CSS/LogReg_Style.css">
</head>

<body>
  <header>
    <div id="head_title">
      <h1>¡Inicia tu Sesión!</h1>
    </div>
  </header>

  <main>
    <section>
      <?php
      if (isset($_SESSION['uname'])) {
        echo "<p>Bienvenido, " . $_SESSION['uname'] . ".</p>";
      } else { ?>
        <form action="Procesar_Login.php" method="post">

          <div class="container">
            <label for="usuario"><b>Usuario</b></label>
            <input type="text" placeholder="Introduce tu usuario" name="uname" required>

            <label for="contraseña"><b>Contraseña</b></label>
            <input type="password" placeholder="Introduce tu contraseña" name="pswd" required>

            <button type="submit">Iniciar Sesión</button>
            <label>
              <input type="checkbox" checked="checked" name="remember"> Recordar contraseña
            </label>
          </div>

          <div class="container">
            <button type="reset" class="cancelbtn">Limpiar Formulario</button>
            <span class="pswd"> <a class="link_web" href="registro.php">¿No estás registrado ?</a></span>
          </div>
        </form>
      <?php } ?>
    </section>
  </main>
</body>

</html>
