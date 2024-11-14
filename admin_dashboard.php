<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "No has iniciado sesión como administrador.";
    exit;
} else {
    echo "Bienvenido, " . $_SESSION['admin'] . " al panel de administración.";
}

// Conectar a la base de datos
include('db.php');

// Procesar la inserción de un nuevo producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $imagen = $_FILES['imagen']; // Obtener la imagen subida por el usuario

    // Validar datos
    if (!empty($nombre) && !empty($precio) && !empty($descripcion) && !empty($categoria) && !empty($imagen)) {

        // Manejo de la imagen
        $image_name = $imagen['name'];
        $image_tmp_name = $imagen['tmp_name'];
        $image_size = $imagen['size'];
        $image_error = $imagen['error'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Asegurarse de que la extensión sea válida
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($image_ext), $allowed_extensions)) {
            if ($image_error === 0) {
                $image_new_name = uniqid('', true) . '.' . $image_ext;
                $image_upload_dir = 'uploads/';
                $image_upload_path = $image_upload_dir . $image_new_name;

                // Mover la imagen a la carpeta de destino
                if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
                    // Insertar producto en la base de datos
                    $sql = "INSERT INTO productos (nombre, precio, descripcion, imagen, categoria) 
                            VALUES ('$nombre', '$precio', '$descripcion', '$image_upload_path', '$categoria')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p class='success'>Producto agregado correctamente.</p>";
                    } else {
                        echo "<p class='error'>Error al agregar el producto: " . $conn->error . "</p>";
                    }
                } else {
                    echo "<p class='error'>Hubo un error al mover el archivo de imagen.</p>";
                }
            } else {
                echo "<p class='error'>Hubo un error al subir la imagen.</p>";
            }
        } else {
            echo "<p class='error'>Extensión de imagen no permitida. Solo se permiten imágenes JPG, PNG y GIF.</p>";
        }
    } else {
        echo "<p class='error'>Por favor, complete todos los campos.</p>";
    }
}

// Obtener todos los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Administrador</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos para la tabla de productos */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        /* Estilos para las imágenes */
        .product-img {
            width: 150px;
            height: auto;
            border-radius: 8px;
        }
        /* Botones de acción */
        .action-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .action-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h2>Bienvenido al Panel de Control, Admin</h2>
            <a href="admin_lagout.php" class="logout-btn">Cerrar sesión</a>
        </header>

        <section class="add-product-section">
            <h3>Agregar Producto</h3>
            <form method="POST" action="admin_dashboard.php" enctype="multipart/form-data">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" name="nombre" required><br><br>

                <label for="precio">Precio:</label>
                <input type="number" name="precio" required><br><br>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" required></textarea><br><br>

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" accept="image/*" required><br><br>

                <label for="categoria">Categoría:</label>
                <select name="categoria" required>
                    <option value="autos">Autos</option>
                    <option value="tractores">Tractores</option>
                    <option value="acoplados">Acoplados</option>
                </select><br><br>

                <input type="submit" name="add_product" value="Agregar Producto" class="submit-btn">
            </form>
        </section>

        <section class="product-list-section">
            <h3>Productos</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['precio']); ?></td>
                            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen del producto" class="product-img"></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="action-btn">Editar</a>
                                <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="action-btn delete-btn">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>

<?php
$conn->close();
?>
