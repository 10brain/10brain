<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key0 ="";
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

    //DB問い合わせ
    $obj=new BookModel();
    //入力された情報の確認
    $result = $obj->GETBorrowUList($ActType, $Key0, $dspBorrowUList);
        $i = 0;
    while(!is_null($dspBorrowUList[$i][0])){
        if($dspBorrowUList[$i][3] == null){
            $null[] = $dspBorrowUList[$i][3];
        }
        if(strtotime(date('Y-m-d'))>strtotime($dspBorrowUList[$i][2]) and $dspBorrowUList[$i][3] == null){
            $return[] = $dspBorrowUList[$i][2];
        }

        $i++;
    }

    $null = count($null);
}

//画面表示
if ($result == 0){
    
    if($null >= 3){
        include("borrow_not.html");
    }elseif(!is_null($return)){
        include("borrow_not2.html");
    }else{
    $borrow_bn_conf = 'borrow_bn_conf.php';
    include("borrow_bn_input.html");
    }
}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }

include("../login/login.html");
}



?>
