<?php
include('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}
?>
