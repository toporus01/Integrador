<?php

// Conectar a la base de datos
include('db.php');

// Establecer el nombre de usuario y la contraseña en texto claro
$username = "admin";
$password_plano = "root";

// Comprobar si el administrador ya existe
$sql_check = "SELECT * FROM admins WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows == 0) {
    // Si el administrador no existe, inserta el nuevo administrador
    $password_cifrada = password_hash($password_plano, PASSWORD_DEFAULT);

    // Insertar el administrador
    $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password_cifrada);

    if ($stmt->execute()) {
        echo "Administrador insertado correctamente.";
    } else {
        echo "Error al insertar el administrador: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "El usuario 'admin' ya existe.";
}

$stmt_check->close();
$conn->close();

?>
