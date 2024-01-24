<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Donación</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            background-image: url("./images/brecha.jpg");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .donation-form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        .form-title {
            background-color: #686fd9;
            color: #fff;
            padding: 10px;
            margin: -20px -20px 20px -20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #686fd9 ;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #5860a6;
        }
    </style>
</head>
<body>
    <div class="donation-form-container">
        <h2 class="form-title">¡Haz tu Donación!</h2>
        <form action="Procesar_donaciones.php" method="post">
            <div class="form-group">
                <label for="cantidad_donada">Cantidad a Donar:</label>
                <input type="number" step="0.01" id="cantidad_donada" name="cantidad_donada" required>
            </div>
            <input type="submit" value="Donar">
        </form>
    </div>
</body>
</html>
