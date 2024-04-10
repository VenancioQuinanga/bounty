<?php
require __DIR__.'/core/core.php';
require __DIR__.'/roteador/rotas.php';

spl_autoload_register(function($file){
    if (file_exists(__DIR__."/utils/$file.php")) {
        require_once __DIR__."/utils/$file.php";
    }else if (file_exists(__DIR__."/modelos/$file.php")) {
        require_once __DIR__."/modelos/$file.php";
        
    }
});

$core = new core();
$core->run($rotas);
