<?php

class core {
    public function run($roteador){
        $url = '/';

        isset($_GET['url'])? $url .= $_GET['url'] : '';
        ($url != '/') ? $url = rtrim($url,'/') : $url;

        $rotaEncontrada = false;
        foreach ($roteador as $path => $controlador) {
            $pattern = '#^' .preg_replace('/{id}/' , '(\w+)' ,$path ).'$#';

            if (preg_match($pattern,$url,$matches)) {
                array_shift($matches);

                $rotaEncontrada = true;

                [$controladorAtual,$acao] = explode('@',$controlador);

                require __DIR__ ."/../controladores/$controladorAtual.php";

                $novoControlador = new $controladorAtual();
                $novoControlador->$acao();
                
            }
        }

        if (!$rotaEncontrada) {
            require __DIR__ ."/../controladores/ControladorNaoEncontrado.php";
            $Controlador = new ControladorNaoEncontrado();
            $Controlador->index();
        }
        
    }
}