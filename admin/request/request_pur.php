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
} 
    $obj=new otherModel();
    $result = $obj->GETRequestPur($ActType, $Key1, $dspRequestPur);

function mk_target_col($arrList, $target){ 		//指定した列を取り出す関数を定義
	$arrTarget = array();	//指定した列を格納する配列を用意
	foreach($arrList as $arrLine){ 		//ここから2次元配列のループ
		foreach($arrLine as $key => $value){ //ここから単純配列から特定のキーを取り出すループ
			if($key == $target){ //配列のキーが$target(関数の第２引数)と一致したら
				$arrTarget[] = $value; 	//$arrTargetに格納する
			} 
		} 
	}
	return $arrTarget;		//指定した列が格納された配列を返す
}

//関数の実行
$id = mk_target_col($dspRequestPur, "0");
print_r($id);

if ($result == 0){
    $conf = 'request_pur_conf.php';
    include("request_pur_input.html");

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
?>