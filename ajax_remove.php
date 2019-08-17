<?php
$db = require('database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$table = $_POST['table'];
$postId = $_POST['postId'];

$db->delete($table,$postId);


// проверить используется ли эта картинка в других постах
// передать картинку для удаления


//array_map('unlink', glob("some/dir/*.txt"));

// $result = $db->query("SELECT img FROM $table WHERE id = $postId");
// $imges = $result->fetch();

// $query = $db->prepare("DELETE FROM $table WHERE id = $postId");
// $query->execute();

//"DELETE FROM `notes` WHERE `notes`.`id` = 123"

