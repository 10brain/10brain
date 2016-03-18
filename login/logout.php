<?php


$result = 0;
$ActType = "";
$Key0 ="";
$Key1 ="";
$Key2 ="";
$Key21 = "";
$Key22 = "";


//画面表示
if (is_null($Key0)){
    include("./login.html");
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }
    
include("./login.html");
}

 
	
?>


