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
<div class="container-xxl table-responsive">
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Cursos adquiridos</h1>
    <?php
        if (!empty($cursos)) {

            echo "
            <table class='table table-sm shadow ps-5'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Curso</th>
                        <th>Descrição</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
            ";

            $i = 1;
            foreach ($cursos as $curso) {

                $id = $curso['id'];
                $foto = $curso['src'];
                $descricao = $curso['descricao'];

                echo "
                        <tr>
                            <td>$i</td>
                            <td><img src='$url/public/img/infoprodutos/$foto' width='50' height='50'></td>
                            <td>$descricao</td>
                            <td>   
                                <a href='$url/assistir-curso?id=$id' class='btn btn-primary'>
                                    $icone_de_visualizacao
                                    <span>Assistir curso</span>
                                </a>
                            </td>                
                        </tr>
                ";
                $i++;
            }

            echo "
                </tbody>
                </table>
                ";

        } else {
            echo "<p class='center mt-3 mb-5'>Voce ainda não comprou nenhum livro, faça uma compra!</p>";
        }
        
    ?>

<div class="container-xxl table-responsive">
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Livros adquiridos</h1>
    <?php

        if (!empty($livros)) {

            echo "
            <table class='table table-sm shadow ps-5'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Livro</th>
                        <th>Descrição</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
            ";

            $i = 1;
            foreach ($livros as $livro) {

                $id = $livro['id'];
                $foto = $livro['src'];
                $src = $livro['src2'];
                $descricao = $livro['descricao'];

                echo "
                        <tr>
                            <td>$i</td>
                            <td><img src='$url/public/img/infoprodutos/$foto' width='50' height='50'></td>
                            <td>$descricao</td>
                            <td>   
                                <a href='$api/assets/docs/$src' target='_blank' class='btn btn-primary'>
                                    $icone_de_visualizacao
                                    <span>Ler livro</span>
                                </a>
                            </td>                
                            <td>   
                                <a href='$api/assets/docs/$src' target='_blank' download='$src' class='btn btn-dark'>
                                    <span>Baixar livro</span>
                                </a>
                            </td> 
                        </tr>
                ";
                $i++;
            }

            echo "
                </tbody>
                </table>
                ";

        } else {
            echo "<p class='center mt-3 mb-5'>Voce ainda não comprou nenhum livro, faça uma compra!</p>";
        }
        
    ?>
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>