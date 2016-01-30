<?php
require('./lib/user_func.php');

$ActType = "";
$Key1 ="";
$Key2 ="";

$ActType = $_POST["ActionType"];
$Key1 = $_POST["KEYWORD1"];  //ID
$Key2 = $_POST["KEYWORD2"];  //パスワード

//DB問い合わせ
//全レコードを表示する処理
$result = UserModel::GETLogin($ActType, $Key1, $Key2, $dspUserLogin);
//画面表示
    if($dspUserInfo[1] == "管理者"){
        include("./admin/top.php");  
    }else{
        include("top.html");
    }
	
?>

