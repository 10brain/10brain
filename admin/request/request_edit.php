<?php
/******************************************************************************/
// リクエスト承認登録
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

///^[a-zA-Z0-9!$&*.=^`|~#%'+\/?_{}-]+@([a-zA-Z0-9_-]+\.)+[a-zA-Z]{2,6}$/
//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}elseif (!ckStr($_POST["KEYWORD2"],30,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key0 = $_POST["KEYWORD0"];  //社員番号
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード
    $Key3 = $_POST["KEYWORD3"];  //名前
    $Key60 = explode("\t", $_POST["KEYWORD60"]);//リクエスト番号（配列）
    $Key61 = $_POST["app"];//承認却下
    echo $Key61;
    $obj=new otherModel();
    $result = $obj->GETRequest($ActType, $Key1, $dspRequest);
}


    // 内部文字コード
    define("INNER_CODE", "UTF-8");
    define("HTML_CODE", "UTF-8");

    // テンプレート系ファイルの指定
    define("TEMP_AGREE",   "request_edit_input.html");
    define("TEMP_INPUT",   "request_edit_input.html");
    define("TEMP_ERROR",   "request_edit_input.html");
    define("TEMP_BLOCK",   "/login/login.html");

    //登録後のページ遷移指定
    define("HTML_SUCCESS", "./request_edit_suc.html");
    define("HTML_FAILURE", "./request_edit_fal.html");

    // url系情報の指定
    // CHECK_REFERER  非ブランクなら、フォーム内でリファラチェックを行う。初期アクセスではこの値を含むか、以降はフォーム内の遷移かをチェックする。
    // SALESFORCE     非ブランクなら、確認画面からのリンク先をこの値に変更する。ブランクなら、内部の登録処理へ進む。
    define("MY_NAME",        basename($_SERVER["SCRIPT_NAME"]));
    define("MY_PATH",        dirname($_SERVER["SCRIPT_NAME"])."/");
    define("URL_ACTION",     "http://".$_SERVER["SERVER_NAME"].MY_PATH.MY_NAME);
    define("URL_SUCCESS",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_SUCCESS);
    define("URL_FAILURE",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_FAILURE);
    define("CHECK_REFERER",  ""); //
    
    //セレクトボックス
    define("LIST_APP", ":選択してください,1:承認,2:却下");


    // 入出力インスタンスの生成
    $io = new IO(HTML_CODE, HTML_CODE, INNER_CODE, "step_from,x,y", KEY);
    $io->set_parameters($_POST);
    $app = new Select("app", LIST_APP, $io);




    if($io->is_not_falsification()){
            // 登録処理 ================================================================
            if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){
                    $decision=true;


                    // 完了画面 --------------------------------------------------------------
                    if($decision){
                            $io->set_parameters($_GET);
                            $vali = new Validation();
                            //データベース更新
                            $obj=new otherModel();
                            //ID確認
                            $result = $obj->GETRequestAdd($ActType, $Key1, $Key60, $Key61);
                            if($result == 4){
                                $dbid_error ='ステータスが読み込みできません。再度入力してください';
                                include(TEMP_INPUT);
                            }elseif($result == 0){
                                    include(HTML_SUCCESS); 
                            }else{
                                $db_error ='システムエラーです。開発者に連絡してください。';
                                include(TEMP_INPUT);
                            }
                            

                    }else{
    //				pg_query($conID, "rollback");
                            // 失敗画面
                            //処理どうし→登録に失敗
                            include(HTML_FAILURE);
                    }
            }else{
                    // リファラ制限画面
                    include(TEMP_BLOCK);
            }



    }else{
            // 同意画面 ================================================================
            if(CHECK_REFERER == "" or strpos($_SERVER["HTTP_REFERER"], CHECK_REFERER) !== false){	
                    // GETパラメータ(sp)を取得
                    $io->set_parameters($_GET);


                    include(TEMP_AGREE);
            }else{
                    // リファラ制限画面
                    include(TEMP_BLOCK);
            }
    }


?>



