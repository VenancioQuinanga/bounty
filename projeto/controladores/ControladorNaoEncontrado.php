<?php

class ControladorNaoEncontrado
{
    public function index(){
        echo "
        <head>
        <title>Pagina não encontrado | Erro</title>
        </head>
        <body style='background-color:rgb(32,33,36);color:#fff;font-family: system-ui, sans-serif;font-size: 75%;'>
            <div style='text-align:center;padding-top:10em;'>
            <h1>Não foi possivel chegar a está pagina</h1>
            <p style='font-size:1.3em;'>Por favor verifique se o endereço está correto<p>
            <p>
            <h2>Expermente:</h2>
            <h4>Colocar o endereço correto ou </h4>
            <h4>Carregar á pagina novamente</h4>
            
            </p>
            </div>
        </body>
        ";
    }
}
