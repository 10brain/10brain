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
    $Key0 = $_POST["KEYWORD0"];  //ID
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];
    $Key3 = $_POST["KEYWORD3"];  //パスワード

    //DB問い合わせ
    $obj=new userModel();
    $result = $obj->GETLogin($ActType, $Key1, $Key2, $dspUserInfo);

}

//画面表示
if ($result == 0){
    $request_0='request_edit.php';
    $request_pur='request_pur.php';
    $request_old='requestOld.php';
    include("request.html");

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


?>
