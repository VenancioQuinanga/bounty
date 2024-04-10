<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./public/css/navbar7.css">
    <link rel="stylesheet" href="./public/css/info-products1.css">
    <link rel="stylesheet" href="./public/css/footer2.css">
    <link rel="stylesheet" href="./public/css/utils4.css">
    <title>Bounty - <?=$titulo?></title>
</head>
<body>
<?php
include_once __DIR__."/../componentes/navbar.php";
?>
<div class="pt-5">
    <section class="course-banner">
        <div class="container-lg">
            <div class="mt-5">
                <div class="col-md-7 mb-5 m-auto" >
                    <?php if (!empty($_SESSION['mensagem'])) {
                        echo $_SESSION['mensagem'];
                        $_SESSION['mensagem'] = '';
                    }?>
                </div>
                <p class="mt-5">Valorize seus Conhecimentos e habilidades</p>
                <div class="d-block">
                    <a href="./usuarios/registro">
                        <button class="d-inline-block my-btn-blue me-3">Torne-se um produtor</button>
                    </a>
                </div>
            </div>
        </div>
</section>
</div>
<div style="background-color:blue;" class="text-light pt-5 pb-5 ">
    <div class="container pt-5 pb-5 center">
        <div class="row">
            <div class="col-md-6">
            <img src="./public/img/icones/2000887.png"  height="180" class="my-icon bg-light d-block mt-2 mb-2 ps-3 pe-3 pt-3 pb-3">
                <span class="numbers">Cursos</span>
                <p>Voce tem aptidões ou capacidades de fazer alguma coisa, então ganhe dinheiro criando cursos aqui, usando os seus conhecimentos e capacidades</p>
            </div>
            <div class="col-md-6">
            <img src="./public/img/icones/1164620.png" height="180" class="my-icon bg-light d-block mt-2 mb-2 ps-3 pe-3 pt-4 pb-4">
                <span class="numbers">Livros</span>
                <p>Explore as suas capacidades e competencias, compartilhe o seus conhecimentos por meio de criação
                    livros e faça algum dinheiro
                </p>
            </div>
            <div class="pt-5">
                <p class="text-light font-weight-bold">Colabore conosco</p>
                <a href="./criar-infoproduto">
                    <button class="d-inline-block my-btn-black me-3 mt-2">Criar um infoproduto</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="bg-dark">
    <div class="row">
        <div class="col-md-6  ps-5">
            <div class="pt-5">
                <h1 class="text-primary display-3 mb-3"><strong>FAQ</strong>:</h1>
                <p class="text-light lead mb-4">Tire suas dúvidas e participe</p>
            </div>
            <div class="accordion">
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-1"><strong>O que é um produtor?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <strong>Um produtor</strong> é aquele que tem conhecimentos ou habilidades sobre um determinado assunto, e 
                            pode compartilhar-lhos com outras pessoas produzindo cursos e livros;
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-2" ><strong>Quem pode ser um produtor?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Todo aquele que tenha conhecimentos ou habilidades em fazer uma certa coisa ou especialidade 
                            num dado assunto, e que possa explicar sobre isso.
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-3"><strong>Que tipo de produtos posso produzir?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                        <strong>Os tipos de produto que podes produzir são:</strong> cursos-em-video e livros ou e-books.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once __DIR__."/../componentes/footer.php";
?>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
