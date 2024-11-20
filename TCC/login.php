<?php
session_start();
require 'config.php';

$mensagem_sucesso = "";

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
        $mensagem_sucesso = "Login realizado com sucesso!";
        header("Refresh: 3; url=index.php"); // Redireciona após 3 segundos
    } else {
        $mensagem_sucesso = "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
    background-color: #FF7100;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Arial, sans-serif;
    color: #333;    
}

.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 100%;
    max-width: 400px; /* Ajuste para largura máxima */
}
        .btn-custom {
            background-color: #FF7100;
            color: white;
        }
        .btn-custom:hover {
            background-color: #FF820E;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($mensagem_sucesso)): ?>
            <div class="alert <?= strpos($mensagem_sucesso, 'sucesso') !== false ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show" role="alert">
                <strong><?= $mensagem_sucesso; ?></strong>
                <?php if (strpos($mensagem_sucesso, 'sucesso') !== false): ?>
                    <p>Você será redirecionado para a página inicial.</p>
                <?php endif; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="password" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-custom">Entrar</button>
        </form>
        <p class="mt-3">É sua primeira vez no nosso site? <a href="cadastro.php">Faça seu cadastro!</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
