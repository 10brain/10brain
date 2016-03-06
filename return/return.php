<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key0 ="";
$Key1 ="";
$Key2 ="";
$Key21 = "";
$Key22 = "";

//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key0 = $_POST["KEYWORD0"];  //社員番号
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Name = $_POST["KEYWORD3"];  //名前

    //貸出一覧確認
    $obj=new BookModel();
    //入力された情報の確認
    $result = $obj->GETBorrowUList($ActType, $Key0, $dspBorrowUList);


//画面表示
if ($result == 0){
    $return='./return_conf.php';
    include("return_input.html");
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }
    
include("../login.html");
}

}    
	
?>


