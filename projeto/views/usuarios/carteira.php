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
        <div class="col-md-7 m-auto pt-5 mt-2 mb-4 profile">
            <div class="p-5">
                <div class="lead text-primary mt-2 mb-2" style="margin-left:auto;margin-right:auto;">
                    <img src=".\public\img\icones\5411508.png" class="bg-primary border-full">
                    <span class="display-6 font-weight-bold">Carteira</span>
                </div>    
               <div class="pt-5">
                    <div class="display-5 font-weight-bold">
                    <img src=".\public\img\icones\2914569.png" class="bg-primary border-full">
                        <strong>Saldo: <?php if ($usuario['saldo']) { echo $usuario['saldo'] ;} ?> kzs</strong>
                    </div>
               </div>
            </div>            
        </div>
    </div>
</div>
<script src="./public/js/navbar1.js"></script>
<script src="./public/js/bootstrap/bootstrap.js"></script>
</body>
</html>
