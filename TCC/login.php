<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        echo "Login realizado com sucesso!";
        // Aqui você pode iniciar a sessão e redirecionar o usuário para outra página
    } else {
        echo "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <a href="index.html" class="back-button">← Voltar para o início</a>
    <div class="container">
        <div class="login-form">
            <h2 id="text-login">Login</h2>
            <form method="post" id="login-text">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <br>
                <button type="submit" id="button-login">Entrar</button>
            </form>
            <p>
                É sua primeira vez no nosso site? 
                <a href="cadastro.html">Faça seu cadastro!</a>
            </p>
        </div>
    </div>
</body>
</html>
