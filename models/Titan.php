<?php

namespace Models;

class Titan extends Model {

    private $atk;
    private $pv;
    private $nom;
    private $id;

    public function __construct(){
        parent::__construct();
    }

    public function setAtk($atk){
        if($atk < 0){
            return $this->atk = -$atk;
        }
        if(!is_numeric($atk)  || $atk === 0){
            return $this->atk = 50;
        }
        return $this->atk = $atk;
    }

    public function setPv($pv){
        if($pv <= 0){
            return $this->pv = 0;
        }
        if(!is_numeric($pv)){
            return $this->pv = 50;
        }
        return $this->pv = $pv;
    }
    public function setNom($nom){
        if($nom == ''){
            return $this->nom = 'titan classique';
        }
        return $this->nom = strtolower($nom);
    }

    public function setId($id){
        return $this->id =$id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getAtk(){
        return $this->atk;
    }

    public function getId(){
        return $this->id;
    }

    public function getPv(){
        return $this->pv;
    }

    public function attack(Titan $titan){
        $titan->setPv($titan->getPv() - $this->getAtk());
        return $titan->update(get_object_vars($titan));
    }

}