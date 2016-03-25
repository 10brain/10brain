<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result=0;
$ActType = "";
$Key0 ="";
$Key1 ="";
$Key2 ="";
$Key3 ="";
$booknum_error = '';
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
    $Key3 = $_POST["KEYWORD3"];  //名前
    $Key40 = $_POST['KEYWORD40'];//書籍番号
    $Key42 = $_POST['KEYWORD42'];//返却日
    $Key43 = $_POST['KEYWORD43'];//書籍タイトル
    /*echo $Key0;
    echo $Key1;
    echo $Key2;
    echo $Key3;*/
    echo $Key0;
    echo $Key42;


    if($result==0){
           $obj=new BookModel();
           $result = $obj->GETBorrowAdd($ActType, $Key0, $Key40, $Key42);
        if($result==0){
            //データベース更新
            $obj=new BookModel();
            $result = $obj->GETStock($ActType, $Key0, $Key40);
            if($result==0){
              include('book_suc.html'); 
            }else{
              include('book_fal.html');
            }
            
        }

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
