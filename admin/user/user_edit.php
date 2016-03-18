<?php
/******************************************************************************/
// ユーザー登録
// 20160210@ito
//
//
//
/******************************************************************************/
require '../../lib/user_func.php';
require '../../lib/check.php';

// ライブラリファイルの読み込み
$lib_path = "../../lib/";

require($lib_path."class.IO.php");
require($lib_path."class.Form.Check.php");
require($lib_path."class.Validation.php");
require($lib_path."class.Form.Radio.php");

$result = 0;
$ActType = "";
$Key0 ="";
$Key1 ="";
$Key2 ="";
$Key12 ="";
$Key13 ="";
$Key14 ="";
$Key15 ="";
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
    $Key0 = $_POST["KEYWORD0"];  //社員番号
    $Key12 = $_POST["KEYWORD12"];//社員番号
    $Key13 = $_POST["KEYWORD13"];//ID
    $Key14 = $_POST["KEYWORD14"];//名前
    $Key15 = $_POST["KEYWORD15"];
    

    // 内部文字コード
    define("INNER_CODE", "UTF-8");
    define("HTML_CODE", "UTF-8");

    // テンプレート系ファイルの指定
    define("TEMP_AGREE",   "user_edit_input.html");
    define("TEMP_INPUT",   "user_edit_input.html");
    define("TEMP_ERROR",   "user_edit_input.html");
    define("TEMP_CONFIRM", "user_edit_confirm.html");
    define("TEMP_BLOCK",   "../../login.html");

    //登録後のページ遷移指定
    define("HTML_SUCCESS", "./user_edit_suc.html");
    define("HTML_FAILURE", "./user_edit_fal.html");

    // url系情報の指定
    // CHECK_REFERER  非ブランクなら、フォーム内でリファラチェックを行う。初期アクセスではこの値を含むか、以降はフォーム内の遷移かをチェックする。
    // SALESFORCE     非ブランクなら、確認画面からのリンク先をこの値に変更する。ブランクなら、内部の登録処理へ進む。
    define("MY_NAME",        basename($_SERVER["SCRIPT_NAME"]));
    define("MY_PATH",        dirname($_SERVER["SCRIPT_NAME"])."/");
    define("URL_ACTION",     "http://".$_SERVER["SERVER_NAME"].MY_PATH.MY_NAME);
    define("URL_SUCCESS",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_SUCCESS);
    define("URL_FAILURE",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_FAILURE);
    define("CHECK_REFERER",  ""); //
    define("PASS",  "1:初期化");       
   
    // 入出力インスタンスの生成
    $io = new IO(HTML_CODE, HTML_CODE, INNER_CODE, "step_from,x,y", KEY);
    $io->set_parameters($_POST);
    $pass = new Check("pass", PASS, $io);


    if($io->is_not_falsification()){
            // 登録処理 ================================================================
            if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){
                    $decision=true;
                    // csvファイルの作成 -----------------------------------------------------
                    // 通し番号とユニークなファイル名を取得
            /*	$fp = fopen(CSV_PATH.CSV_COUNT, "r+");
                    if($fp)
                    {
                            if(flock($fp, LOCK_EX))
                            {
                                    $count = fgets($fp, 5);
                                    if($count == "9999")
                                    {
                                            $count = "0001";
                                    }
                                    else
                                    {
                                            $count = sprintf("%04d", $count + 1);
                                    }
                                    rewind($fp);
                                    fputs($fp, $count);
                                    flock($fp, LOCK_UN);
                            }

                            do
                            {
                                    $csv_name = CSV_NAME;
                                    $csv_name = preg_replace("/YMD/", date("Ymd"), $csv_name);
                                    $csv_name = preg_replace("/HMS/", date("His"), $csv_name);
                            }
                            while(file_exists(CSV_PATH.$csv_name));

                            fclose($fp);
                    }
                    // パラメータをcsv用に加工
                    $io->set_parameter("csv_date", date("Ymd"));
                    $io->set_parameter("csv_count", $count);

                    $radio1 = new Radio ("radio1", LIST_RADIO1A.",".LIST_RADIO1B.",".LIST_RADIO1C, $io);
                    if($io->get_param("radio1") == "5")
                    {
                            $io->set_parameter("csv_radio1", "1");
                            $io->set_parameter("csv_description", $radio1->get_checked_text_main(false)."　".$io->get_param("description"));
                    }
                    else
                    {
                            $io->set_parameter("csv_radio1", $io->get_param("radio1"));
                            $io->set_parameter("csv_description", $io->get_param("description"));
                    }
                    $io->set_parameter("csv_radio3s", $radio3->get_checked_text_sub(false));
                    $io->set_parameter("csv_zip", preg_replace("/\-/", "", $io->get_param("zip")));


                    // csvファイルの作成
                    $csv = new CSV($io, CSV_PATH, $csv_name, "SJIS");
                    $result = $csv->write(CSV_TEMP);
                    // フラグファイル(?)作成
                    if($result){
                            touch(preg_replace("/\.csv/", "-F", CSV_PATH.$csv_name));
                    }
                    // csvファイルの作成(予備)
                    $csv = new CSV($io, CSV_PATH_BK, $csv_name, "SJIS");
                    $result = $csv->write(CSV_TEMP);
                    */

                    // 完了画面 --------------------------------------------------------------
                    if($decision){
                            $vali = new Validation();
                            $Key13 = $io->get_param_sql("Name");
                            $Key14 = $io->get_param_sql("ID");
                            
                            if($Key15 == '初期化する'){
                                $Key15 = '9999';
                            }else{
                                $Key15 = '';
                            }

                            //データベース更新
                            $obj = new UserModel();
                            //ID確認
                            $result = $obj->GETUserEdit($ActType, $Key1, $Key12, $Key13, $Key14, $Key15);
                            if($result == 0){
                                include(HTML_SUCCESS); 
                            }else{
                                $db_error = 'システムエラーです。開発者に連絡してください。';
                                include(HTML_FAILURE);
                            }
                    }else{
                            //pg_query($conID, "rollback");
                            // 失敗画面
                            //処理どうし→登録に失敗
                            $error = 'もう一度登録してください';
                            include(HTML_FAILURE);
                    }
            }else{
                    // リファラ制限画面
                    $re = 'もう一度ログインしてから再度編集してください';
                    include(HTML_FAILURE);
            }

    }else if($io->get_param("step_from") == "input"){
            // 確認処理 ================================================================
            if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){	
                    $vali = new Validation();

                    // 名前
                    $io->set_parameter("Name", mb_convert_kana($io->get_param("Name"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("Name"), true, 30, 0, "UTF-8")){
                        $io->set_error("Name_error", "未入力、または内容に誤りが有ります");
                    }

                    //ID
                    $io->set_parameter("ID", mb_convert_kana($io->get_param("ID"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("ID"), true, 40, 0, "UTF-8")){
                        $io->set_error("ID_error", "未入力、または内容に誤りが有ります");
                    }
                    if($pass->is_regularly(1, 1)){
                        $Key15 = '初期化する';
                    }else{
                        $Key15 = '初期化しない';
                    }

                    if(!$io->is_error()){
                        //$io->unset_parameter("agree_0");
                        $decision=true;
                            // 登録確認画面
                            $io->create_hash();
                            include(TEMP_CONFIRM);
                    }else{
                            // 入力エラー画面
                            include(TEMP_ERROR);
                    }

            }else{
                    // リファラ制限画面
                    include(TEMP_BLOCK);
            }

    }else if($io->get_param("step_from") == "agree"){
            // 入力画面 ================================================================
            if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){	
               

                include(TEMP_INPUT);
                    
            }else{
                    // リファラ制限画面
                    include(TEMP_BLOCK);
            }

    }else{
            // 同意画面 ================================================================
            if(CHECK_REFERER == "" or strpos($_SERVER["HTTP_REFERER"], CHECK_REFERER) !== false){	
                    // GETパラメータ(sp)を取得
                    $io->set_parameters($_GET);
                    $io->set_parameter("Name", $Key14);
                    $io->set_parameter("ID", $Key13);

                    include(TEMP_AGREE);
            }else{
                    // リファラ制限画面
                    include(TEMP_BLOCK);
            }
    }
}

?>





