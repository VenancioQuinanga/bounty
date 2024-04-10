<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./public/css/navbar7.css">
    <link rel="stylesheet" href="./public/css/utils4.css">
    <link rel="stylesheet" href="./public/css/perfil1.css">
    <title>Bounty - <?=$titulo?></title>
</head>
<body>
<?php
include_once __DIR__."/../componentes/navbar_admin.php";
?>
<div class="container-xxl table-responsive">
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Histórico de compras</h1>
    <?php
        if (!empty($compras)) {

            echo "
            <table class='table table-sm shadow ps-5'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produto</th>
                        <th>Tipo de compra</th>
                        <th>Produtor</th>
                        <th>valor da compra</th>
                        <th>Data da compra</th>
                    </tr>
                </thead>
                <tbody>
            ";

            $i = 1;
            foreach ($compras as $compra) {

                $id = $compra['id'];
                $produto = $compra['produto'];
                $produtor = $compra['produtor'];
                $tipo = $compra['tipo'];
                $valor = $compra['valor'];
                $data = $compra['data'];

                echo "
                        <tr>
                            <td>$id</td>
                            <td>$produto</td>
                            <td>$tipo</td>
                            <td>$produtor</td>
                            <td>$valor"."kzs</td>
                            <td>$data</td>     
                        </tr>
                ";
                $i++;
            }

            echo "
                </tbody>
                </table>
                ";

        } elseif (empty($compras)) {
            echo "<p class='center mt-3 mb-5'>Ainda não há compras efetuadas</p>";
        }
        
    ?>
    
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
