<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gray;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-color: #333;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 60px;
            box-sizing: border-box;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 50px;
        }

        .navbar .categories {
            display: flex;
            align-items: center;
        }

        .navbar .categories a {
            color: #f2f2f2;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 17px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            margin-left: 15px;
        }

        .navbar .categories a:hover, .navbar .categories a.active {
            background-color: #f2f2f2;
            color: #333;
        }

        @media screen and (max-width: 600px) {
            .navbar {
                flex-direction: column;
                padding: 10px;
                height: auto;
            }

            .navbar .categories {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }

            .navbar .categories a {
                display: block;
                padding: 10px 20px;
                margin: 0;
            }
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 70px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-bar input {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .actions button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #c62828;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 40%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .modal-header h2 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .close {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: red;
        }

        .modal-body {
            margin-top: 20px;
        }

        .modal-body label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        .modal-body input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .modal-footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .modal-footer .confirm {
            background-color: #4CAF50;
            color: white;
        }

        .modal-footer .cancel {
            background-color: #f44336;
            color: white;
        }

        .modal-footer .confirm:hover {
            background-color: #388e3c;
        }

        .modal-footer .cancel:hover {
            background-color: #c62828;
        }

        /* Estilo para a exibição do ID, Nome e CPF do Cliente no modal */
        .modal-body .client-info {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .client-info p {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .client-info .client-id {
            font-weight: bold;
            color: #4CAF50;
        }

        .client-info .client-name,
        .client-info .client-cpf {
            font-weight: bold;
            color: #333;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="https://w7.pngwing.com/pngs/81/859/png-transparent-tech-gym-la-plaine-tech-gym-repentigny-sport-tech-gym-terrebonne-saint-jerome-gymnastics-text-sport-logo.png" alt="Logo Empresa">
    </div>
    <div class="categories">
        <a href="index.php" class="active">Cadastrar</a>
    </div>
</div>

<div class="container">
    <h2>Lista de Clientes Cadastrados</h2>

    <!-- Barra de pesquisa -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Digite o ID, Nome, CPF ou Telefone para buscar...">
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Data de Cadastro</th> <!-- Nova coluna -->
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabela-clientes">


        <?php
        // Conexão com o banco de dados
        $conexao = mysqli_connect('localhost', 'root', '', 'form_clientes');

        if (!$conexao) {
            die("Falha na conexão: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM academia";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $cpf = preg_replace("/[^0-9]/", "", $row['cpf']);
                if (strlen($cpf) == 11) {
                    $cpf_formatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
                } else {
                    $cpf_formatado = $row['cpf'];
                }

                $data_cadastro = date('d/m/Y', strtotime($row['data_cadastro']));

                echo "<tr id='cliente-{$row['id']}'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $cpf_formatado . "</td>";
                echo "<td>" . $row['telefone'] . "</td>";
                echo "<td>" . $data_cadastro . "</td>"; // Ajuste na data
                echo "<td class='actions'><button class='excluir' data-id='" . $row['id'] . "'>Excluir</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align: center;'>Nenhum cliente cadastrado.</td></tr>";
        }

        mysqli_close($conexao);
        ?>
        </tbody>
    </table>
</div>

<!-- Modal de Login -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Login</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="client-info" id="clientInfo">
                <!-- ID, Nome e CPF do cliente serão inseridos aqui pelo JavaScript -->
                <p class="client-id">ID: <span id="clientId">123</span></p>
                <p class="client-name">Nome: <span id="clientName">Cliente Exemplo</span></p>
                <p class="client-cpf">CPF: <span id="clientCpf">000.000.000-00</span></p>
            </div>
            <label for="username">Usuário:</label>
            <input type="text" id="username" placeholder="Digite seu usuário">
            <label for="password">Senha:</label>
            <input type="password" id="password" placeholder="Digite sua senha">
        </div>
        <div class="modal-footer">
            <button class="confirm" id="loginBtn">Login</button>
            <button class="cancel" id="cancelBtn">Cancelar</button>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Exibir o modal de login quando o botão de excluir for clicado
    $('.excluir').on('click', function() {
        var clienteId = $(this).data('id');
        var clienteNome = $(this).closest('tr').find('td:nth-child(2)').text(); // Captura o nome do cliente da tabela
        var clienteCpf = $(this).closest('tr').find('td:nth-child(3)').text(); // Captura o CPF do cliente da tabela
        
        $('#clientId').text(clienteId);
        $('#clientName').text(clienteNome);
        $('#clientCpf').text(clienteCpf);

        $('#loginModal').show();
        // Armazena o ID do cliente a ser excluído
        $('#loginBtn').data('id', clienteId);
    });

    // Fechar o modal
    $('.close, #cancelBtn').on('click', function() {
        $('#loginModal').hide();
    });

    // Lógica de login
    $('#loginBtn').on('click', function() {
        var username = $('#username').val();
        var password = $('#password').val();
        var clienteId = $(this).data('id');

        // Verificar credenciais (apenas exemplo, não seguro para produção)
        if (username === 'nicolai' && password === '123') {
            $('#loginModal').hide();

            // Faz a requisição Ajax para excluir o cliente
            $.ajax({
                url: 'excluir_cliente.php',
                type: 'POST',
                data: { id: clienteId },
                success: function(response) {
                    if (response === 'success') {
                        // Atualiza a página após a exclusão bem-sucedida
                        location.reload();
                    } else {
                        alert('Erro ao excluir o cliente. Tente novamente.');
                    }
                },
                error: function() {
                    alert('Erro na comunicação com o servidor.');
                }
            });
        } else {
            alert('Usuário ou senha inválidos!');
        }
    });

    // Filtro da tabela
    $('#searchInput').on('keyup', function() {
        var input = $(this).val().toLowerCase();
        $('#tabela-clientes tr').each(function() {
            var id = $(this).find('td:nth-child(1)').text().toLowerCase();
            var nome = $(this).find('td:nth-child(2)').text().toLowerCase();
            var cpf = $(this).find('td:nth-child(3)').text().toLowerCase();
            var telefone = $(this).find('td:nth-child(4)').text().toLowerCase();
            var data_cadastro = $(this).find('td:nth-child(5)').text().toLowerCase();

            if (input.match(/^\d+$/)) { // Se o input contém apenas números
                $(this).toggle(id.indexOf(input) > -1);
            } else {
                $(this).toggle(
                    id.indexOf(input) > -1 ||
                    nome.indexOf(input) > -1 ||
                    cpf.indexOf(input) > -1 ||
                    telefone.indexOf(input) > -1 ||
                    data_cadastro.indexOf(input) > -1
                );
            }
        });
    });
});
</script>

</body>
</html>
