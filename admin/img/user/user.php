<?php
require '../../lib/user_func.php';
require '../../lib/check.php';

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
    $Key0 = $_POST["KEYWORD0"];  //パスワード
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];
    $Key3 = $_POST["KEYWORD3"];  //パスワード
    $Key12 = $_POST["KEYWORD12"];//社員番号
    $Key13 = $_POST["KEYWORD13"];//ID
    $Key14 = $_POST["KEYWORD14"];//名前
    
   //echo $Key12;
   //echo $Key13;

    //DB問い合わせ
    $obj=new UserModel();
    $result = $obj->GETUserDetail($ActType, $Key12, $Key13, $dspUserDet);

//画面表示
if ($result == 0){
    $user_edit = 'user_edit.php';
    include("user.html");
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }

include("../../login.html");
}
}


?>
