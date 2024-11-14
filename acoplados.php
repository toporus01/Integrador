<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repuestos para Acoplados</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Aquí puedes añadir tu CSS personalizado si es necesario */
    </style>


</head>
<body>
    <header>
        <h1>Rodamientos Integral</h1>
        <h3>Repuestos para Acoplados</h3>
        <nav class="color">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="autos.php">Repuestos para Autos</a></li>
                <li><a href="tractores.php">Repuestos para Tractores</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <div class="flex-containeraco">
                <?php
                // Conectar a la base de datos
                $host = "127.0.0.1";
                $user = "root";
                $password = "";
                $dbname = "catalogo";

                // Crear conexión
                $conn = new mysqli($host, $user, $password, $dbname);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta para obtener los productos de la categoría 'acoplados'
                $sql = "SELECT * FROM productos WHERE categoria='acoplados'";
                $result = $conn->query($sql);

                // Mostrar los productos si se encuentran en la base de datos
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='catalog-itemaco'>";
                        echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
                        echo "<h4>" . $row['nombre'] . "</h4>";
                        echo "<p>" . $row['descripcion'] . "</p>";
                        echo "<p>Precio: $" . $row['precio'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No se encontraron productos para acoplados.</p>";
                }

                // Cerrar la conexión a la base de datos
                $conn->close();
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Catálogo de Repuestos. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
