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
<div id="carrossel-de-imagens" class="carousel slide pt-5" data-bs-ride="carousel">
<?php
        if (!empty($categorias)) {

            echo "
                <!-- traços marcadores --> 
                <div class='carousel-indicators'>
            ";

            $a = 0;
            $s = 1;
            
            foreach ($categorias as $categoria) {
                if ($a < 1) {
                    echo "                    
                        <button type='button' data-bs-target='#carrossel-de-imagens' data-bs-slide-to='$a' aria-label='Slide $s'></button>                
                    ";   
                } else {
                    echo "
                        <button type='button' data-bs-target='#carrossel-de-imagens' data-bs-slide-to='$a' class='active' current='true' aria-label='Slide $s'></button>
                    ";
                }

                $a = (int) $a + 1;
                $s = (int) $s + 1;

            }

            echo "
                    </div>
                <div class='carousel-inner'>
            ";

            
            $a = 0;
            $s = 1;

            foreach ($categorias as $categoria) {
                $id = $categoria['id'];
                $foto = $categoria['src'];
                $categoria = $categoria['categoria'];

                if ($a < 1) {
                    echo "
                        <div class='carousel-item active'>                
                            <img src='$url/public/img/categorias/$foto' class='d-block w-100'>
                            <div class='carousel-caption mb-5 d-md-block'>
                                <h5><strong class='text-dark'>$categoria</strong></h5>
                                <div class='d-block'>
                                    <a href='./ver-categoria?id=$id'>
                                        <button class='d-inline-block my-btn-blue me-3'>Saber mais</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    ";

                } else {

                    echo "
                        <div class='carousel-item'>                
                            <img src='$url/public/img/categorias/$foto' class='d-block w-100'>
                            <div class='carousel-caption mb-5 d-md-block'>
                                <h5><strong class='text-dark'>$categoria</strong></h5>
                                <div class='d-block'>
                                    <a href='./ver-categoria?id=$id'>
                                        <button class='d-inline-block my-btn-blue me-3'>Saber mais</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    ";
                }
                
                $a = (int) $a + 1;
                $s = (int) $s + 1;
            }

            echo "
                    </div>
                    <!-- /fim bloco de imagens -->
                    <!-- Botões de navegação -->
                    <button class='carousel-control-prev' type='button' data-bs-target='#carrossel-de-imagens' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Anterior</span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#carrossel-de-imagens' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='visually-hidden'>Próximo</span>
                    </button>
                </div>
            ";

        } else {
            echo "<p class='center mt-3'>Não há categorias cadastradas</p>";
        }
        
    ?>

<div class="container-xxl center">
    <h1 class="text-primary pt-5 mt-5 ms-5">Livros recentes</h1>
    <?php
        if (!empty($livros)) {

            foreach ($livros as $livro) {
                $id = $livro['id'];
                $foto = $livro['src'];
                $descricao = $livro['descricao'];
                $preco = $livro['preco'];

                echo "
                    <div class='product shadow'>
                        <div class='img'>
                            <img src='$url/public/img/infoprodutos/$foto' width='230' height='150'>
                        </div>
                        <div class='desc'>
                            <p class='name'>$descricao </p>
                            <p class='price'>Preço: $preco"."KZ</p>
                            <div class='wrapper'>
                            <a href='./ver-livro?id=$id'>
                                    <button type='submit' class='add'>
                                        <span>Saber mais</span>
                                    </button>
                            </a>
                            </div>
                        </div>
                    </div>
                ";
            }

        } else {
            echo "<p class='center mt-3'>Não há livros recomendados</p>";
        }
        
    ?>
</div>

<div class="container-xxl center">
    <h1 class="text-primary pt-4 ms-5">Todos livros</h1>
    <?php
        if (!empty($livros)) {

            foreach ($livros as $livro) {
                $id = $livro['id'];
                $foto = $livro['src'];
                $descricao = $livro['descricao'];
                $preco = $livro['preco'];

                echo "
                    <div class='product shadow'>
                        <div class='img'>
                            <img src='$url/public/img/infoprodutos/$foto' width='230' height='150'>
                        </div>
                        <div class='desc'>
                            <p class='name'>$descricao </p>
                            <p class='price'>Preço: $preco"."KZ</p>
                            <div class='wrapper'>
                            <a href='./ver-livro?id=$id'>
                                <button type='submit' class='add'>
                                    <span>Saber mais</span>
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                ";
            }

        } else {
            echo "<p class='center mt-3'>Não há livros cadastrados</p>";
        }
        
    ?>
</div>

<?php
    include_once __DIR__."/../componentes/footer.php";
?>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
