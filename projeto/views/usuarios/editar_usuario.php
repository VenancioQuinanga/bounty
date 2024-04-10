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
<div class="mt-5 pt-5 mb-5">
    <div class="row">
        <div class="col-md-7 m-auto pt-5 mt-2 mb-4 profile">
            <div class="user_wrapper">
                <div class="user_photo">
                    <img src="<?=$url?>/public/img/usuarios/<?=$usuario['src']?>" width="300" height="300em" style="border-radius:100%;">
                </div>
            </div>
            <div class="p-5">
                <form action="./editar-usuario?id=<?=$usuario['id']?>" method="post" enctype="multipart/form-data">
                    <div class="lead text-primary mt-2 mb-2 center">
                        <span class="display-6 font-weight-bold">Perfil</span>
                    </div>
                    <label class="mt-2 text-dark font-weight-bold">Usuário</label>
                    <input type="text" name="nome" class="form-control mt-2" placeholder="Usuário" value="<?=$usuario['nome']?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control mt-2" placeholder="Email" value="<?=$usuario['email']?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Senha</label>
                    <input type="password" name="senha" class="form-control mt-2" placeholder="senha" value="">
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Saldo</label>
                    <input type="number" name="saldo" class="form-control mt-2" placeholder="saldo" value="<?=$usuario['saldo']?>">
                    <input type="hidden" name="id" value="<?=$_GET['id']?>" >
                    <input type="submit" name="editar_informacoes_basicas_do_usuario" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Salvar alterações">
                </form>                
            </div>
        </div>
        <div class="col-md-7 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5 pt-1">
                <form action="./editar-usuario?id=<?=$usuario['id']?>" method="post">
                    <div class="lead text-primary mt-2 mb-2 center" style="margin-left:auto;margin-right:auto;">
                        <span class="display-6 font-weight-bold">Informações de saque</span>
                    </div>
                    <label  class="mt-2 text-dark font-weight-bold">Banco</label>
                    <input type="text" name="banco" class="form-control mt-2" placeholder="Banco á que pertence a conta" value="<?=$informacoes_bancarias['banco']?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Titular da conta</label>
                    <input type="text" name="titular_da_conta" class="form-control mt-2" placeholder="Nome do propietário da conta" value="<?=$informacoes_bancarias['titular_da_conta']?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">IBAN</label>
                    <input type="number" name="iban" class="form-control mt-2" placeholder="IBAN da conta" value="<?=$informacoes_bancarias['iban']?>" >
                    <input type="hidden" name="id_informacoes_bancarias" value="<?=$informacoes_bancarias['id']?>" >
                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                    <input type="submit" name="editar_informacoes_bancarias_do_usuario" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Salvar alterações">
                </form>                
            </div>
        </div>
    </div>
</div>
<div class="container-xxl table-responsive">
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Histórico de depositos</h1>
    <?php
        if (!empty($depositos)) {

            echo "
            <table class='table table-sm shadow ps-5'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Banco</th>
                        <th>Titular</th>
                        <th>IBAN</th>
                        <th>valor</th>
                        <th>Data</th>
                        <th>Status/Opções</th>
                    </tr>
                </thead>
                <tbody>
            ";
            $i = 1;
            foreach ($depositos as $deposito) {

                $banco = $deposito['banco'];
                $titular = $deposito['titular'];
                $iban = $deposito['iban'];
                $valor = $deposito['valor'];
                $data = $deposito['data'];
                $comprovativo = $deposito['comprovativo'];
                $id = $_GET['id'];

                echo "
                    <tr>
                        <td>$i</td>
                        <td>$banco</td>
                        <td>$titular</td>
                        <td>$iban</td>
                        <td>$valor</td>
                        <td>$data</td>
                        <td>
                            <form action='./editar-usuario?id=$id' method='POST'>
                                <div class='d-flex'>
                                    <select name='id_status' class='me-2'>
                    ";

                                    foreach($status as $s){
                                        $id_status = $s['id'];
                                        $valor = $s['valor'];
                                        $status_do_deposito = $deposito['status'];

                                        if ($status_do_deposito == $valor) {

                                            echo"
                                                '<option value='$id_status' selected> $valor</option>
                                            ";

                                        } else {

                                            echo"
                                                '<option value='$id_status'> $valor</option>
                                            ";
                                        }
                                        
                                    }
                                    
                        echo "
                                    </select>
                                    <input type='hidden' name='id_usuario' value='$id'>
                                    <input type='hidden' name='comprovativo' value='$comprovativo'>
                                    <input type='submit' name='alterar_status_de_transacao' class='btn btn-dark' value='Alterar'>
                                </div>
                            </form>
                        </td>   
                        <td>   
                            <a href='$url/public/img/comprovativos/$comprovativo' target='_blank' class='btn btn-secondary'>
                                <span>Ver comprovativo</span>
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
            echo "<p class='center mt-3 mb-5'>O usuário ainda não efetuou nenhum deposito</p>";
        }
        
    ?>
</div>

<div class="container-xxl table-responsive">
    <h1 class="text-primary pt-5 mt-5 ms-5 center">Histórico de saques</h1>
    <?php
        if (!empty($saques)) {

            echo "
            <table class='table table-sm shadow ps-5'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Banco</th>
                        <th>Titular</th>
                        <th>IBAN</th>
                        <th>valor</th>
                        <th>Data</th>
                        <th>Status/Opções</th>
                    </tr>
                </thead>
                <tbody>
            ";
            $i = 1;
            foreach ($saques as $saque) {

                $banco = $saque['banco'];
                $titular = $saque['titular'];
                $iban = $saque['iban'];
                $valor = $saque['valor'];
                $data = $saque['data'];
                $comprovativo = $saque['comprovativo'];
                $id = $_GET['id'];

                echo "
                    <tr>
                        <td>$i</td>
                        <td>$banco</td>
                        <td>$titular</td>
                        <td>$iban</td>
                        <td>$valor</td>
                        <td>$data</td>
                        <td>
                            <form action='./editar-usuario?id=$id' method='POST'>
                                <div class='d-flex'>
                                    <select name='id_status' class='me-2'>
                    ";

                                    foreach($status as $s){
                                        $id_status = $s['id'];
                                        $valor = $s['valor'];
                                        $status_do_saque = $saque['status'];

                                        if ($status_do_saque == $valor) {

                                            echo"
                                                '<option value='$id_status' selected> $valor</option>
                                            ";

                                        } else {

                                            echo"
                                                '<option value='$id_status'> $valor</option>
                                            ";
                                        }
                                        
                                    }
                                    
                        echo "
                                    </select>
                                    <input type='hidden' name='id_usuario' value='$id'>
                                    <input type='hidden' name='comprovativo' value='$comprovativo'>
                                    <input type='submit' name='alterar_status_de_transacao' class='btn btn-dark' value='Alterar'>
                                </div>
                            </form>
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
            echo "<p class='center mt-3 mb-5'>O usuário ainda não efetuou nenhum saque</p>";
        }
        
    ?>
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
