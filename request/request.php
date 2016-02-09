<?php
// ライブラリファイルの読み込み
$lib_path = "../lib/";

require($lib_path."class.IO.php");
require($lib_path."class.Form.Check.php");
require($lib_path."class.Validation.php");

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";




// 内部文字コード
define("INNER_CODE", "UTF-8");


// テンプレート系ファイルの指定
define("TEMP_AGREE",   "request_input.html");
define("TEMP_INPUT",   "request_input.html");
define("TEMP_ERROR",   "request_inputt.html");
define("TEMP_CONFIRM", "request_confirm.html");
define("TEMP_BLOCK",   "../login.html");

//登録後のページ遷移指定
define("HTML_SUCCESS", "../top.php");
define("HTML_FAILURE", "../top.html");

// url系情報の指定
// CHECK_REFERER  非ブランクなら、フォーム内でリファラチェックを行う。初期アクセスではこの値を含むか、以降はフォーム内の遷移かをチェックする。
// SALESFORCE     非ブランクなら、確認画面からのリンク先をこの値に変更する。ブランクなら、内部の登録処理へ進む。
define("MY_NAME",        basename($_SERVER["SCRIPT_NAME"]));
define("MY_PATH",        dirname($_SERVER["SCRIPT_NAME"])."/");
define("URL_ACTION",     "https://".$_SERVER["SERVER_NAME"].MY_PATH.MY_NAME);
define("URL_SUCCESS",    "https://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_SUCCESS);
define("URL_FAILURE",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_FAILURE);
define("CHECK_REFERER",  ""); //



// 入出力インスタンスの生成
$io = new IO(HTML_CODE, HTML_CODE, INNER_CODE, "step_from,x,y", KEY);
$io->set_parameters($_POST);




if($io->is_not_falsification()){
        // 登録処理 ================================================================
        if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){
                $decision = true;

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
                if($result)
                {
                        touch(preg_replace("/\.csv/", "-F", CSV_PATH.$csv_name));
                }
                // csvファイルの作成(予備)
                $csv = new CSV($io, CSV_PATH_BK, $csv_name, "SJIS");
                $result = $csv->write(CSV_TEMP);
                */

                // 完了画面 --------------------------------------------------------------
                if($decision){
                        //データベース更新
                        //$RetCode = GetReportU($ActType, $Key1, $Key3, $Key20);
//				pg_query($conID, "commit");

                }else{
//				pg_query($conID, "rollback");
                        // 失敗画面
                        //処理どうしよう
                }
        }else{
                // リファラ制限画面
                include(TEMP_BLOCK);
        }

}else if($io->get_param("step_from") == "input"){
        // 確認処理 ================================================================
        if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){	
                $vali = new Validation();



                // 書籍番号
                $io->set_parameter("last_name", mb_convert_kana($io->get_param("last_name"), "KV", INNER_CODE));
                $io->set_parameter("first_name", mb_convert_kana($io->get_param("first_name"), "KV", INNER_CODE));
                if(!$vali->isString($io->get_param("last_name"), true, 40, 0, "SJIS") || !$vali->isString($io->get_param("first_name"), true, 40, 0, "SJIS")){
                        $io->set_error("name", "未入力、または内容に誤りが有ります");
                }

                // ＊メールアドレス (email)
                $io->set_parameter("email", mb_convert_kana($io->get_param("email"), "rnas", INNER_CODE));
                if(!$vali->isMail($io->get_param("email"), true) || !$vali->isString($io->get_param("email"), true, 80, 0, "SJIS")){
                        $io->set_error("email", "未入力、または内容に誤りが有ります");
                }

                // ＊申込み確認 (agree_0)
                if(!$agree_0->is_regularly(1, 1)){
                        $io->set_error("agree_0", "確認後、レ点にチェックください。");
                }

                if(!$io->is_error()){
                        //$io->unset_parameter("agree_0");

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
                $io->set_parameter("owner", "私は委託約定書・確認書の内容を了解し、次の内容で株式会社リロケーション・インターナショナルに賃貸管理委託を申し込みます。");



                //初期値設定
                // テスト時の入力が面倒なので初期値設定（本番時は消すこと）
/*
                $radio1->value = "1";
                $io->set_parameter("last_name", "理路");
                $io->set_parameter("first_name", "太郎");
                $io->set_parameter("last_kana", "リロ");
                $io->set_parameter("first_kana", "タロウ");
                $io->set_parameter("email", "jnakayama@relo.jp");
                $io->set_parameter("tel", "00-0000-0000");
                $radio2->value = "1";

                $add1->value = "01";
                $io->set_parameter("add2", "新宿区");
                $io->set_parameter("add5", "新宿四丁目3番25号　TOKYU REIT 新宿ビル3階");
                $radio4->value = "3";
                $radio5->value = "1";
                $year->value = "1950";
                $area->value = "30";
                $io->set_parameter("description", "ああああああああああああああああああああ\nええええええええええええええええええええ\nおおおおおおおおおおおおおおおおおおおお");

                $agree_0->set_values("1");
*/
                // テスト時の入力が面倒なので初期値設定（本番時は消すこと）

                include(TEMP_AGREE);
        }else{
                // リファラ制限画面
                include(TEMP_BLOCK);
        }
}

?>



