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
include_once __DIR__."/../componentes/navbar.php";
?>
<div class="mt-5 pt-5 mb-5">
    <div class="row">
        <div class="col-md-7 mb-5 m-auto">
                <?php if (!empty($_SESSION['mensagem'])) {
                echo $_SESSION['mensagem'];
                $_SESSION['mensagem'] = '';
                }?>
        </div>
        <div class="col-md-11 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5">
                <div class="lead text-primary mt-2 mb-2">
                    <span class="display-6 font-weight-bold">Como efetuar saques?</span>
                </div>    
                <ul>
                    <li>A sua carteira devera ter o saldo superior á <strong>1000,00kzs</strong>;</li>
                    <li>Aqui mesmo nesta pagina deveras preencher o formulário abaixo para efetuar o seu saque;</li>
                    <li>Onde preencheras o valor de saque ou seja o valor que pretendes retirar da sua carteira
                        do bounty para a sua conta bancária.
                    </li>
                    <li><strong>OBS:</strong> As suas informações de saque como Banco, Titular da conta, Número da
                         conta, e IBAN devem estar preenchidas no seu perfil ou preenche-las aqui
                        para poderes efetuar saques.
                    </li>
                </ul>    
            </div>            
        </div>
        <div class="col-md-11 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5 pt-1">
                <form action="./saques" method="post" enctype="multipart/form-data">
                    <div class="lead text-primary mt-2 mb-2 center">
                        <span class="display-6 font-weight-bold center">Solicitar um saque</span>
                    </div>
                    <div class="lead text-secondary mt-2 mb-2 center">
                        <p>Preencha os dados abaixo e solicite seu saque</p>
                    </div>
                    <label  class="mt-2 text-dark font-weight-bold">Banco</label>
                    <input type="text" name="banco" class="form-control mt-2" placeholder="Banco á que pertence a conta" value="<?php if (!empty($informacoes_bancarias['banco'])) { echo $informacoes_bancarias['banco']; }?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Titular da conta</label>
                    <input type="text" name="titular_da_conta" class="form-control mt-2" placeholder="Nome do titular da conta" value="<?php if (!empty($informacoes_bancarias['titular_da_conta'])) { echo $informacoes_bancarias['titular_da_conta']; }?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">IBAN</label>
                    <input type="number" name="iban" class="form-control mt-2" placeholder="IBAN da conta" value="<?php if (!empty($informacoes_bancarias['iban'])) { echo $informacoes_bancarias['iban']; }?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Valor do deposito</label>
                    <input type="number" name="valor_de_transacao" class="form-control mt-2" placeholder="Quanto queres sacar?" required> 
                    <input type="hidden" name="tipo_de_transacao" value="saque">
                    <input type="submit" name="efetuar_transacao" class="btn btn-primary me-auto text-light mt-2 font-weight-bold" value="Solicitar saque">
                </form>                
            </div>
        </div>
        <div class="col-md-11 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5 pt-1">
                <div class="lead text-primary mt-2">
                    <span class="display-6 font-weight-bold">Histórico de saques</span>
                </div>                                
            </div>
            <?php 
                if (!empty($transacoes)) {

                    foreach ($transacoes as $t) {
                        
                        $banco =  $t['banco'];
                        $titular =  $t['titular'];
                        $iban =  $t['iban'];
                        $valor =  $t['valor'];
                        $status =  $t['status'];
                        $data =  $t['data'];

                        echo "
                        <div class='product shadow'>
                            <div class='desc'>
                                <p><strong>Banco: </strong>". $banco."</p>  
                                <p><strong>Titular da conta: </strong>". $titular."</p>  
                                <p><strong>IBAN: </strong>". $iban."</p>
                                <p><strong>Valor: </strong>". $valor."kzs</p>  
                                <p><strong>Status: </strong>". $status."</p>  
                                <p><strong>Data: </strong>".$data."</p>
                            </div>
                        </div>
                    ";

                    }

                } else {
                    echo "
                        <div class=' ms-5 mb-4'>
                            <span class='lead text-secondary'>Voce ainda não efetuou saques</span>
                        </div>
                    ";
                }    
            ?>
        </div>
    </div>
</div>
<script src="<?=$url?>/public/js/navbar1.js"></script>
<script src="<?=$url?>/public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
