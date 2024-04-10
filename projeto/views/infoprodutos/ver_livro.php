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
<div class="container-xxl center">
    <h1 class="text-primary pt-5 mt-5 ms-5">Capitulos do livro</h1>
    <div class="col-md-7 pt-5 mb-5 m-auto">
        <?php if (!empty($_SESSION['mensagem'])) {
            echo $_SESSION['mensagem'];
            $_SESSION['mensagem'] = '';
        }?>
    </div>
    <?php 
        if (!empty($capitulos)) {

            $id = $infoproduto['id'];
            $foto = $infoproduto['src'];
            $livro = $infoproduto['descricao'];
            $id_usuario = $_SESSION['token'];
            $valor_de_compra = $infoproduto['preco'];
            $percentual = $infoproduto['percentual_para_afiliados'];
            foreach ($capitulos as $c) {

                $capitulo = $c['capitulo'];
                $n = $c['numero_do_capitulo'];

                echo "
                    <div class='product shadow'>
                        <div class='img'>
                            <img src='$url/public/img/infoprodutos/$foto' width='230' height='150'>
                        </div>
                        <div class='desc'>
                            <p class='name'>$livro</p>
                            <p class='price'>$n $capitulo</p>
                            <div class='wrapper'>
                                <form action='./comprar-infoproduto' method='POST'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='hidden' name='id_usuario' value='$id_usuario'>
                                    <input type='submit' name='comprar_infoproduto' value='Comprar livro' class='add'>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
            }

        } else {
            echo "<p class='center mt-3'>Ainda não há detalhes sobre capitulos deste livro</p>";
        }
        
    ?>
</div>

<?php
    include_once __DIR__."/../componentes/footer.php";
?>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
