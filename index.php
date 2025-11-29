<!DOCTYPE html>
<html lang="en">
<?php
$cn = new mysqli("localhost", "root", "", "stocklite");
$result = $cn->query("SELECT * FROM productos");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Listado de Productos</h1>
    <a href="crear.php" class="btn-agregar">+ Agregar Producto</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['descripcion'] ?></td>
                <td><?= $row['categoria'] ?></td>
                <td><?= $row['precio'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                    <a href="eliminar.php?id=<?= $row['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>