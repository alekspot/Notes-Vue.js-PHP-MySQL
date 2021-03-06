<?php 
$config = [
    'host'=>'localhost',
    'db_name' => 'wall',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8'
];
Class Database {
    private $link;
    public function __construct(){
        $this->connect();
    }

    private function connect(){
        //$config = require_once 'config.php';
        global $config;
        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];
        $this->link = new PDO($dsn, $config['username'], $config['password']);
        return $this;
    }
    
    public function execute($sql){
        $sth = $this->link->prepare($sql);
        return $sth->execute();
    }

    public function query($sql){
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($result === false) {
            return [];
        }

        return $result;
    }
    /******************************************/
    public function insert($table,$text,$imges){
        $sth = $this->link->prepare("INSERT INTO $table SET text=:text, img=:img");
        $values = ['text' => $text,'img'=> $imges];
        return $sth->execute($values);
    }

    public function update($table,$text,$id){
        $sth = $this->link->prepare("UPDATE $table SET text=:text WHERE id=:id");
        $values = ['text' => $text,'id'=>$id];
        return $sth->execute($values);
    }
    public function delete($table,$id){
        $sth = $this->link->prepare("DELETE FROM $table WHERE id =$id");
        return $sth->execute();
    }
    public function getAll($table){
        $sth = $this->link->prepare("SELECT * FROM $table");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($result === false) {
            return [];
        }
        //Изменить порядок
        $newArr = array_reverse($result);
        $json = json_encode($newArr);
        return $json;
    }
}

$db = new Database();
return $db;
