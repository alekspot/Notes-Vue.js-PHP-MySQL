<?php
$db = require_once('database.php');
$_POST = json_decode(file_get_contents('php://input'), true);

//В какую таблицу добавляем запись
$table = $_POST['table'];
// $imges = '';
$postId = $_POST['postId'];
$text = $_POST['text'];

//Сохранение картинок в папку
$db->update($table,$text,$postId);

?>