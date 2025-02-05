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
<body style="background-color:blue;">
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-md-7 mt-5 mb-5" style="margin-left:auto;margin-right:auto;">
            <?php if (!empty($_SESSION['mensagem'])) {
               echo $_SESSION['mensagem'];
               $_SESSION['mensagem'] = '';
            }?>
            <div class="card p-4 shadow">
                <div class="card-body">
                    <form action="./editar-capitulo?id=<?=$_GET['id']?>" method="post">
                        <div class="lead text-primary mt-2 mb-2 center">
                            <span class="display-6 font-weight-bold">Editar capitulo do livro</span>
                        </div>
                        <div class="lead text-secondary mt-2 mb-2 center">
                            <p>Preencha os campos abaixo</p>
                        </div>
                        <label class="mt-2 text-dark font-weight-bold">Capitulo n°</label>
                        <input type="number" name="numero_do_capitulo" class="form-control mt-2" placeholder="Capitulo n°" value="<?=$capitulo['numero_do_capitulo']?>" >        
                        <label class="mt-2 text-dark font-weight-bold">Capitulo</label>
                        <input type="text" name="capitulo" class="form-control mt-2" placeholder="Capitulo" value="<?=$capitulo['capitulo']?>" >        
                        <div class="d-flex">
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">
                            <input type="submit" name="editar_capitulo" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Alterar capitulo">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
