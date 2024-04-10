<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./public/css/navbar7.css">
    <link rel="stylesheet" href="./public/css/footer1.css">
    <link rel="stylesheet" href="./public/css/utils4.css">
    <title>Bounty - <?=$titulo?></title>
</head>
<body style="background-color:blue;" >
<div class="container pt-5 pb-5">
<div class="row">
        <div class="col-md-7 mt-5 mb-5" style="margin-left:auto;margin-right:auto;">
            <div class="card p-4 shadow" id="sign_up">
                <div class="card-body">
                    <form action="./criar-infoproduto" method="post" enctype="multipart/form-data">
                        <div class="lead text-primary mt-2 mb-2 center">
                            <span class="display-6 font-weight-bold">Criar infoproduto</span>
                        </div>
                        <div class="lead text-secondary mt-2 mb-2 center">
                            <p>Preencha as informações abaixo para criar seu infoproduto</p>
                        </div>
                        <label class="mt-2 text-dark font-weight-bold">Foto do produto</label>
                        <input type="file" name="src" class="form-control mt-2" accept="image/*" required>
                        <label class="mt-2 text-dark font-weight-bold">Descrição</label>
                        <input type="text" name="descricao" class="form-control mt-2" placeholder="Ex.:Curso de Word ou livro de gestão" required>
                        <label class="mt-2 text-dark font-weight-bold">Preço</label>
                        <input type="number" name="preco" class="form-control mt-2" placeholder="Ex.:2000kzs" required>
                        <label class="mt-2 text-dark font-weight-bold">Categória</label>
                        <select class="form-control" name="id_categoria" required>
                        <?php
                        if (!empty($categorias)) {

                            foreach ($categorias as $key => $c) {

                                $id_categoria = $c['id'];
                                $categoria = $c['categoria'];

                                echo "
                                <option value='".$id_categoria."'>".$categoria."</option>
                                ";
                                }

                        } else {

                            echo "<p>Ainda não hà nenhuma categória cadastrada</p>";
                        }
                        
                         ?>
                        </select>
                        <label class="mt-2 text-dark font-weight-bold">Percentual para afiliados</label>
                        <select class="form-control" name="percentual_para_afiliados" required>
                            <option value="">Qual é a percentagem de dinheiro para seus vendedores?</option>
                            <option value="10">10%</option>
                            <option value="15">15%</option>
                            <option value="20">20%</option>
                            <option value="25">25%</option>
                            <option value="30">30%</option>
                            <option value="35">35%</option>
                            <option value="40">40%</option>
                            <option value="45">45%</option>
                            <option value="50">50%</option>
                            <option value="55">55%</option>
                            <option value="60">60%</option>
                            <option value="65">65%</option>
                            <option value="70">70%</option>
                        </select>
                        <p class="text-dark font-weight-bold mt-2">Qual é o tipo de infoproduto?</p>
                        <?php
                        if (!empty($tipos)) {

                            foreach ($tipos as $key => $t) {

                                $id_tipo = $t['id'];
                                $tipo = $t['tipo'];

                                echo "
                                <div class='d-block'>
                                    <input type='radio' checked name='id_tipo_de_infoproduto' value='".$id_tipo."' required>
                                    <label >".$tipo."</label>
                                </div>
                                ";
                                }

                        } else {

                            echo "<p>Ainda não hà nenhum tipo cadastrado</p>";
                        }
                         ?>
                        <div class="d-flex">
                            <input type="hidden" name="id_usuario" value="<?=$_SESSION['token']?>">
                            <input type="submit" name="criar_infoproduto" class="btn btn-primary form-control me-auto text-light mt-2 font-weight-bold" value="Criar infoproduto">
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
