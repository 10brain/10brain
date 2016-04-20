<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Key3 ="";
$Key21 = "";
$Key22 = "";

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
    $Key21 = $_POST["KEYWORD21"];  //フリーワード
    $Key22 = $_POST["KEYWORD22"];  //and or

    //DB問い合わせ
    $obj=new BookModel();
    $result = $obj->GETBookList($ActType, $Key21, $Key22, $dspBookList);
    if($result==0){
        $i=0;
        while(!is_null($dspBookList[$i][5])){
            $Key24 = $dspBookList[$i][5];
            $obj=new BookModel();
            $result = $obj->GETCoverIsbn($ActType, $Key24, $dspCoverIsbn);
            if($result==0){
                 $cover[$i] = $dspCoverIsbn[1];
            }else{
                 include("search.html");
            }
            $i=$i+1;
        }
        
    }

}
//画面表示
if ($result == 0){

    include("search.html");
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
