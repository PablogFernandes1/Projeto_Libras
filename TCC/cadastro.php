<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar se os campos não estão vazios
    if (empty($nome) || empty($email) || empty($password)) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.location.href='cadastro.php';</script>";
        exit;
    }

    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root"; // Substitua pelo seu usuário do MySQL
    $password_db = ""; // Substitua pela sua senha do MySQL, se houver
    $dbname = "tcc_ana"; // Nome do seu banco de dados

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        echo "<script>alert('Conexão falhou: " . $conn->connect_error . "'); window.location.href='cadastro.php';</script>";
        exit;
    }

    // Preparar e vincular
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    if ($stmt === false) {
        echo "<script>alert('Erro na preparação da declaração: " . $conn->error . "'); window.location.href='cadastro.php';</script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bind_param("sss", $nome, $email, $hashed_password);

    // Executar a declaração
    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Novo registro criado com sucesso'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "'); window.location.href='cadastro.php';</script>";
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="cadastro-page">
    <a href="index.html" class="back-button">← Voltar para o início</a>
    <div class="container">
        <div class="register-form">
            <h2 id="text-register">Cadastro</h2>
            <form action="cadastro.php" method="POST" id="register-text">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit" id="button-register">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>
