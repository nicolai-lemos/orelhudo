<?php
// Conexão com o banco de dados
$conexao = mysqli_connect('localhost', 'root', '', 'form_clientes');

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $clienteId = $_POST['id'];

    $sqlExcluir = "DELETE FROM academia WHERE id = $clienteId";
    if (mysqli_query($conexao, $sqlExcluir)) {
        $sqlReordenar = "
            SET @contador = 0; 
            UPDATE academia SET id = (@contador := @contador + 1) ORDER BY id;
        ";
        

        if (mysqli_multi_query($conexao, $sqlReordenar)) {
            while (mysqli_more_results($conexao)) {
                mysqli_next_result($conexao);
            }


            $sqlResetAutoIncrement = "
                ALTER TABLE academia AUTO_INCREMENT = 1;
            ";
            mysqli_query($conexao, $sqlResetAutoIncrement);

            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'invalid';
}

mysqli_close($conexao);
?>
