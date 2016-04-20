<?php
require '../lib/book_func.php';
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
    $Key40 = $_POST["KEYWORD40"];  //貸出番号
    $Key20 = $_POST["KEYWORD20"];  //書籍番号
    $Key3 = $_POST["KEYWORD3"];  //名前
    $obj=new BookModel();
    //borrow返却処理
    $result = $obj->GETReturnU($ActType, $Key0, $Key40);
    if($result==0){
        //borrowへの処理が成功したら
        $obj=new BookModel();
        $result = $obj->GETStockAdd($ActType, $Key20);
    }

//画面表示
if ($result == 0){
    include("return_suc.html");
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }elseif ($result == 5){
	$error = "返却できませんでした。再度確認してください";
        include 'return_input.html';

    }else{
	$error = "ただいまサーバーが込み合っております。";
    }
    
include("/login/login.html");
}

}    
	
?>


