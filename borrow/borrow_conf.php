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
    $Key43 = $_POST['KEYWORD43'];//書籍タイトル



   if (!preg_match("/[0-9]$/", $Key40)){
        $bnum_error = "書籍番号が正しくありません。";
        $result = 4;
    }
    if(is_null($Key43)){
        $title_error = "書籍タイトルが正しくありません。";
        $result = 4;
    }
    if(!inpDate($Key42)){
        $day_error = "日付が正しくありません。";
        $result = 4;
    }else{
        switch (Key42) {
            case pastDate($Key42):
                $day_error = "過去の日付は入力できません。"; 
                $result = 4;
                break;
            case futureDate($Key42):
                $day_error = "2週間以内の日付を入力してください。"; 
                $result = 4;
                break; 
            default:
            	$result = 0;
                break;
        }
    }

    
    if($result==0){
        $borrow_dec = './borrow_dec.php';
        include './borrow_confirm.html';
    }elseif($result==4){
             $borrow_bn_conf = 'borrow_bn_conf.php';
             $booknum_error = $day_error;
             include("borrow_bn_input.html");
    }else{
        if ($_POST["ActionType"] != "TgRSPInf"){
            $error = "";
        }elseif ($result == 1){
            $error = "入力内容に誤りがあります。再度入力してください。";
        }else{
            $error = "ただいまサーバーが込み合っております。";
        }

        include("/login/login.html");
    }
}


?>
