<?php
$db = require('database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$table = $_POST['table'];

//возвращаем таблицу
echo $db->getAll($table);
?>