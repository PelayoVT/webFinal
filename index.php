<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>ConectandoAlMundo</title>
    <link rel="stylesheet" type="text/css" href="./CSS/estilo.css">
    <script src="javascript.js"></script>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Obtener elementos del DOM
        var barraProgreso = document.getElementById("barra-progreso");
        var cantidadDonadaSpan = document.getElementById("cantidad-donada");

        // Función para actualizar la barra de progreso
        function actualizarBarraProgreso() {
            // Hacer una solicitud AJAX al servidor
            fetch("obtener_total_donado.php")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Respuesta no exitosa desde el servidor");
                    }
                    return response.json();
                })
                .then(data => {
                    // Actualizar la barra de progreso y la cantidad donada
                    var cantidadDonada = data.cantidad_donada;
                    var spanID = document.getElementById("total_donado");
                    var porcentaje = (cantidadDonada / 1000000) * 100; // Suponiendo que 1,000 es el máximo
                    barraProgreso.value = porcentaje;
                    cantidadDonadaSpan.textContent = cantidadDonada.toFixed(2); // Ajusta el formato según sea necesario
                    spanID.textContent = cantidadDonada.toFixed(2);
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }

        // Llamar a la función para actualizar la barra de progreso
        actualizarBarraProgreso();

        // Actualizar la barra de progreso cada X milisegundos (ajusta según sea necesario)
        setInterval(actualizarBarraProgreso, 5000); // Actualiza cada 5 segundos, por ejemplo
    });
</script>

<script>
    function redirect(filename) {
        window.location.href = filename;
    }
</script>

<body>
    <header class="indice">
        <div>
            <h1>ConectandoAlMundo</h1>
            <nav class="indice">
                <ul>
                    <li><button onclick="redirect('Login.php');">Login</button></li>
                    <li><button onclick="redirect('registro.php');">Register</button></li>
                    <li><button onclick="redirect('Logout.php');">Logout</button></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="portada" id="inicio">
        <div class="portada-bg"></div>
        <h2>¡Reduciendo la Brecha Digital!</h2>
        <div class="enlaces">
            <a href="#información" class="enlace">Información</a>
            <a href="#" onclick="redirect('donaciones.php');" class="enlace">Donar</a>
        </div>
    </div>
    <main>
        <h3 id="información">Información</h3>
        <div class="informacion">
            <div class="div1">
                <div class="imagen1"></div>
                <p>¿Quienes somos?</p>
            </div>
            <div class="div2">
                <p class="titulo">ConectandoAlMundo</p>
                <br>
                <p class="descripcion">Bienvenido a ConectandoAlMundo, tu plataforma de crowdfunding con una misión más allá de las fronteras digitales. Nos apasiona la idea de construir un futuro inclusivo, donde cada individuo, sin importar su ubicación geográfica, tenga acceso a las oportunidades que ofrece la era digital.</p>
                <p class="descripcion">En nuestro compromiso por reducir la brecha digital en países menos favorecidos, canalizamos los fondos recaudados hacia proyectos innovadores y sostenibles. Creemos que la tecnología puede ser una poderosa herramienta para la educación, el desarrollo económico y la equidad social.</p>
                <p class="descripcion">El dinero que recaudamos se destina a proporcionar acceso a recursos digitales esenciales, como equipos informáticos, conectividad a internet y programas educativos especializados. Creemos que al brindar estas herramientas, capacitamos a las comunidades para enfrentar los desafíos del mundo moderno y fomentamos el crecimiento sostenible.</p>
                <p class="descripcion">Gracias por ser parte de la misión de ConectandoAlMundo.</p>
            </div>
        </div>

        <h3 id="video">Donaciones</h3>
        <div div class="video">
            <div id="barra-progreso-container">
                <p class="descripcion">En "ConectandoAlMundo", nuestro ambicioso objetivo es recaudar un total de un millón de euros para reducir la brecha digital en comunidades menos desarrolladas. Creemos en el poder transformador de la conectividad y la tecnología para mejorar las vidas de quienes más lo necesitan.</p>
                <p class="descripcion">Cada donación, por pequeña que sea, nos acerca un paso más a nuestro objetivo. ¡Únete a nosotros en nuestra misión de reducir la brecha digital!</p>
                <p class="descripcion">Queremos mantenerte informado sobre nuestro progreso hacia la meta de un millón de euros. Por lo que este barómetro visual se actualiza en tiempo real acorde al porcentaje cumplido para llegar al millón</p>
                <label>Total Donado:</label>
                <br>
                <progress id="barra-progreso" max="100" value="0"></progress>
            </div>
        </div>
    </main>

    <br>

    <footer>
        Muchas gracias por tu atención, si te ha gustado la página web considera donar a la causa.
        <a href="#" onclick="redirect('donaciones.php');">ConectandoAlMundo</a>
    </footer>
</body>

</html>
