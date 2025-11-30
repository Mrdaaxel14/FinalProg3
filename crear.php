<?php
if ($_POST) {
    $data = [
        "nombre" => $_POST["nombre"],
        "descripcion" => $_POST["descripcion"],
        "categoria" => $_POST["categoria"],
        "precio" => floatval($_POST["precio"]),
        "stock" => intval($_POST["stock"])
    ];

    fetch_api("POST", $data);
    header("Location: index.php");
}

function fetch_api($method, $body = null)
{
    $opts = [
        "http" => [
            "method" => $method,
            "header" => "Content-Type: application/json",
            "content" => json_encode($body)
        ]
    ];
    return file_get_contents("http://localhost/finalprog3/api.php", false, stream_context_create($opts));
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>Nuevo Producto</h1>

    <form method="post">
        <input name="nombre" placeholder="Nombre" required>
        <input name="descripcion" placeholder="Descripción">
        <input name="categoria" placeholder="Categoría">
        <input name="precio" placeholder="Precio" type="number" step="0.01">
        <input name="stock" placeholder="Stock" type="number">
        <button>Guardar</button>
    </form>

</body>

</html>