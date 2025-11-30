<?php
// Obtener lista desde la API
$productos = json_decode(file_get_contents("http://localhost/finalprog3/api.php"), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>Listado de Productos</h1>

    <a href="crear.php" class="btn-agregar">Agregar Producto</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= $p["nombre"] ?></td>
                <td>$<?= $p["precio"] ?></td>
                <td><?= $p["stock"] ?></td>

                <td>
                    <a href="editar.php?id=<?= $p["id"] ?>">Editar</a>
                    <a href="eliminar.php?id=<?= $p["id"] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>