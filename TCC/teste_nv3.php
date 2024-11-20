<?php
session_start();
require 'config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Cadastre-se ou faça login para acessar o quiz'); window.location.href = 'login.php';</script>";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Comidas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #FF7100;
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            width: 80%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
        }
        h1 {
            color: #FF7100;
            text-align: center;
        }
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
        .btn {
            background-color: #FF7100;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #FF820E;
        }
    </style>
</head>

<body>

<div class="container">
    <h1 class="text-center mb-4">Quiz Comidas</h1>
    <div id="feedback" class="alert text-center" role="alert" style="display: none;"></div>
    <form id="quizForm" class="p-3">
        <!-- Questão 1 -->
        <section class="question active" id="question1">
            <p>1. Como se sinaliza "Arroz" em Libras?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="a" class="form-check-input"> Mãos em "L" imitando o formato de um prato.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="b" class="form-check-input"> Mãos fazendo o sinal de colher pegando algo e levando à boca.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="c" class="form-check-input"> Mão direita fechada, fazendo movimento circular na palma da mão esquerda aberta.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="d" class="form-check-input"> Mão direita aberta, batendo levemente no queixo.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(1)">Próximo</button>
        </section>

        <!-- Questão 2 -->
        <section class="question" id="question2">
            <p>2. Qual o sinal correto para "Feijão" em Libras?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="a" class="form-check-input"> Mão direita em "F", tocando o dorso da mão esquerda.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="b" class="form-check-input"> Mão direita em "F", fazendo movimento circular na palma da mão esquerda.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="c" class="form-check-input"> Mão direita em "F", tocando o queixo.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="d" class="form-check-input"> Mão direita em "F", tocando a testa.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(2)">Próximo</button>
        </section>

        <!-- Questão 3 -->
        <section class="question" id="question3">
            <p>3. Qual é o sinal para "Leite" em Libras?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="a" class="form-check-input"> Mão direita em forma de "L", balançando para cima e para baixo.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="b" class="form-check-input"> Mão direita aberta, fazendo um movimento circular no peito.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="c" class="form-check-input"> Mão direita fechada, fazendo movimento de ordenha.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="d" class="form-check-input"> Mão direita em "L", tocando a testa.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(3)">Próximo</button>
        </section>

        <!-- Questão 4 -->
        <section class="question" id="question4">
            <p>4. Como se sinaliza "Café" em Libras?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="a" class="form-check-input"> Mão direita em forma de "C", girando no ar.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="b" class="form-check-input"> Mão direita em "C", levando à boca.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="c" class="form-check-input"> Mão direita em "C", fazendo movimento circular sobre a mão esquerda.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="d" class="form-check-input"> Mão direita em "C", tocando a testa.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(4)">Próximo</button>
        </section>

        <!-- Questão 5 -->
        <section class="question" id="question5">
            <p>5. Qual é o sinal correto para "batata" em Libras?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="a" class="form-check-input"> A mão dominante em forma de "garra" passa sobre o dorso da mão não-dominante, simbolizando o crescimento da batata na terra.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="b" class="form-check-input"> As duas mãos em forma de "L" tocam a bochecha, como se estivesse apontando para algo redondo.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="c" class="form-check-input"> A mão dominante faz um movimento de pinça (indicador e polegar), simulando o formato de uma batata.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="d" class="form-check-input"> A mão dominante faz um movimento circular em frente ao rosto, como se imitasse algo girando.</label>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="submitQuiz()">Enviar Respostas</button>
        </section>
    </form>
</div>

<script>
    const correctAnswers = {
        question1: "c",
        question2: "b",
        question3: "c",
        question4: "c",
        question5: "a"
    };

    let score = 0;

    function nextQuestion(current) {
        const selectedOption = document.querySelector(`input[name="question${current}"]:checked`);
        const feedback = document.getElementById('feedback');

        if (selectedOption) {
            if (selectedOption.value === correctAnswers[`question${current}`]) {
                score++;
                feedback.className = "alert alert-success";
                feedback.innerHTML = "Resposta Certa!";
            } else {
                feedback.className = "alert alert-danger";
                feedback.innerHTML = "Resposta Errada!";
            }
            feedback.style.display = 'block';

            setTimeout(() => {
                feedback.style.display = 'none';
                document.getElementById(`question${current}`).classList.remove('active');
                if (current < 5) {
                    document.getElementById(`question${current + 1}`).classList.add('active');
                } else {
                    submitQuiz();
                }
            }, 1000);
        } else {
            alert("Por favor, selecione uma resposta.");
        }
    }

    function submitQuiz() {
        alert(`Parabéns! Você acertou ${score} de 5 questões.`);

        $.ajax({
            url: 'salvar_resposta.php',
            type: 'POST',
            data: { score: score, aula: 'comidas' },
            success: function(response) {
                alert(response);
                window.location.href = 'aulas.php';
            },
            error: function() {
                alert("Erro ao salvar o resultado.");
            }
        });
    }
</script>

</body>
</html>