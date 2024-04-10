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
        <div class="col-md-7 mt-5 mb-5 m-auto">
            <?php if (!empty($_SESSION['mensagem'])) {
               echo $_SESSION['mensagem'];
               $_SESSION['mensagem'] = '';
            }?>
            <div class="card p-4 shadow">
                <div class="card-body">
                    <form action="../usuarios/codigo-de-verificacao" method="POST">
                        <div class="lead text-primary mt-2 mb-2 center">
                            <span class="display-6 font-weight-bold">Código de verificacão</span>
                        </div>
                        <div class="lead text-secondary mt-2 mb-2 center">
                            <p>Informe o seu email para receber o código</p>
                        </div>
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control mt-3" placeholder="Informe o seu email">
                            <label for="rotulo-flutuante">Informe o seu email</label>
                        </div>
                        <input type="submit" name="receber_codigo" class="btn btn-primary me-auto text-light mt-2 font-weight-bold" value="Receber código">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
