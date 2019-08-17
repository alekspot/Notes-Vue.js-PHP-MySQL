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

    public function update($table,$text,$imges,$id){
        $sth = $this->link->prepare("UPDATE $table SET text=:text, img=:img WHERE id=:id");
        $values = ['text' => $text,'img'=> $imges,'id'=>$id];
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
        foreach ($result as &$value) {
            $value['text'] = nl2br($value['text']);
        }
        //Изменить порядок
        $newArr = array_reverse($result);
        $json = json_encode($newArr);
        return $json;
    }
}

$db = new Database();
return $db;
//$db->execute("UPDATE `books` SET `text`='newAss' WHERE id =81");
//$db->insert("INSERT INTO `books` SET text=:text, img=:img",['text'=>'SashaPotkin','img'=> '.png']);
//$db->insert('code','testtt','');
//$db->delete('code',79);