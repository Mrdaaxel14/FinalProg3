<?php
$id = $_GET["id"];

$opts = ["http" => ["method" => "DELETE"]];
file_get_contents("http://localhost/finalprog3/api.php?id=$id", false, stream_context_create($opts));

header("Location: index.php");
