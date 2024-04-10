<?php

class RenderView{
    public function loadView($view,$args){
        extract($args);

        require __DIR__."/../views/$view.php";
    }
}
