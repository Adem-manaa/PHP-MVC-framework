<?php
class App{

    private $controller = 'home';
    private $method = 'index';
    
    public function splitUrl()
    {
        $url = $_GET['url'] ?? 'home';
        $url = explode("/",trim($url,"/"));
        return $url;
    }

    public function loadController(){

        $url = $this->splitUrl();
        $fileName = "../app/controllers/".ucfirst($url[0]).".php";
        if (file_exists($fileName)){
            require $fileName;
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        else{
            $fileName = "../app/controllers/_404.php";
            require $fileName;
            $this->controller = "_404";
            unset($url[0]);
        }

        $controller = new $this->controller;

        if(!empty($url[1])){
            if(method_exists($controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        call_user_func_array([$controller,$this->method],$url);

    }

}
