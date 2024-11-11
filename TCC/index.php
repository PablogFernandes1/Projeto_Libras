<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Página Inicial</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #FF7100;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
            padding: 0 20px;
        }

        .container {
            background-color: #fff;
            width: 100%;
            max-width: 1200px;
            min-height: 80vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            border: 5px solid #FF7100;
            overflow: hidden;
            padding-bottom: 60px;
            box-sizing: border-box;
            margin: 20px 0;
        }

        .background-orange {
            background-color: #FF7100;
            padding: 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo img {
            height: 100px;
            margin-left: 25px;
        }

        .login {
            background-color: #fff;
            color: #FF7100;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin-right: 25px;
        }

        .login:hover {
            background-color: #f2f2f2;
        }

        .menu {
            background-color: #FF820E9C;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px 0;
            border-radius: 5px;
            width: 100%;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
        }

        .menu a:hover {
            background-color: #FF7100;
            border-radius: 5px;
        }

        .carousel {
            width: 50%;
            max-height: 400px;
            overflow: hidden;
            border-radius: 10px;
            margin: 30px auto;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-inner img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .carousel-controls {
            text-align: center;
            margin-top: 10px;
        }

        .carousel-controls button {
            background-color: #FF820E9C;
            border: none;
            color: white;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .carousel-controls button:hover {
            background-color: #FF7100;
        }

        h2 {
            color: #FF7100;
            font-size: 28px;
            text-align: center;
            margin-top: 30px;
        }

        p {
            color: #333;
            font-size: 16px;
            text-align: justify;
            line-height: 1.6;
            margin: 20px;
        }

        footer {
            background-color: #FF7100;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="background-orange">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="Logo" class="img-logo">
            </a>
            <?php if (isset($_SESSION['nome_usuario'])): ?>
                <span style="color: #FFF; margin-right: 15px;">Bem-vindo, <?php echo $_SESSION['nome_usuario']; ?>!</span>
                <a href="logout.php" class="login">Logout</a>
            <?php else: ?>
                <a href="login.php" class="login">Login/Cadastro</a>
            <?php endif; ?>
        </div>
        <div class="menu">
            <a href="index.php">Página inicial</a>
            <a href="aulas.php">Aulas</a>
            <a href="dicionario.html">Dicionário</a>
        </div>

        <div class="carousel">
            <div class="carousel-inner" id="carousel-inner">
                <img src="img/qm_somos.jpeg" alt="Imagem 1">
                <img src="img/rec_disp.jpeg" alt="Imagem 2">
                <img src="img/missao.jpeg" alt="Imagem 3">
            </div>
        </div>

        <div class="carousel-controls">
            <button onclick="prevSlide()">Anterior</button>
            <button onclick="nextSlide()">Próximo</button>
        </div>

        <h2>A Importância das Libras</h2>
        <p>Aprender Libras é fundamental para promover a inclusão social das pessoas surdas, facilitando a comunicação e
            permitindo sua plena participação na sociedade em diversos contextos, como na educação, no trabalho e em
            ambientes públicos. Além disso, a proficiência em Libras aumenta a acessibilidade em áreas essenciais, como
            saúde e serviços públicos, permitindo que profissionais prestem um atendimento mais eficaz e inclusivo. A
            linguagem de sinais não só fortalece os laços comunitários, mas também amplia a compreensão cultural e a
            empatia, promovendo uma sociedade mais justa e igualitária.</p>

        <footer>
            © 2024 - Todos os direitos reservados
        </footer>
    </div>

    <script>
        let currentIndex = 0;

        function showSlide(index) {
            const carouselInner = document.getElementById('carousel-inner');
            const totalSlides = carouselInner.children.length;

            if (index >= totalSlides) {
                index = 0;
            } else if (index < 0) {
                index = totalSlides - 1;
            }

            currentIndex = index;
            const offset = -index * 100;
            carouselInner.style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        showSlide(0);
    </script>
</body>

</html>
 