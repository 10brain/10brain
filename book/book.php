<?php
require '../lib/book_func.php';
require '../lib/check.php';

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
    $Key0 = $_POST["KEYWORD0"];  //社員番号
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Key3 = $_POST["KEYWORD3"];  //名前
    $Key20 = $_POST["KEYWORD20"];//書籍番号
    $Key21 = $_POST["KEYWORD21"];//ISBN
    $cover = $_POST['COVER'];
    
    if(!is_null($cover)){
    $cover = '../admin/book_add/tmp_cover/'.$cover.'.jpg';
    }else{
     $cover = '../admin/book_add/tmp_cover/noimage.png';
    }
    //DB問い合わせ
    $obj=new BookModel();
    $result = $obj->GETBookDetail($ActType, $Key20, $Key21, $dspBookDet);
//画面表示
if ($result == 0){
    $book = './book_conf.php';
    include("book.html");
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
