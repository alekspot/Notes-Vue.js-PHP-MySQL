<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$db = new PDO('mysql:host=localhost;dbname=wall','root','');
$db->exec("SET NAMES UTF8");

//указали в какой таблице удалять
$table = $_POST['table'];
//указали индекс удаляемой строки
$postId = $_POST['postId'];


// $query1 = $db->prepare("SELECT img FROM $table WHERE id = $postId");
// $query1->execute();
// $img = $query1->fetchAll(PDO::FETCH_ASSOC);


$result = $db->query("SELECT img FROM $table WHERE id = $postId");
$imges = $result->fetch();

$query = $db->prepare("DELETE FROM $table WHERE id = $postId");
$query->execute();

//"DELETE FROM `notes` WHERE `notes`.`id` = 123"