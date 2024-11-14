<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos
include('db.php');

// Actualizar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    // Actualizar imagen si se ha subido una nueva
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($imagen);

        // Mover el archivo subido al directorio de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            $sql = "UPDATE productos SET nombre = ?, precio = ?, descripcion = ?, imagen = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $nombre, $precio, $descripcion, $target_file, $id);
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    } else {
        // Si no hay nueva imagen, actualizar solo los otros campos
        $sql = "UPDATE productos SET nombre = ?, precio = ?, descripcion = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $precio, $descripcion, $id);
    }

    if ($stmt->execute()) {
        echo "Producto actualizado correctamente.";
    } else {
        echo "Error al actualizar el producto.";
    }

    $stmt->close();
}

// Eliminar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Producto eliminado correctamente.";
        header("Location: products_list.php"); // Redirige a la lista de productos
        exit();
    } else {
        echo "Error al eliminar el producto.";
    }

    $stmt->close();
}

// Obtener datos del producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID de producto no especificado.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #4a90e2;
            text-align: center;
        }


        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }


        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            opacity: 0.9;
        }

        /* Botones */
        .update-btn {
            background-color: #4a90e2;
            color: #fff;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: #fff;
        }

        /* Estilo para la imagen actual */
        .image-preview {
            margin-top: 10px;
            text-align: center;
        }

        .image-preview img {
            max-width: 100px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Producto</h2>
        <form method="POST" action="edit_product.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

            <label for="precio">Precio:</label>
            <input type="text" name="precio" value="<?php echo $producto['precio']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>


            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen">
            <?php if (!empty($producto['imagen'])): ?>
                <div class="image-preview">
                    <p>Imagen actual:</p>
                    <img src="<?php echo $producto['imagen']; ?>" alt="Imagen del producto">
                </div>
            <?php endif; ?>


            <input type="submit" name="update" value="Actualizar Producto" class="update-btn">

        </form>
    </div>
</body>
</html>


<?php
$conn->close();
?>

