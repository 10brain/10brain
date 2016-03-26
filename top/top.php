<?php
require '../lib/other_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";

///^[a-zA-Z0-9!$&*.=^`|~#%'+\/?_{}-]+@([a-zA-Z0-9_-]+\.)+[a-zA-Z]{2,6}$/
//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード

    //DB問い合わせ
    $obj=new otherModel();
    $result = $obj->GETTopLogin($ActType, $Key1, $Key2, $dspUserInfo, $dspBookNewList);
    $Key3 = $dspUserInfo[1];
    $Key0 = $dspUserInfo[0];
}

//画面表示
if ($result == 0){
    //管理者か一般ユーザーか判定
    if($dspUserInfo[1]=='管理者'){
        include("../admin/top/top.html");
    }else{        
        include("../top/top.html");
    }
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
