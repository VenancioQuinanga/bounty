<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../public/css/navbar7.css">
    <link rel="stylesheet" href="../public/css/footer1.css">
    <link rel="stylesheet" href="../public/css/utils4.css">
    <title>Bounty - <?=$titulo?></title>
</head>
<body style="background-color:blue;" >
<div class="container pt-5 pb-5">
<div class="row">
        <div class="col-md-7 mb-5" style="margin-left:auto;margin-right:auto;">
            <div class="col-md-7 mb-5 m-auto" >
                <?php if (!empty($_SESSION['mensagem'])) {
                echo $_SESSION['mensagem'];
                $_SESSION['mensagem'] = '';
                }?>
            </div>
            <div class="card p-4 shadow" id="sign_up">
                <div class="card-body">
                    <form action="../usuarios/registro" method="post">
                        <div class="lead text-primary mt-2 mb-2 center">
                            <span class="display-6 font-weight-bold">Registro</span>
                        </div>
                        <div class="lead text-secondary mt-2 mb-2 center">
                            <p>Preencha as informações abaixo e registre-se</p>
                        </div>
                        <p class="text-primary font-weight-bold">O que voce sera?</p>
                        <div class="d-block">
                            <input type="radio" checked name="id_tipo_de_usuario" value="2">
                            <label>Produtor</label>
                        </div>
                        <div class="d-block mt-2">
                            <input type="radio" name="id_tipo_de_usuario" value="3">
                            <label>Aluno</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="nome" id="rotulo-flutuante"  class="form-control mt-3" placeholder="Usuário" required>
                            <label for="rotulo-flutuante">Usuário</label>
                        </div>
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control mt-3" placeholder="Email" required>
                            <label for="rotulo-flutuante">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="senha" class="form-control mt-3" placeholder="senha" required>
                            <label for="rotulo-flutuante">Senha</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="confirmar_senha" class="form-control mt-3" placeholder="Confirme sua senha" required>
                            <label for="rotulo-flutuante">Confirme sua senha</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="aceito"  value="sim" class="form-input-check" required>
                            <label>Aceito os termos e condições</label>
                        </div>
                        <div class="d-flex">
                            <input type="submit" name="sign_up" class="btn btn-primary me-auto text-light mt-2 font-weight-bold" value="Registrar-me">
                            <p class="mb-1 mt-2 text-primary ms-2 font-weight-bold">
                                <a href="../usuarios/login">Fazer login?</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
