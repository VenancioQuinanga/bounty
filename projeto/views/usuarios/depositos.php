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
                <div class="lead text-primary mt-2 mb-2" style="margin-left:auto;margin-right:auto;">
                    <span class="display-6 font-weight-bold">Como efetuar deposito?</span>
                </div>    
                <ul>
                    <li>Dirija-se á um ATM ou utilize um aplicativo bancário como 
                        o Bai Direto, multicaixa Express, Internet Banking ou um outro aplicativo;
                    </li>
                    <li>Selecionar a opção transferencia bancaria;</li>
                    <li>Introduzir o <strong>IBAN:0040.0000.1317.3137.1012.1</strong>;</li>
                    <li>Introduza o valor a transferir;</li>
                    <li>E já está;</li>
                    <li><strong>OBS:</strong> O titular da conta é <strong>Bounty comercio e prestação de serviços LDA</strong>.
                    Após ter efetuado o deposito, entre em contato com o nosso suporte técnico do whatsApp para ajuda-lo.
                    </li>
                </ul>    
            </div>            
        </div>
        <div class="col-md-11 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5 pt-1">
                <form action="./depositos" method="post" enctype="multipart/form-data">
                    <div class="lead text-primary mt-2 mb-2 center">
                        <span class="display-6 font-weight-bold center">Efetuar um Deposito</span>
                    </div>
                    <div class="lead text-secondary mt-2 mb-2 center">
                        <p>Preencha os dados abaixo e efetue seu deposito</p>
                    </div>
                    <label  class="mt-2 text-dark font-weight-bold">Banco</label>
                    <input type="text" name="banco" class="form-control mt-2" placeholder="Banco á que pertence a conta" value="<?php if (!empty($informacoes_bancarias['banco'])) { echo $informacoes_bancarias['banco']; }?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Titular da conta</label>
                    <input type="text" name="titular_da_conta" class="form-control mt-2" placeholder="Nome do titular da conta" value="<?php if (!empty($informacoes_bancarias['titular_da_conta'])) { echo $informacoes_bancarias['titular_da_conta']; }?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">IBAN</label>
                    <input type="number" name="iban" class="form-control mt-2" placeholder="IBAN da conta" value="<?php if (!empty($informacoes_bancarias['iban'])) { echo $informacoes_bancarias['iban']; }?>" >
                    <label class="mb-1 mt-2 text-dark font-weight-bold">Valor do deposito</label>
                    <input type="number" name="valor_de_transacao" class="form-control mt-2" placeholder="Quanto queres depositar?" required>
                    <input type="hidden" name="tipo_de_transacao" value="Depósito">              
                    <label class="mt-2 text-dark font-weight-bold">Foto do comprovativo de deposito</label>
                    <input type="file" name="comprovativo" class="form-control mt-2" accept="image/*" required>      
                    <input type="submit" name="efetuar_transacao" class="btn btn-primary me-auto text-light mt-2 font-weight-bold" value="Efetuar deposito">
                </form>                
            </div>
        </div>
        <div class="col-md-11 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5 pt-1">
                <div class="lead text-primary mt-2">
                    <span class="display-6 font-weight-bold">Histórico de depositos</span>
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
                            <span class='lead text-secondary'>Voce ainda não efetuou depositos</span>
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
