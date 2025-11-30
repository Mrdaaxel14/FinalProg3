<?php
header("Content-Type: application/json");
$cn = new mysqli("localhost", "root", "", "stocklite");

$method = $_SERVER["REQUEST_METHOD"];

// Leer body JSON
$input = json_decode(file_get_contents("php://input"), true);

// Obtener ID si viene por URL
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

switch ($method) {

    // --------------------
    // GET (LISTAR)
    // --------------------
    case "GET":
        $result = $cn->query("SELECT * FROM productos");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
        break;

    // --------------------
    // POST (CREAR)
    // --------------------
    case "POST":
        $sql = "INSERT INTO productos (nombre, descripcion, categoria, precio, stock)
                VALUES (
                    '{$input["nombre"]}',
                    '{$input["descripcion"]}',
                    '{$input["categoria"]}',
                    {$input["precio"]},
                    {$input["stock"]}
                )";
        $cn->query($sql);
        echo json_encode(["status" => "ok"]);
        break;

    // --------------------
    // PUT (ACTUALIZAR)
    // --------------------
    case "PUT":
        if ($id > 0) {
            $sql = "UPDATE productos SET
                        nombre = '{$input["nombre"]}',
                        descripcion = '{$input["descripcion"]}',
                        categoria = '{$input["categoria"]}',
                        precio = {$input["precio"]},
                        stock = {$input["stock"]}
                    WHERE id = $id";

            $cn->query($sql);
            echo json_encode(["status" => "ok"]);
        }
        break;

    // --------------------
    // DELETE (ELIMINAR)
    // --------------------
    case "DELETE":
        if ($id > 0) {
            $cn->query("DELETE FROM productos WHERE id = $id");
            echo json_encode(["status" => "ok"]);
        }
        break;
}
