<?php
session_start();
require 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Usuário não logado";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$score = isset($_POST['score']) ? intval($_POST['score']) : 0;

try {
    // Insere a pontuação no banco de dados
    $sql = "INSERT INTO resposta_alfabeto (usuario_id, resposta_correta, data_resposta) VALUES (:usuario_id, :score, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':score', $score);
    $stmt->execute();

    echo "Resultado salvo com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao salvar o resultado: " . $e->getMessage();
}
?>
