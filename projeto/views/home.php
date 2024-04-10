<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./public/css/navbar7.css">
    <link rel="stylesheet" href="./public/css/footer2.css">
    <link rel="stylesheet" href="./public/css/utils4.css">
    <title>Bounty - <?=$titulo?></title>
</head>
<body>
    <?php
    include_once __DIR__."/../views/componentes/navbar.php";
    ?>
<div class="pt-3">
    <main class="w-100">
        <div class="col-md-7 mb-5 m-auto" >
            <?php 
            if (!empty($_SESSION['mensagem'])) {
               echo $_SESSION['mensagem'];
               $_SESSION['mensagem'] = '';
            }?>
        </div>
        <div class="container-lg">
            <h1 class="display-4 font-weight-bold">Seja Bem-Vindo ao Bounty</h1>
            <p class="text-light">
                <strong class="text-dark display-6">"Plataforma de infoprodutos"</strong>
                <div class="d-block">
                    <a href="./usuarios/registro">
                        <button class="d-inline-block my-btn-blue me-3">Criar conta</button>
                    </a>
                    <a href="./usuarios/login">
                        <button class="d-inline-block my-btn-black me-3 mt-2">Fazer login</button>
                    </a>
                </div>
            </p>
        </div>
    </main>
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
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-1"><strong>O que é o Bounty?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <strong>O Bounty:</strong> é uma nova plataforma de infoprodutos de Angola com foco em 
                            info-produtos,nomeadamente cursos-em-video,livros ou e-books,etc.
                            Ela tem o objetivo de expandir o ensino digital em Angola
                            e mudar a vida dos cidadãos angolanos.
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
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-4"><strong>Quem pode ser um afiliado?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-4" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Pode ser um afiliado quem tenha a capacidade ou habilidade de divulgar e vender um 
                            determinado produto digitais quer seja via internet, ou ao vivo.
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-5" ><strong>A que produtos posso me afiliar?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-5" class="accordion-collapse collapse">
                        <div class="accordion-body">
                        <strong>Os tipos de produtos á que podes te afiliar são:</strong> cursos-em-video e livros ou e-books.
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-6"><strong>Quanto custa participar do bounty?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-6" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Participar do bunty não custa nada, isso mesmo é de graça.
                        </div>
                    </div>
                </div>
                <div class="accordion-item mb-4">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#item-7"><strong>Como posso contactar o suporte técnico do bounty?</strong></button>
                    <!-- conteúdo -->
                    <div id="item-7" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            podes contactar o suporte tecnico do bounty pelo whatsApp,
                            que se encontra no rodapé do bounty, aqui no fim da pagina.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="produtores-afiliados">
    <section class="course-banner">
        <div class="container-lg">
            <div class="mt-5">
                <p class="mt-5">Valorize seus conhecimentos e habilidades<br>
                    Torne-se um produtor
                </p>
                <div class="d-block">
                    <a href="./produtores">
                        <button class="d-inline-block my-btn-blue me-3">Saiba mais</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="father-son-banner">
        <div class="container-lg">
            <div class="mt-5">
                <p class="mt-5">Ganhe dinheiro vendendo produtos na internet<br>
                    Torne-se um afiliado
                </p>
                <div class="d-block">
                    <a href="./afiliados">
                        <button class="d-inline-block my-btn-blue me-3">Saiba mais</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

    <?php
        include_once __DIR__."/../views/componentes/footer.php";
    ?>
    <script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
