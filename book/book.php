<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Key3 ="";


//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Key3 = $_POST["KEYWORD3"];  //名前
    $Key20 = $_POST["KEYWORD20"];//書籍番号
    $Key21 = $_POST["KEYWORD21"];//ISBN
    $cover = $_POST['COVER'];
    echo $Key1;
        echo $Key2;
            echo $Key20;
    $cover = '/10brain/admin/book_add/tmp_cover/'.$cover;
    //DB問い合わせ
    $obj=new BookModel();
    $result = $obj->GETBookDetail($ActType, $Key20, $Key21, $dspBookDet);
//画面表示
if ($result == 0){
  
    include("book.html");
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }

include("login.html");
}
}


?>
