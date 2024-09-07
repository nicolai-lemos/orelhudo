<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("https://www.embraplan.com.br/imagens/noticias/11b986fc-d5a6-49a8-ba84-7cbbe8b6f93e.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
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

        /* Formulário */
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 45px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 80px auto 0;
            position: relative;
        }

        .form-container h2 {
            margin-top: 0;
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #04AA6D;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-left: 65px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #039f5b;
        }

        input[type="reset"] {
            background-color: #f44336;
        }

        input[type="reset"]:hover {
            background-color: #e53935;
        }

        /* Estilos adicionais */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .modal i {
            font-size: 50px;
            color: #04AA6D;
            margin-bottom: 15px;
        }

        .modal p {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        .modal button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #04AA6D;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .modal button:hover {
            background-color: #039f5b;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">
        <img src="https://w7.pngwing.com/pngs/81/859/png-transparent-tech-gym-la-plaine-tech-gym-repentigny-sport-tech-gym-terrebonne-saint-jerome-gymnastics-text-sport-logo.png" alt="Logo Empresa">
    </div>
    <div class="categories">
        <a href="cliente_cad.php" class="active">Cadastrados</a>
    </div>
</div>

<!-- Formulário -->
<div class="form-container">
    <h2>Cadastro de Cliente</h2>
    <form id="cliente-form">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" minlength="3" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" maxlength="15" placeholder="(00) 00000-0000" required>

        <input type="submit" value="Cadastrar">
        <input type="reset" value="Limpar">
    </form>
</div>

<!-- Modal de Sucesso -->
<div class="modal" id="success-modal">
    <i class="fa fa-check-circle"></i>
    <p>Cliente cadastrado com sucesso!</p>
    <button onclick="fecharNotificacao()">Fechar</button>
</div>

<script>
    document.getElementById('cliente-form').addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio normal do formulário

        // Valida o formulário manualmente
        var nome = document.getElementById('nome').value;
        var cpf = document.getElementById('cpf').value;
        var telefone = document.getElementById('telefone').value;

        if (nome.length < 3 || !/^[A-Za-zÀ-ÖØ-ÿ\s]+$/.test(nome)) {
            alert('O nome deve ter pelo menos 3 letras e conter apenas letras.');
            return;
        }

        if (!/^(\d{3}\.\d{3}\.\d{3}-\d{2})$/.test(cpf)) {
            alert('O CPF deve estar no formato 000.000.000-00.');
            return;
        }

        if (!/^\(\d{2}\) \d{5}-\d{4}$/.test(telefone)) {
            alert('O telefone deve estar no formato (00) 00000-0000.');
            return;
        }

        // Cria o objeto FormData com os dados do formulário
        var formData = new FormData(this);

        // Envia o formulário via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'inserir_dados.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Exibe a notificação de sucesso
                mostrarNotificacao();
            } else {
                alert('Erro ao cadastrar cliente.');
            }
        };

        xhr.send(formData); // Envia os dados do formulário via AJAX
    });

    function mostrarNotificacao() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'block';
    }

    function fecharNotificacao() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'none';
        location.reload(); // Recarrega a página após fechar o modal
    }

    // Formatação do CPF
    document.getElementById('cpf').addEventListener('input', function (e) {
        let cpf = e.target.value.replace(/\D/g, '');

        if (cpf.length > 9) {
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
        } else if (cpf.length > 6) {
            cpf = cpf.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
        } else if (cpf.length > 3) {
            cpf = cpf.replace(/(\d{3})(\d{0,3})/, '$1.$2');
        }

        e.target.value = cpf;
    });

    // Formatação do Telefone
    document.getElementById('telefone').addEventListener('input', function (e) {
        let telefone = e.target.value.replace(/\D/g, '');

        if (telefone.length > 10) {
            telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (telefone.length > 6) {
            telefone = telefone.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
        } else if (telefone.length > 2) {
            telefone = telefone.replace(/(\d{2})(\d{0,5})/, '($1) $2');
        }

        e.target.value = telefone;
    });

    // Apenas letras e espaços para o campo nome
    document.getElementById('nome').addEventListener('input', function (e) {
        // Remove caracteres que não são letras ou espaços
        e.target.value = e.target.value.replace(/[^A-Za-zÀ-ÖØ-ÿ\s]/g, '');
    });
</script>

</body>
</html>
