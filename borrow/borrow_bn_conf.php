<?php
require '../lib/book_func.php';
require '../lib/check.php';

$result=0;
$ActType = "";
$Key0 ="";
$Key1 ="";
$Key2 ="";
$Key3 ="";
$Key40 ="";
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


    /*echo $Key0;
    echo $Key1;
    echo $Key2;
    echo $Key3;*/

    $obj=new BookModel();
    $result = $obj->GETBorrowSearch($Key40, $dspBorrowS);



    if($result==0){
        //echo $result;
        $borrow_bN = $dspBorrowS[0];
        $borrow_ti = $dspBorrowS[1];
        $borrow_st = $dspBorrowS[3];

        $cover = $dspBorrowS[6];
        if(!is_null($cover)){
        $cover = '/admin/book_add/tmp_cover/'.$cover;
        }else{
         $cover = '/admin/book_add/tmp_cover/noimage.png';
        }
        
        if($borrow_st == 1){
            $borrow_conf = 'borrow_conf.php';
            include("borrow_day_input.html");
        }elseif($borrow_st == 0){
             $borrow_bn_conf = 'borrow.php';
             $booknum_error = 'すでに貸し出されています。';
             include("borrow_bn_input.html");
        }else{
             $borrow_bn_conf = 'borrow.php';
             $booknum_error = '該当する書籍がありません。もう一度入力してください。';
             include("borrow_bn_input.html");
        }
    }elseif($result==1){
             $booknum_error = 'すでに貸し出されているか、該当する本がありません。';
             include("borrow_bn_input.html");
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
