<?php
session_start();
require 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Usuário não logado";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$score = isset($_POST['score']) ? intval($_POST['score']) : 0;
$aula = isset($_POST['aula']) ? $_POST['aula'] : 'alfabeto'; // Nome da aula, como 'alfabeto' ou 'numeros'

try {
    $sql = "INSERT INTO resposta_alfabeto (usuario_id, resposta_correta, data_resposta, aula) VALUES (:usuario_id, :score, NOW(), :aula)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':score', $score);
    $stmt->bindParam(':aula', $aula); // Inserindo o nome da aula
    $stmt->execute();

    echo "Resultado salvo com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao salvar o resultado: " . $e->getMessage();
}
?>