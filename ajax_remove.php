<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$db = new PDO('mysql:host=localhost;dbname=wall','root','');
$db->exec("SET NAMES UTF8");

//в какой таблице удалять
$table = $_POST['table'];
//индекс удаляемой строки
$postId = $_POST['postId'];

// проверить используется ли эта картинка в других постах
// передать картинку для удаления


//array_map('unlink', glob("some/dir/*.txt"));

$result = $db->query("SELECT img FROM $table WHERE id = $postId");
$imges = $result->fetch();

$query = $db->prepare("DELETE FROM $table WHERE id = $postId");
$query->execute();

//"DELETE FROM `notes` WHERE `notes`.`id` = 123"