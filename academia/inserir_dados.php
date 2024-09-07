<?php
// Inclui o arquivo de conexão
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    // Prepara o comando SQL para inserir os dados
    $sql = "INSERT INTO academia (nome, cpf, telefone) VALUES ('$nome', '$cpf', '$telefone')";

    // Executa o comando SQL
    if ($conn->query($sql) === TRUE) {
        echo "Novo cliente cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
}
?>
