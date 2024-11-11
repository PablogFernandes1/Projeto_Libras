<?php
session_start();
require 'config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    echo "<script>
            alert('Cadastre-se ou se logue para acessar as aulas');
            window.location.href = 'login.php';
          </script>";
    exit;
}

// ID do usuário logado
$usuario_id = $_SESSION['usuario_id'];

// Consulta para verificar se o usuário completou o quiz do Alfabeto
$sql = "SELECT * FROM resposta_alfabeto WHERE usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$resposta_alfabeto = $stmt->fetch(PDO::FETCH_ASSOC);

// Define a classe da cor do círculo com base na resposta
$classe_circulo_alfabeto = $resposta_alfabeto ? 'circle-completed' : 'circle';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilo da página */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .outer-container {
            background-color: #FF7100;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            flex-direction: column;
        }

        .menu {
            background-color: #FF7100;
            width: 100%;
            padding: 10px 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            box-sizing: border-box;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
        }

        .menu a:hover {
            background-color: #FF820E;
            border-radius: 5px;
        }

        .logo {
            position: absolute;
            top: 10px;
            right: 20px;
            width: 50px;
            height: 50px;
        }

        .inner-container {
            background-color: #fff;
            width: 70%;
            height: calc(100% - 60px); /* Altura total menos o menu */
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
            margin-top: 60px;
        }

        .circle-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .circle-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .circle {
            width: 100px;
            height: 100px;
            background-color: #FFA733;
            border-radius: 50%;
        }

        .circle-completed {
            width: 100px;
            height: 100px;
            background-color: #28a745; /* Verde para indicar completado */
            border-radius: 50%;
        }

        .circle-label {
            margin-top: 5px;
            font-size: 14px;
            color: #333;
        }

        .circle-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="outer-container">
        <!-- Menu de navegação com a logo no topo -->
        <div class="menu">
            <a href="index.php">Página inicial</a>
            <a href="aulas.php">Aulas</a>
            <a href="dicionario.html">Dicionário</a>
            <img src="img/logo.png" alt="Logo" class="logo">
        </div>

        <!-- Conteúdo principal das aulas -->
        <div class="inner-container">
            <!-- Coluna esquerda -->
    <div class="circle-container">
        <div class="circle-wrapper">
            <a href="Alfabeto.html" class="circle-link">
                <div class="<?= $classe_circulo_alfabeto ?>"></div>
            </a>
            <div class="circle-label">Alfabeto</div>
        </div>
        <div class="circle-wrapper">
            <div class="circle"></div>
            <div class="circle-label">Emoções</div>
        </div>
        <div class="circle-wrapper">
            <div class="circle"></div>
            <div class="circle-label">Cores</div>
        </div>
    </div>

    <!-- Coluna direita -->
    <div class="circle-container">
        <div class="circle-wrapper">
            <div class="circle"></div>
            <div class="circle-label">Números</div>
        </div>
        <div class="circle-wrapper">
            <div class="circle"></div>
            <div class="circle-label">Cômodos</div>
        </div>
        <div class="circle-wrapper">
            <div class="circle"></div>
            <div class="circle-label">Reflexões</div>
        </div>
    </div>
</div>

        </div>
    </div>
</body>
</html>
