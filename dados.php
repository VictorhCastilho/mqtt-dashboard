<?php
$connection = new PDO("mysql:host=localhost;dbname=meu_banco", "root", "123321@");

$query = $connection->query("SELECT h2s, metano, temperatura, vazao FROM dados ORDER BY id DESC LIMIT 1");
$dados = $query->fetch(PDO::FETCH_ASSOC);

echo json_encode($dados);
?>