<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    $cn = new mysqli("localhost", "root", "", "stocklite");

    if ($cn->connect_error) {
        die("Error de conexión: " . $cn->connect_error);
    }

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id <= 0) {
        die('ID no válido');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $categoria = $_POST['categoria'] ?? '';
        $precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0.0;
        $stock = isset($_POST['stock']) ? (int) $_POST['stock'] : 0;

        $stmt = $cn->prepare(
            "UPDATE productos SET nombre = ?, descripcion = ?, categoria = ?, precio = ?, stock = ? WHERE id = ?"
        );

        if (!$stmt) {
            die("Prepare falló: " . $cn->error);
        }

        $stmt->bind_param("sssdii", $nombre, $descripcion, $categoria, $precio, $stock, $id);
        $stmt->execute();

        if ($stmt->error) {
            die("Execute falló: " . $stmt->error);
        }

        $stmt->close();
        $cn->close();

        header('Location: index.php');
        exit;
    }

    $stmt = $cn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    if (!$producto) {
        die('Producto no encontrado');
    }
    ?>

    <h1>Editar Producto</h1>
    <form method="POST">
        Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required><br>
        Descripción: <input type="text" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>" required><br>
        Categoría: <input type="text" name="categoria" value="<?= htmlspecialchars($producto['categoria']) ?>" required><br>
        Precio: <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required><br>
        Stock: <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>

</html>