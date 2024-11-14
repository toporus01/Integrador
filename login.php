<?php
session_start();
include('db.php');  // Conectar a la base de datos

// Verificar si el usuario desea iniciar sesión como explorador
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['explorer'])) {
    $_SESSION['explorer'] = true;
    header("Location: index.php"); // Redirige a la página principal o de explorador
    exit();
}

// Procesar el inicio de sesión de administrador
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar si el administrador existe en la base de datos
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe en la base de datos
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin'] = $username; // Guarda el nombre de usuario en la sesión
            header("Location: admin_dashboard.php"); // Redirige al panel de administración
            exit();
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message = "Usuario no encontrado.";
    }

    $stmt->close();
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin / Explorador</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        body, html {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            margin: 0;
            background-color: #f4f6f9;
            overflow: hidden; /* Evita el scroll */
        }

        .login-container {
            background-color: #fff;
            padding: 20px 30px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Asegura que el contenido no sobresalga */
        }

        h2 {
            color: #4a90e2;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-top: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"],
        .explorer-btn {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4a90e2;
            color: #fff;
        }

        input[type="submit"]:hover,
        .explorer-btn:hover {
            background-color: #3a78c2;
        }

        hr {
            margin: 20px 0;
        }

        .error {
            color: #e74c3c;
            margin-top: 10px;
        }

        .logo {
            width: 100%;  /* Hace que la imagen ocupe el ancho disponible */
            max-width: 400px;  /* Limita el tamaño máximo de la imagen */
            height: auto;  /* Mantiene la proporción de la imagen */
            margin-bottom: 30px;  /* Ajusta el espacio entre la imagen y el título */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Agregar la imagen aquí -->
        <img src="imagenes/nuevo.jpeg" alt="Logo" class="logo"> <!-- Reemplaza con la ruta de tu logo -->

        <h2>Iniciar sesión</h2>
        
        <form method="POST" action="login.php">
            <button type="submit" name="explorer" class="explorer-btn">Entrar como explorador</button>
        </form>
        
        <hr>

        <form method="POST" action="login.php">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <input type="submit" name="admin_login" value="Iniciar sesión como admin">
        </form>

        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>



