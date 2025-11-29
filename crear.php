<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    if ($_POST) {
        $cn = new mysqli("localhost", "root", "", "stocklite");
        if ($cn->connect_error) {
            die("Error de conexión: " . $cn->connect_error);
        }

        // Cinco placeholders para cinco columnas
        $stmt = $cn->prepare("INSERT INTO productos (nombre, descripcion, categoria, precio, stock) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare falló: " . $cn->error);
        }

        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : 0.0;
        $stock = isset($_POST['stock']) ? (int)$_POST['stock'] : 0;

        // tipos: nombre (s), descripcion (s), categoria (s), precio (d), stock (i)
        $stmt->bind_param("sssdi", $nombre, $descripcion, $categoria, $precio, $stock);
        $stmt->execute();
        if ($stmt->error) {
            die("Execute falló: " . $stmt->error);
        }

        $stmt->close();
        $cn->close();

        header("Location: index.php");
        exit;
    }
    ?>
    <form method="POST">
        Nombre: <input type="text" name="nombre"><br>
        Descripción: <input type="text" name="descripcion"><br>
        Categoría: <input type="text" name="categoria"><br>
        Precio: <input type="number" step="0.01" name="precio"><br>
        Stock: <input type="number" name="stock"><br>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>