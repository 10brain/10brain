<?php
require '../lib/user_func.php';
require '../lib/check.php';

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Key3 ="";
$Key14 ="";
$pass ="";
$newpass ="";
$newpass_conf ="";
$nowPass_error ="";
$newPass_error ="";
$newPassc_error ="";

///^[a-zA-Z0-9!$&*.=^`|~#%'+\/?_{}-]+@([a-zA-Z0-9_-]+\.)+[a-zA-Z]{2,6}$/
//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Key3 = $_POST["KEYWORD3"];  //パスワード
    $Key14 =$_POST['KEYWORD14']; //登録されているPW

    $pass = $_POST["pass"];  //入力された現行パスワード
    $newpass = $_POST["newpass"];  //入力された新規パスワード
    $newpass_conf = $_POST["newpass_conf"];  //入力された確認用新規パスワード

}

    //DB問い合わせ
    //$obj=new UserModel();
    //$result = $obj->GETLogin($ActType, $Key1, $Key2, $dspUserInfo);


        //現行パス確認
        if (!ckStr($pass,10,1) or !preg_match("/^[a-zA-Z0-9]+$/",$pass)){
                $result = 1;
                $nowPass_error = "内容に誤りがあります。再度入力してください。";
        }elseif($pass != $Key14){
                $result = 1;
                $nowPass_error = "登録されているパスワードと一致しません。再度入力してください。";
        }

        //新規パスワード確認
        if (!ckStr($newpass,10,1) or !preg_match("/^[a-zA-Z0-9]+$/", $newpass)){
                $result = 1;
                $newPass_error = "内容に誤りがあります。再度入力してください。";
        }elseif($newpass == $Key14){
                $result = 1;
                $newPass_error = "現在使用しているパスワードとは別のパスワードを入力してください。";
        }

        //新規パスワード確認
        if (!ckStr($newpass_conf,10,1) or !preg_match("/^[a-zA-Z0-9]+$/",$newpass_conf)){
                $result = 1;
                $newPassc_error = "内容に誤りがあります。再度入力してください。";
        }elseif($newpass != $newpass_conf){
                $result = 1;
                $newPassc_error = "入力された新規パスワードと一致しません。再度入力してください。";
        }




//画面表示
if ($result == 0){
    $obj=new UserModel();
    $result = $obj->GETUserPassEdit($ActType, $Key1, $Key2, $newpass);
    if($result == 0){
            $passedit = "../index.php";
            $Key2=$newpass;
            include("user_pass_conf.html");
    }elseif($RetCode == 1){
            include("user_pass_input.html");
            $db_error ="指定された条件では情報が見つかりませんでした。<BR />ご指定に誤りがないか再度ご確認ください。";
    }else{
            include("user_pass_input.html");
            $db_error ="ただいまサーバーが込み合っております。<BR />時間をおいて再度入力してください。";
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


?>
