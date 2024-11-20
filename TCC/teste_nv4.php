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
    <title>Quiz Expressões</title>
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
    <h1 class="text-center mb-4">Quiz Expressões</h1>
    <div id="feedback" class="alert text-center" role="alert" style="display: none;"></div>
    <form id="quizForm" class="p-3">
        <!-- Questão 1 -->
        <section class="question active" id="question1">
            <p>1. Qual é o sinal de "Com licença" em LIBRAS?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="a" class="form-check-input"> Um movimento de cortar o ar com a mão em forma de "L".</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="b" class="form-check-input"> A mão em forma de "A" tocando o queixo.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="c" class="form-check-input"> A palma da mão deslizando levemente para frente, com a outra mão aberta ao lado.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="d" class="form-check-input"> Mão fechada, batendo no peito.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question1" value="e" class="form-check-input"> Movimento de segurar o nariz com o polegar e o indicador.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(1)">Próximo</button>
        </section>

        <!-- Questão 2 -->
        <section class="question" id="question2">
            <p>2. Como sinalizar "Prazer em conhecer" em LIBRAS?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="a" class="form-check-input"> Apontar para si e depois para a outra pessoa.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="b" class="form-check-input"> Fazer um movimento circular no peito com a mão aberta e depois apontar para a outra pessoa.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="c" class="form-check-input"> Fazer o movimento de um aperto de mão no ar.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="d" class="form-check-input"> Tocar as pontas dos dedos da mão direita na testa.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question2" value="e" class="form-check-input"> Fazer o movimento de escrever no ar.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(2)">Próximo</button>
        </section>

        <!-- Questão 3 -->
        <section class="question" id="question3">
            <p>3. Como é o sinal de "Saudade" em LIBRAS?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="a" class="form-check-input"> Passar a mão no coração de forma circular.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="b" class="form-check-input"> Fazer o gesto de chorar com os dedos.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="c" class="form-check-input"> Levar a mão ao queixo e depois ao peito.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="d" class="form-check-input"> Tocar a testa com a mão e depois fechá-la como um soco.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question3" value="e" class="form-check-input"> Apontar para si e fazer o movimento de abraço.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(3)">Próximo</button>
        </section>

        <!-- Questão 4 -->
        <section class="question" id="question4">
            <p>4. Qual é o sinal de "Tchau" em LIBRAS?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="a" class="form-check-input"> Acenar com a palma da mão aberta para frente.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="b" class="form-check-input"> Fazer um "joinha" com a mão.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="c" class="form-check-input"> Cruzar os braços no peito.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="d" class="form-check-input"> Abrir e fechar os dedos rapidamente.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question4" value="e" class="form-check-input"> Desenhar um "X" no ar.</label>
            </div>
            <button type="button" class="btn btn-primary mt-3" onclick="nextQuestion(4)">Próximo</button>
        </section>

        <!-- Questão 5 -->
        <section class="question" id="question5">
            <p>5. Como pedir "Desculpe" em LIBRAS?</p>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="a" class="form-check-input"> Passar a mão fechada sobre a outra palma aberta em movimentos circulares.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="b" class="form-check-input"> Fazer o sinal de "ok" com o polegar e o indicador.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="c" class="form-check-input"> Apontar para o peito com dois dedos.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="d" class="form-check-input"> Sacudir a cabeça e a mão ao mesmo tempo.</label>
            </div>
            <div class="form-check">
                <label class="form-check-label"><input type="radio" name="question5" value="e" class="form-check-input"> Fazer um gesto de lavar as mãos.</label>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="submitQuiz()">Enviar Respostas</button>
        </section>
    </form>
</div>

<script>
    const correctAnswers = {
        question1: "c",
        question2: "b",
        question3: "e",
        question4: "a",
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
        alert(`Você acertou ${score} de 5 questões.`);

        $.ajax({
            url: 'salvar_resposta.php',
            type: 'POST',
            data: { score: score, aula: 'expressoes' },
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
