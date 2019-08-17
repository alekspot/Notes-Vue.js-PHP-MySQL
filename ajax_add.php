<?php
$db = require_once('database.php');

//В какую таблицу добавляем запись
$table = $_POST['table'];
$imges = '';

//Сохранение картинок в папку
foreach ($_FILES["pictures"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
        // basename() может спасти от атак на файловую систему;
        // может понадобиться дополнительная проверка/очистка имени файла
        $img = basename($_FILES["pictures"]["name"][$key]);
        $imges .= $img . ':';
        move_uploaded_file($tmp_name, "uploads/$img");
    }
}
$imges = substr($imges, 0, -1);
$text = strip_tags($_POST['msg']);

//если было что-то передано добавляем в бд
if($text!=="" || $imges!==""){
    $db->insert($table,$text,$imges);
}

//Строки кода которые могут пригодиться:

//$_POST = json_decode(file_get_contents('php://input'), true);
//$text = htmlentities($_POST['msg'], ENT_QUOTES, "UTF-8");
//$text = htmlspecialchars($_POST['msg'], ENT_QUOTES);
?>