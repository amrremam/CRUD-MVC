<?php

class App
{
    protected $controller = "HomeController";
    protected $action = "index";
    protected $params = [];

    public function __construct()
    {

        $this->prepareURL();
        $this->render();

    }

    //extract controller,methods and params

    private function prepareURL()
    {
        $url =  $_SERVER['QUERY_STRING'];
        if(!empty($url)){
            //trim bt2bael awl 5ana elhaga eli hashel menha tani haga eli hashelha
            $url = trim($url,"/");
            $url = explode("/" , $url);

            //define the controller

            $this->controller = isset($url[0]) ? ucwords($url[0])."controller":"HomeController";

            //define action
            $this->action = isset($url[1]) ? $url[1] : "index";

            unset($url[0],$url[1]);

            $this->params = !empty($url) ? array_values($url):[];
            var_dump($this->params);
        }
    }

    private function render()
    {
        if(class_exists($this->controller)){

            $controller = new $this->controller;
            
            //method exist bet2abel 2--el object eli 3awez acheck en elmethod gowaa w elmethod bta3ty

            if(method_exists($controller, $this->action))
            {
                //bt2bel 2--object,method w elparams
                call_user_func_array([$controller,$this->action],$this->params);
            }else
            {
                echo"Method Not Exist";
            }
        }
        else
        {
            echo "This Controller :" .$this->controller. "Not Exist";
        }

}

}