<?php
$servername = "localhost";
$username = "root"; // Seu usuário do MySQL
$password = ""; // Sua senha do MySQL (deixe vazio se não tiver)
$dbname = "form_clientes"; // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
