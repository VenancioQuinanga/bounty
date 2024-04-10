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
<div class="container-xxl center pt-5 mt-5">
    <div class="col-md-7 mb-5 m-auto">
            <?php if (!empty($_SESSION['mensagem'])) {
               echo $_SESSION['mensagem'];
               $_SESSION['mensagem'] = '';
            }?>
    </div>
    <h1 class="text-primary pt-4 ms-5">Todos cursos</h1>
    <?php

    if (!empty($cursos)) {

        foreach ($cursos as $curso) {
        
            $id = $curso['id'];
            $foto = $curso['src'];
            $descricao = $curso['descricao'];
            $percentual = $curso['percentual_para_afiliados'];


            echo "
                <div class='product shadow'>
                    <div class='img'>
                        <img src='$url/public/img/infoprodutos/$foto' width='230' height='150'>
                    </div>
                    <div class='desc'>
                        <p class='name'>$descricao </p>
                        <p class='price'>Percentual para afiliados: $percentual</p>
                        <form action='./explorar-infoprodutos' method='POST'>
                            <div class='wrapper'>
                                <input type='hidden' name='id' value='$id'>
                                <input type='submit' name='me_afiliar' value='Me afiliar' class='add'>
                            </div>
                        </form>
                    </div>
                </div>
            ";
        }

    } else {
        echo "<p class='center mt-3'>Ainda não há cursos para te afiliares</p>";
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
            $percentual = $livro['percentual_para_afiliados'];

            echo "
                <div class='product shadow'>
                    <div class='img'>
                        <img src='$url/public/img/infoprodutos/$foto' width='230' height='150'>
                    </div>
                    <div class='desc'>
                        <p class='name'>$descricao </p>
                        <p class='price'>Percentual para afiliados: $percentual</p>
                        <form action='./explorar-infoprodutos' method='POST'>
                            <div class='wrapper'>
                                <input type='hidden' name='id' value='$id'>
                                <input type='submit' name='me_afiliar' value='Me afiliar' class='add'>
                            </div>
                        </form>
                    </div>
                </div>
            ";
        }

    } else {
        echo "<p class='center mt-3'>Ainda não há cursos para te afiliares</p>";
    }
    
    ?>
</div>

<?php
    include_once __DIR__."/../componentes/footer.php";
?>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
