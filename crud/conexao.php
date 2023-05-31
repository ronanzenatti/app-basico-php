<?php
$servername = "localhost"; // substitua pelo nome do servidor do banco de dados
$username = "root"; // substitua pelo nome de usuário do banco de dados
$password = ""; // substitua pela senha do banco de dados
$dbname = "teste_aula"; // substitua pelo nome do banco de dados

// Cria uma conexão segura com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>