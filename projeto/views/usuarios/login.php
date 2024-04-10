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
        <div class="col-md-7 mb-5 m-auto">
            <?php if (!empty($_SESSION['mensagem'])) {
               echo $_SESSION['mensagem'];
               $_SESSION['mensagem'] = '';
            }?>
            <div class="card p-4 shadow">
                <div class="card-body">
                    <form action="../usuarios/login" method="post">
                        <div class="lead text-primary mt-2 mb-2 center">
                            <span class="display-6 font-weight-bold">Login</span>
                        </div>
                        <div class="lead text-secondary mt-2 mb-2 center">
                            <p>Entrar com email e senha</p>
                        </div>
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control mt-3" placeholder="Email">
                            <label for="rotulo-flutuante ">Email</label>
                            <p class="mb-0 mt-2 text-primary font-weight-bold">
                                <a href="../usuarios/codigo-de-verificacao">Esqueceu sua senha?</a>
                            </p>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="senha" class="form-control" placeholder="senha">
                            <label for="rotulo-flutuante">Senha</label>
                        </div>
                        <div class="d-flex">
                            <input type="submit" name="sign_in" class="btn btn-primary me-auto text-light mt-2 font-weight-bold" value="Entrar">
                            <p class="mb-1 mt-2 text-primary ms-2 font-weight-bold">
                                <a href="../usuarios/registro">Criar conta?</a>
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
