<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar se os campos não estão vazios
    if (empty($nome) || empty($email) || empty($password)) {
        $message = "<div class='alert alert-danger'>Por favor, preencha todos os campos.</div>";
    } else {
        // Conectar ao banco de dados
        $servername = "localhost";
        $username = "root"; // Substitua pelo seu usuário do MySQL
        $password_db = ""; // Substitua pela sua senha do MySQL, se houver
        $dbname = "tcc_ana"; // Nome do seu banco de dados

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Verificar conexão
        if ($conn->connect_error) {
            $message = "<div class='alert alert-danger'>Conexão falhou: " . $conn->connect_error . "</div>";
        } else {
            // Preparar e vincular
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            if ($stmt === false) {
                $message = "<div class='alert alert-danger'>Erro na preparação da declaração: " . $conn->error . "</div>";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param("sss", $nome, $email, $hashed_password);

                // Executar a declaração
                if ($stmt->execute() === TRUE) {
                    // Exibir mensagem de sucesso com redirecionamento
                    $message = "<div class='alert alert-success'>Novo registro criado com sucesso! Redirecionando para o login...</div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'login.php';
                            }, 3000); // Redireciona após 3 segundos
                          </script>";
                } else {
                    $message = "<div class='alert alert-danger'>Erro: " . $stmt->error . "</div>";
                }
                $stmt->close();
            }
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .container {
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #FF7100;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #FF7100;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #FF7100;
            color: white;
        }
        .btn:hover {
            background-color: #FF820E;
        }
        .back-button {
            background-color: #FF7100;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-button:hover {
            background-color: #FF820E;
        }
    </style>
</head>
<body>
    <a href="index.php" class="back-button">← Voltar para o início</a>
    <div class="container">
        <h2>Cadastro</h2>
        <?php if (!empty($message)) echo $message; ?>
        <form action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome"><strong>Nome:</strong></label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="form-group">
                <label for="password"><strong>Senha:</strong></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-block">Cadastrar</button>
        </form>
    </div>
</body>
</html>
