<?php
require '../lib/user_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";

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
    $Key3 = $_POST["KEYWORD3"];  //パスワード

    //DB問い合わせ
    $obj=new UserModel();
    $result = $obj->GETLogin($ActType, $Key1, $Key2, $dspUserInfo);

}

//画面表示
if ($result == 0){
    include("user_pass_input.html");
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }

include("../login/login.html");
}


?>
