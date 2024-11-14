<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repuestos para Tractores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Rodamientos Integral</h1>
        <h3>Repuestos para Tractores</h3>
        <nav class="color">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="autos.php">Repuestos para Autos</a></li>
                <li><a href="acoplados.php">Acoplados</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <div class="flex-containertractor">
                <?php
                $host = "127.0.0.1";
                $user = "root";
                $password = "";
                $dbname = "catalogo";

                $conn = new mysqli($host, $user, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM productos WHERE categoria='tractores'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='catalog-itemtractor'>";
                        echo "<img src='" . $row['imagen'] . "' alt='Repuesto Tractor'>";
                        echo "<h4>" . $row['nombre'] . "</h4>";
                        echo "<p>" . $row['descripcion'] . "</p>";
                        echo "<p>Precio: $" . $row['precio'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "No se encontraron productos.";
                }

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
