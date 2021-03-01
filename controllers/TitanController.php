<?php

namespace Controllers;

use Models\Titan;
use Models\Model;

class TitanController {

    public function index(){
        $collection = new Model();
        $collection = $collection->getAll("titan");
        require("../views/main.php");
    }

    public function create(){
        require("../views/form.php");
    }

    public function store(){
        $titan = new Titan();
        $titan->create($_POST);
        header("location:/aot/titan/{$titan->getId()}");
    }

    public function edit($id){
        $titan = new Titan();
        $data = $titan->findById($id);
        require("../views/form.php");
    }

    public function update($id){
        $titan = new Titan();
        $titan = $titan->findById($id)->update($_POST);
        header("location:/aot/titan/$id");
    }

    public function show($id){
        $titan = new Titan();
        $titan = $titan->findById($id);
        require("../views/titan.php");
    }

    public function destroy($id){
        $titan = new Titan();
        $titan = $titan->destroy($id);
        header("location:/aot/");
    }

    public function fight(){
        $historique = [];
        $tour = 1;
        $titan1 = new Titan();
        $titan2 = new Titan();
        $titan1->findById($_POST["titan1"]);
        $titan2->findById($_POST["titan2"]);
        while($titan1->getPv() > 0 && $titan2->getPv() > 0){
            $titan1->attack($titan2);
            $titan2->attack($titan1);
            $historique[] = [
                "tour"                => $tour,
                "{$titan1->getNom()}" => "{$titan1->getPv()}",
                "{$titan2->getNom()}" => "{$titan2->getPv()}"
            ];
            $tour++;
        }
        $winner = ($titan1->getPv() > 0) ? $titan1 : $titan2;
        require("../views/fight.php");
    }
}