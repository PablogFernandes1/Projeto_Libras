<?php
session_start();
require 'config.php';

// Inicializa a variável para evitar erro
$mensagem_aviso = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome_usuario'] = $usuario['nome'];
        echo "<script>
                alert('Login realizado com sucesso!');
                window.location.href = 'index.php';
              </script>";
    } else {
        $mensagem_aviso = "Email ou senha incorretos!";
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
    <a href="index.php" class="back-button">← Voltar para o início</a>
    <div class="container">
        <?php if (!empty($mensagem_aviso)): ?>
            <div class="alert alert-warning" role="alert">
                <?= $mensagem_aviso; ?>
            </div>
        <?php endif; ?>
        <div class="login-form">
            <h2 id="text-login">Login</h2>
            <form id="login-text" action="login.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="digite seu email"required>
                <br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="senha" placeholder="digite sua senha" required>
                <br>
                <button type="submit" id="button-login">Entrar</button>
            </form>
            <p>É sua primeira vez no nosso site? <a href="cadastro.php">Faça seu cadastro!</a></p>
        </div>
    </div>
</body>
</html>
