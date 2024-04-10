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
<body style="background-color:blue;" >
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-md-7 mt-5 mb-5" style="margin-left:auto;margin-right:auto;">
            <?php if (!empty($_SESSION['mensagem'])) {
               echo $_SESSION['mensagem'];
               $_SESSION['mensagem'] = '';
            }?>
            <div class="card p-4 shadow">
                <div class="card-body">
                    <form action="./editar-infoproduto?id=<?=$infoproduto['id']?>" method="post" enctype="multipart/form-data">
                        <div class="lead text-primary mt-2 mb-2 center">
                            <span class="display-6 font-weight-bold">Editar infoproduto</span>
                        </div>
                        <div class="lead text-secondary mt-2 mb-2 center">
                            <p>Preencha as informações abaixo para criar seu infoproduto</p>
                        </div><label class="mt-2 text-dark font-weight-bold">Foto do produto</label>
                        <input type="file" name="src" class="form-control mt-2" accept="image/*">
                        <label class="mt-2 text-dark font-weight-bold">Descrição</label>
                        <input type="text" name="descricao" class="form-control mt-2" placeholder="Ex.:Curso de Word ou livro de gestão" value="<?=$infoproduto['descricao'] ?>" required>
                        <label class="mt-2 text-dark font-weight-bold">Preço</label>
                        <input type="number" name="preco" class="form-control mt-2" placeholder="Ex.:2000kzs" value="<?=$infoproduto['preco'] ?>" required>
                        <label class="mt-2 text-dark font-weight-bold">Categória</label>
                        <select class="form-control" name="id_categoria" required>
                            <?php foreach($categorias as $c): ?>
                                <option value="<?= $c["id"] ?>" <?php echo ($c["id"] == $infoproduto['id_categoria']) ? "selected" : ""; ?> ><?= $c["categoria"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="mt-2 text-dark font-weight-bold">Percentual para afiliados</label>
                        <select class="form-control" name="id_percentual_para_afiliados" required>
                            <option value="10" <?php if ($infoproduto['percentual_para_afiliados'] == '10%' ) { echo 'selected' ;} ?>>10%</option>
                            <option value="15" <?php if ($infoproduto['percentual_para_afiliados'] == '15%' ) { echo 'selected' ;} ?>>15%</option>
                            <option value="20" <?php if ($infoproduto['percentual_para_afiliados'] == "20%" ) { echo 'selected' ;} ?>>20%</option>
                            <option value="25" <?php if ($infoproduto['percentual_para_afiliados'] == "25%" ) { echo 'selected' ;} ?>>25%</option>
                            <option value="30" <?php if ($infoproduto['percentual_para_afiliados'] == "30%" ) { echo 'selected' ;} ?>>30%</option>
                            <option value="35" <?php if ($infoproduto['percentual_para_afiliados'] == "35%" ) { echo 'selected' ;} ?>>35%</option>
                            <option value="40" <?php if ($infoproduto['percentual_para_afiliados'] == "40%" ) { echo 'selected' ;} ?>>40%</option>
                            <option value="45" <?php if ($infoproduto['percentual_para_afiliados'] == "45%" ) { echo 'selected' ;} ?>>45%</option>
                            <option value="50" <?php if ($infoproduto['percentual_para_afiliados'] == "50%" ) { echo 'selected' ;} ?>>50%</option>
                            <option value="55" <?php if ($infoproduto['percentual_para_afiliados'] == "55%" ) { echo 'selected' ;} ?>>55%</option>
                            <option value="60" <?php if ($infoproduto['percentual_para_afiliados'] == "60%" ) { echo 'selected' ;} ?>>60%</option>
                            <option value="65" <?php if ($infoproduto['percentual_para_afiliados'] == "65%" ) { echo 'selected' ;} ?>>65%</option>
                            <option value="70" <?php if ($infoproduto['percentual_para_afiliados'] == "70%" ) { echo 'selected' ;} ?>>70%</option>
                        </select>
                        <label class="mt-2 text-dark font-weight-bold">Estado do infoproduto</label>
                        <select class="form-control" name="id_status_de_infoproduto">
                            <?php foreach($status as $s): ?>
                            <option value="<?= $s["id"] ?>" <?php echo ($s["id"] == $infoproduto['id_status_de_infoproduto']) ? "selected" : ""; ?> ><?= $s["valor"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="d-flex">
                            <input type="hidden" name="id" value="<?=$infoproduto['id']?>">
                            <input type="submit" name="editar_infoproduto" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Salvar alterações">
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
