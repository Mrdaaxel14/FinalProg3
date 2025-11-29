<?php
header("Content-Type: application/json");
$cn = new mysqli("localhost", "root", "", "stocklite");

switch ($_SERVER["REQUEST_METHOD"]) {

    // LISTAR (GET)
    case "GET":
        $result = $cn->query("SELECT * FROM productos");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    // REGISTRAR (POST)
    case "POST":
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = $cn->prepare("INSERT INTO productos (nombre, descripcion, categoria, precio, stock) VALUES (?,?,?,?,?)");
        $stmt->bind_param(
            "sssid",
            $input["nombre"],
            $input["descripcion"],
            $input["categoria"],
            $input["precio"],
            $input["stock"]
        );
        $stmt->execute();
        echo json_encode(["status" => "ok"]);
        break;
}
