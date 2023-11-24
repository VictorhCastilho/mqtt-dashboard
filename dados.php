<?php
$connection = new PDO("mysql:host=localhost;dbname=teste", "root", "123321@");

$query = $connection->query("SELECT alcool FROM dados ORDER BY id DESC LIMIT 1");
$dados = $query->fetch(PDO::FETCH_ASSOC);

echo json_encode($dados);
?>