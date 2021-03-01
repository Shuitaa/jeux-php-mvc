<?php

namespace Routes;

class Route{

    private $path;
    private $callable;
    private $matches;

    public function __construct(String $path, $callable){
        $this->path = trim($path,'/');
        $this->callable = $callable;
    }

    public function match($url){
        $url = trim($url, '/');
        $url = str_replace('public/','',$url);
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }

        array_shift($matches);

        $this->matches = $matches;

        return true;

    }

    public function call(){
        if(is_string($this->callable)){
            $settings = explode('@', $this->callable);
            $controller = "Controllers\\".$settings[0];
            $action = $settings[1];
            $controller = new $controller();
            return call_user_func_array([$controller, $action], $this->matches);
        }

        return call_user_func_array($this->callable, $this->matches);
      
    }

}