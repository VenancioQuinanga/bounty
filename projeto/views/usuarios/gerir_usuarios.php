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
include_once __DIR__."/../componentes/navbar_admin.php";
?>
<div class="container-xxl table-responsive">
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Usuários da plataforma</h1>
    <?php
        if (!empty($usuarios)) {

            echo "
            <table class='table table-sm shadow ps-5'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuário</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Opções</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            ";

            $i = 1;
            foreach ($usuarios as $usuario) {
                $id = $usuario['id'];
                $foto = $usuario['src'];
                $nome = $usuario['nome'];
                $email = $usuario['email'];

                echo "
                        <tr>
                            <td>$id</td>
                            <td><img src='$url/public/img/usuarios/$foto' width='50' height='50'></td>
                            <td>$nome</td>
                            <td>$email</td>
                            <td>   
                                <a href='./editar-usuario?id=$id' class='btn btn-warning'>
                                    $icone_de_edicao
                                    <span>Editar informações</span>
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

        } elseif (empty($usuarios)) {
            echo "<p class='center mt-3 mb-5'>Ainda não há usuarios cadastrados</p>";
        }
        
    ?>
    
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>