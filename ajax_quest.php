<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$db = new PDO('mysql:host=localhost;dbname=wall','root','');
$db->exec("SET NAMES UTF8");

//Какую таблицу читаем
$table = $_POST['table'];

$query = $db->prepare("SELECT * FROM $table");
$query->execute();

$apps = $query->fetchAll(PDO::FETCH_ASSOC);

//Вставляет HTML код разрыва строки перед каждым переводом строки
foreach ($apps as &$value) {
    $value['text'] = nl2br($value['text']);
}

$json = json_encode($apps);
//возвращаем таблицу
echo $json;
?>