<?php 

class Controller{
    public function view($name){
        
        $fileName = "../app/views/".$name.".view.php";
        if (file_exists($fileName)){
            require $fileName;
            $class = $name."View";
            $view = new $class();
            $view->display();
        }
        else{
            $fileName = "../app/views/404.view.php";
            require $fileName;
            $class= "_404View";
            $view = new $class();
            $view->display();
        }
    }
}