<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Name ="";


//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Name = $_POST["KEYWORD3"];  //名前
    $Key20 = $_POST["KEYWORD20"];//書籍番号
    $Key21 = $_POST["KEYWORD21"];//ISBN
    echo $Key1;
        echo $Key2;
            echo $Key20;
    //DB問い合わせ
    $obj=new BookModel();
    $result = $obj->GETBookDetail($ActType, $Key20, $Key21, $dspBookDet);
//画面表示
if ($result == 0){
   //header('X-Content-Type-Options: nosniff');
   //sheader("Content-Type: image/jpeg");
    /*$base64 = base64_encode($dspBookDet[8]);
    $mime = 'image/jpg';
    return 'data:'.$mime.';base64,'.$base64;
*/
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
