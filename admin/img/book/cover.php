<?php
require '../lib/user_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Key3 ="";

//IDとパスワードチェック
if (!isID($_POST["KEYWORD1"],40,1)){
    $result = 1;
}elseif (!isPW($_POST["KEYWORD2"],10,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key0 = $_POST["KEYWORD0"];  //社員番号
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Key3 = $_POST["KEYWORD3"];  //名前
}
$cover_add = 'cover_add.php';
$isbn = $_POST['KEYWORD24'];//ISBN
?>
