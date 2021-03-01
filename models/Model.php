<?php

namespace Models;

class Model {

    public function __construct(){
        $this->db = new \PDO("mysql:host=localhost;dbname=aot;port=3306;charset=utf8", "root", "root", array(

            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION 
            
        )); 

        $this->table = explode('\\',strtolower(get_class($this)).'s')[1];
    }

    public function create(Array $params){
        $stmt = "INSERT INTO {$this->table} VALUES (NULL,";
        $stmt = $stmt . $this->mapParams($params). ")";
        $db = $this->db->prepare($stmt);
        $db->execute();
        return $this->findById($this->db->lastInsertId());
    }

    public function findById($id){
        $stmt = "SELECT * FROM {$this->table} WHERE id = :id";
        $db = $this->db->prepare($stmt);
        $db->execute([
            "id" => $id
        ]);
        $datas = $db->fetch();
        return $this->hydrate($datas);
    }

    public function getAll($table){
        $stmt = "SELECT * FROM {$table}s";
        $db = $this->db->prepare($stmt);
        $db -> execute();
        $datas = $db->fetchAll();
        $collection = array();
        $class = 'Models\\'.ucFirst($table);

        foreach($datas as $data){
            $class = new $class;
            $collection[] = $class->hydrate($data);
        }

        return $collection;
    }

    public function update(Array $params){
        $stmt = "UPDATE {$this->table} SET ";
        foreach($params as $key => $value){
            $method = 'set'.ucFirst($key);
            if(method_exists($this, $method)){
                $stmt .= "$key = '{$this->$method($value)}',";
            }
        }
        $stmt = rtrim($stmt, ',') . ' WHERE id = :id';
        $db = $this ->db->prepare($stmt);
        $db -> execute([
            "id" => $this->getId()
        ]);
        return $this;
    }

    public function destroy($id){
        $stmt = "DELETE FROM {$this->table} WHERE id = :id";
        $db = $this ->db->prepare($stmt);
        $db->execute([
            "id" => $id
        ]);
    }

    protected function hydrate($datas){
        foreach($datas as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
        return $this;
    }

    protected function mapParams(Array $params){
        $stmt = '';
        foreach($params as $key => $value){
            $method = 'set'.ucFirst($key);
            if(method_exists($this, $method)){
                $stmt .= strtolower("'{$this->$method($value)}',");
            }
        }
        return rtrim($stmt, ",");
    }

}