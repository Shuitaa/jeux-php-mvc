<?php

namespace Routes;

class Router{

    private $url;
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
    }


    public function get(String $path, $callable){
        return $this->add($path, $callable, 'GET');
    }

    public function post(String $path, $callable){
        return $this->add($path, $callable, 'POST');
    }

    private function add(String $path, $callable, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function try(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        throw new RouterException('Aucune route ne correspond.');
    }

}