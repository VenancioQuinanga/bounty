<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./public/css/navbar7.css">
    <link rel="stylesheet" href="./public/css/utils4.css">
    <link rel="stylesheet" href="./public/css/info-products1.css">
    <link rel="stylesheet" href="./public/css/perfil1.css">
    <title>Bounty - <?=$titulo?></title>
</head>
<body>
<?php
    include_once __DIR__."/../componentes/navbar.php";
?>
<div class="container-xxl pt-5 mt-5 center">
<?php 
        if (!empty($aulas)) {

            $id = $infoproduto['id'];
            $foto = $infoproduto['src'];
            $curso = $infoproduto['descricao'];
            $autor = $produtor['nome'];
            foreach ($aulas as $aula) {

                $src = $aula['src'];
                $sumario = $aula['sumario'];
                $licao = $aula['numero_da_licao'];

                echo "
                    <div class='product shadow'>
                        <div class='img'>
                            <video src='$url/public/video/$src' width='230' height='200' 
                                poster='$url/public/img/infoprodutos/$foto'
                                controls='controls'>
                            </video>
                        </div>
                        <div class='desc'>
                            <p class='name'>$licao $sumario</p>
                            <p class='price'>Autor: $autor</p>
                        </div>
                    </div>
                ";
            }
            
        } else {
            echo "<p class='center mt-3'>Ainda não há aulas sobre este curso</p>";
        }
        
    ?>
    </div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
