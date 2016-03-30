<?php
/******************************************************************************/
// リクエスト登録
// 20160210@ito
//
//
//
/******************************************************************************/
require '../../lib/other_func.php';
require '../../lib/check.php';

// ライブラリファイルの読み込み
$lib_path = "../../lib/";

require($lib_path."class.IO.php");
require($lib_path."class.Form.Check.php");
require($lib_path."class.Validation.php");
require($lib_path."class.Form.Select.php");

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";

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
    $reqnum = $_POST['reqnum'];
    print_r($reqnum);
    $app = $_POST['app'];
    print_r($app);
    /*$req = $_POST['req'];
    print_r($req['app']);
    print_r($req['num']);*/
    
}
    $obj = new otherModel();
    $result = $obj->GETReqApp($ActType, $app, $reqnum);


if ($result == 0){
    $conf = 'request_edit.php';
    include("request_edit_suc.html");

}else{
    
    if ($_POST["ActionType"] != "TgRSPInf"){
        $error = "";
        include("../../login/login.html");
    }elseif ($result == 1){
	$error = "入力内容に誤りがあります。再度入力してください。";
    }else{
	$error = "ただいまサーバーが込み合っております。";
    }
    include 'request_edit_fal.html';

}


?>

