<?php
$id = $_GET["id"];

// Obtener producto desde la API
$producto = json_decode(file_get_contents("http://localhost/finalprog3/api.php"), true);

foreach ($producto as $p) {
    if ($p["id"] == $id) {
        $prod = $p;
        break;
    }
}

if ($_POST) {
    $data = [
        "nombre" => $_POST["nombre"],
        "descripcion" => $_POST["descripcion"],
        "categoria" => $_POST["categoria"],
        "precio" => floatval($_POST["precio"]),
        "stock" => intval($_POST["stock"])
    ];

    fetch_api("PUT", $data, $id);
    header("Location: index.php");
}

function fetch_api($method, $body, $id)
{
    $opts = [
        "http" => [
            "method" => $method,
            "header" => "Content-Type: application/json",
            "content" => json_encode($body)
        ]
    ];
    file_get_contents("http://localhost/finalprog3/api.php?id=$id", false, stream_context_create($opts));
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>Editar Producto</h1>

    <form method="post">
        <input name="nombre" value="<?= $prod["nombre"] ?>" required>
        <input name="descripcion" value="<?= $prod["descripcion"] ?>">
        <input name="categoria" value="<?= $prod["categoria"] ?>">
        <input name="precio" type="number" step="0.01" value="<?= $prod["precio"] ?>">
        <input name="stock" type="number" value="<?= $prod["stock"] ?>">
        <button>Actualizar</button>
    </form>

</body>

</html>