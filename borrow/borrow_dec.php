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
    $Key40 = $_POST['KEYWORD40'];//書籍番号
    $Key42 = $_POST['KEYWORD42'];//返却日
    /*echo $Key0;
    echo $Key1;
    echo $Key2;
    echo $Key3;*/
    //echo $Key42;


    if($result==0){
       $obj=new BookModel();
       $result = $obj->GETBorrowAdd($ActType, $Key0, $Key40, $Key42);
        if($result==0){
            //データベース更新
           $obj=new BookModel();
            $result = $obj->GETStock($ActType, $Key0, $Key40);
            if($result==0){
                    //DB問い合わせ

                $result = $obj->GETTopLogin($ActType, $Key1, $Key2, $dspUserInfo, $dspBookNewList);
                $Key3 = $dspUserInfo[1];
                $Key0 = $dspUserInfo[0];

              include('../top/top.html'); 
            }else{
              include('borrow_fal.html');
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

        include("../login/login.html");
    }
}


?>
