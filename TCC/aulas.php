<?php
session_start();
require 'config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Alerta - Login Requerido</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #FF7100;
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .alert-container {
                width: 60%;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class='alert-container'>
            <div class='alert alert-warning' role='alert'>
                <h4 class='alert-heading'>Atenção!</h4>
                <p>Cadastre-se ou faça login para acessar as aulas.</p>
                <hr>
                <p class='mb-0'>Clique no botão abaixo para voltar ao login.</p>
                <a href='login.php' class='btn btn-warning mt-3'>Ir para Login</a>
            </div>
        </div>
    </body>
    </html>";
    exit;
}

// ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Função para verificar se uma aula foi completada
function verificaAulaCompletada($pdo, $usuario_id, $aula_nome) {
    $sql = "SELECT * FROM resposta_alfabeto WHERE usuario_id = :usuario_id AND aula = :aula";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':aula', $aula_nome);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) ? 'circle-completed' : 'circle';
}

// Define a classe da cor do círculo com base na resposta para cada aula
$classe_circulo_alfabeto = verificaAulaCompletada($pdo, $usuario_id, 'alfabeto');
$classe_circulo_numeros = verificaAulaCompletada($pdo, $usuario_id, 'numeros');
$classe_circulo_comidas = verificaAulaCompletada($pdo, $usuario_id, 'comidas');
$classe_circulo_expressoes = verificaAulaCompletada($pdo, $usuario_id, 'expressoes');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FF7100;
            color: #333;
            margin: 0;
        }

        .menu {
            background-color: #FF7100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
        }

        .menu img {
            width: 50px;
            margin-right: 15px;
        }

        .menu a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        .container {
            background-color: #fff;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            text-align: center;
        }

        .circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 10px auto;
            background-color: #FFA733;
        }

        .circle-completed {
            background-color: #28a745;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 10px auto;
        }

        .circle-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }

        .circle-label {
            margin-top: 10px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #FF7100;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="menu">
        <img src="img/logo.png" alt="Logo">
        <a href="index.php">Página Inicial</a>
        <a href="aulas.php">Aulas</a>
        <a href="dicionario.html">Dicionário</a>
    </div>

    <div class="container">
        <h2 class="text-center text-warning">Aulas Interativas</h2>
        <div class="d-flex flex-wrap justify-content-between">
            <div class="circle-wrapper">
                <a href="Alfabeto.html">
                    <div class="<?= $classe_circulo_alfabeto ?>"></div>
                </a>
                <div class="circle-label">Alfabeto</div>
            </div>
            <div class="circle-wrapper">
                <a href="expressoes.html">
                    <div class="<?= $classe_circulo_expressoes ?>"></div>
                </a>
                <div class="circle-label">Expressões</div>
            </div>
            <div class="circle-wrapper">
                <a href="numeros.html">
                    <div class="<?= $classe_circulo_numeros ?>"></div>
                </a>
                <div class="circle-label">Números</div>
            </div>
            <div class="circle-wrapper">
                <a href="comidas.html">
                    <div class="<?= $classe_circulo_comidas ?>"></div>
                </a>
                <div class="circle-label">Comidas</div>
            </div>
        </div>
    </div>

    <div class="footer">
        © 2024 - Projeto Libras. Todos os direitos reservados.
    </div>
</body>

</html>
