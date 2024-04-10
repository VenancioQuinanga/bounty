<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./public/css/navbar7.css">
    <link rel="stylesheet" href="./public/css/footer1.css">
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
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Aulas do curso</h1>
    <table class="table table-sm shadow ps-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Curso</th>
                <th>Descrição</th>
                <th>
                    <a href="./adicionar-aula?id_curso=<?=$infoproduto['id']?>" class="btn btn-dark">
                        Adicionar aula
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (!empty($aulas)) {

                $foto = $infoproduto['src'];
                $i = 1;
                foreach ($aulas as $aula) {
                    
                    $id = $aula['id'];
                    $licao = $aula['numero_da_licao'];
                    $sumario = $aula['sumario'];

                    echo "
                        <tr>
                            <td>$i</td>
                            <td><img src='$url/public/img/infoprodutos/$foto' width='50' height='50'></td>
                            <td>$sumario</td>
                            <td>   
                                <a href='./editar-aula?id=$id' class='btn btn-warning'>
                                    $icone_de_edicao
                                    <span>Editar aula</span>
                                </a>
                            </td>
                        </tr>
                    ";
                    $i++;
                }

            } else {
                echo "<tr> <td class='center mt-3 mb-5'>Voce ainda não criou nenhuma aula</td> </tr>";
            }
            
        ?>
        </tbody>
    </table>
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
