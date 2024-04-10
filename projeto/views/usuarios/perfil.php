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
include_once __DIR__."/../componentes/navbar.php";
?>
<div class="mt-5 pt-5 mb-5">
    <div class="row">
        <div class="col-md-7 mb-5 m-auto" >
            <?php if (!empty($_SESSION['mensagem'])) {
                echo $_SESSION['mensagem'];
                $_SESSION['mensagem'] = '';
            }?>
        </div>
        <div class="col-md-7 m-auto pt-5 mt-2 mb-4 profile">
            <div class="user_wrapper">
                <div class="user_photo">
                    <img src=<?=$url."/public/img/usuarios/".$usuario['src']?> width="300" height="300em" style="border-radius:100%;">
                </div>
            </div>
            <div class="p-5">
                <form action="./perfil" method="post" enctype="multipart/form-data">
                    <div class="lead text-primary mt-2 mb-2 center">
                        <span class="display-6 font-weight-bold">Perfil</span>
                    </div>
                    <label class="mt-2 text-dark font-weight-bold">Foto de perfil</label>
                    <input type="file" name="src" class="form-control mt-2" accept="image/*">
                    <label class="mt-2 text-dark font-weight-bold">Usuário</label>
                    <input type="text" name="nome" class="form-control mt-2" placeholder="Usuário" value="<?=$usuario['nome']?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control mt-2" placeholder="Email" value="<?=$usuario['email']?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Senha</label>
                    <input type="password" name="senha" class="form-control mt-2" placeholder="senha" value="">
                    <input type="hidden" name="id" value="<?=$_SESSION['token']?>" >
                    <input type="submit" name="editar_informacoes_basicas" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Salvar alterações">
                </form>                
            </div>
        </div>
        <div class="col-md-7 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5 pt-1">
                <form action="./perfil" method="post">
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
                    <input type="hidden" name="id" value="<?=$_SESSION['token']?>" >
                    <input type="submit" name="editar_informacoes_bancarias" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Salvar alterações">
                    <button type="submit" name="logout" class="btn btn-danger font-weight-bold form-control mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                        <span>Terminar sessão</span>
                    </button>
                </form>                
            </div>
        </div>
    </div>
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
