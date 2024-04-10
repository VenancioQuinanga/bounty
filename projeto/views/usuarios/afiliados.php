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
    <section class="father-son-banner">
        <div class="container-lg">
            <div class="mt-5">
                <p class="mt-5">Ganhe dinheiro vendendo<br>
                    produtos na internet
                </p>
                <div class="d-block">
                    <a href="./explorar-infoprodutos">
                        <button class="d-inline-block my-btn-blue me-3">Explorar produtos</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
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
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-1"><strong>O que é um afiliado?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <strong>Um afiliado</strong> é todo aquele que tem a capacidade ou habilidade de divulgar e vender um 
                            determinado produto digitais quer seja via internet, ou ao vivo.
                            Podendo ganhar dinheiro com isso.
                        </div>
                    </div>
                </div>
            <div class="accordion">
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-2"><strong>Quem pode ser um afiliado?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Pode ser um afiliado quem tenha a capacidade ou habilidade de divulgar e vender um 
                            determinado produto digitais quer seja via internet, ou ao vivo.
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-3" ><strong>A que produtos posso me afiliar?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                        <strong>Os tipos de produtos á que podes te afiliar são:</strong> cursos-em-video e livros ou e-books.
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
