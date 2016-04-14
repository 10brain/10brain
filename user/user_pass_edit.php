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
        if (!isPW($pass,10,4)){
                $result = 1;
                $nowPass_error = "内容に誤りがあります。再度入力してください。";
        }elseif($pass != $Key14){
                $result = 1;
                $nowPass_error = "登録されているパスワードと一致しません。再度入力してください。";
        }

        //新規パスワード確認
        if (!isPW($newpass,10,4)){
                $result = 1;
                $newPass_error = "内容に誤りがあります。再度入力してください。";
        }elseif($newpass == $Key14){
                $result = 1;
                $newPass_error = "現在使用しているパスワードとは別のパスワードを入力してください。";
        }

        //新規パスワード確認
        if (!isPW($newpass_conf,10,4)){
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
            include("user_pass_suc.html");
    }elseif($result == 1){
            include("user_pass_input.html");
            $db_error ="ユーザー情報がみつかりません。管理者に問い合わせてください";
    }else{
            include("user_pass_input.html");
            $db_error ="システムエラーです。開発者に連絡してください。";
    }

}else{
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }

include("user_pass_input.html");
}


?>
