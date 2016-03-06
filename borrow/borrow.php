<?php
/******************************************************************************/
// 貸出登録
// 20160210@ito
//
//
//
/******************************************************************************/
require '../lib/book_func.php';
require '../lib/check.php';

// ライブラリファイルの読み込み
$lib_path = "../lib/";

require($lib_path."class.IO.php");
require($lib_path."class.Form.Check.php");
require($lib_path."class.Validation.php");

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";

///^[a-zA-Z0-9!$&*.=^`|~#%'+\/?_{}-]+@([a-zA-Z0-9_-]+\.)+[a-zA-Z]{2,6}$/
//IDとパスワードチェック
if (!ckStr($_POST["KEYWORD1"],30,1) or ereg("^[a-zA-Z0-9]+$",$_POST["KEYWORD1"])){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key0 = $_POST["KEYWORD0"];  //ID
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key0 = $_POST['KEYWORD0'];
    $Key3 = $_POST['KEYWORD3'];

//貸出冊数確認
$obj=new BookModel();
//入力された情報の確認
$result = $obj->GETBorrowUList($ActType, $Key0, $dspBorrowUList);


    if(count($dspBorrowUList[0])<=3){
        include 'borrow_not.html';
    }else{

            // 内部文字コード
            define("INNER_CODE", "UTF-8");
            define("HTML_CODE", "UTF-8");

            // テンプレート系ファイルの指定
            define("TEMP_AGREE",   "borrow_input.html");
            define("TEMP_INPUT",   "borrow_input.html");
            define("TEMP_ERROR",   "borrow_input.html");
            define("TEMP_CONFIRM", "borrow_confirm.html");
            define("TEMP_BLOCK",   "../login.html");

            //登録後のページ遷移指定
            define("HTML_SUCCESS", "./borrow_suc.html");
            define("HTML_FAILURE", "./borrow_fal.html");

            // url系情報の指定
            // CHECK_REFERER  非ブランクなら、フォーム内でリファラチェックを行う。初期アクセスではこの値を含むか、以降はフォーム内の遷移かをチェックする。
            // SALESFORCE     非ブランクなら、確認画面からのリンク先をこの値に変更する。ブランクなら、内部の登録処理へ進む。
            define("MY_NAME",        basename($_SERVER["SCRIPT_NAME"]));
            define("MY_PATH",        dirname($_SERVER["SCRIPT_NAME"])."/");
            define("URL_ACTION",     "http://".$_SERVER["SERVER_NAME"].MY_PATH.MY_NAME);
            define("URL_SUCCESS",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_SUCCESS);
            define("URL_FAILURE",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_FAILURE);
            define("CHECK_REFERER",  ""); //

            // 入出力インスタンスの生成
            $io = new IO(HTML_CODE, HTML_CODE, INNER_CODE, "step_from,x,y", KEY);
            $io->set_parameters($_POST);




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
                                $vali = new Validation();
                                $Key40=$io->get_param_sql("isbn");
                                $Key41=$io->get_param_sql("bookNum");
                                $Key42=$io->get_param_sql("plan");
                                //データベース更新
                                $obj=new BookModel();
                                //入力された情報の確認
                                $result = $obj->GETBorrowSearch($ActType, $Key40, $Key41, $dspTest);
                                if($result == 6){
                                     $db_error ='入力された情報に該当する書籍情報はありませんでした。';
                                    include(TEMP_INPUT);
                                }elseif($result==9){
                                     $db_error ='既に在庫が無い為、貸出すことができません。';
                                    include(TEMP_INPUT);  
                                }elseif($result == 0){
                                    //データベース更新
                                   $obj=new BookModel();
                                    //ID確認
                                    $result = $obj->GETBorrowAdd($ActType, $Key0, $Key40, $Key41, $Key42);
                                    if($result==0){
                                        //データベース更新
                                       $obj=new BookModel();
                                        //ID確認
                                        $result = $obj->GETStock($ActType, $Key0, $Key40, $Key41);
                                        if($result==0){
                                          include(HTML_SUCCESS); 
                                        }else{
                                          include(HTML_FAILURE);
                                        }
                                    }
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

           }else if($io->get_param("step_from") == "input"){
                // 確認処理 ================================================================
                if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){	
                        $vali = new Validation();

                            //isbn
                            $io->set_parameter("isbn", mb_convert_kana($io->get_param("isbn"), "KV", INNER_CODE));
                            if(!$vali->isString($io->get_param("isbn"), true, 14, 0, "UTF-8")){
                                    $io->set_error("isbn_error", "未入力、または内容に誤りが有ります");
                            }

                            //書籍番号
                            $io->set_parameter("bookNum", mb_convert_kana($io->get_param("bookNum"), "KV", INNER_CODE));
                            if(!$vali->isString($io->get_param("bookNum"), true, 14, 0, "UTF-8")){
                                    $io->set_error("bookNum_error", "未入力、または内容に誤りが有ります");
                            }

                            //返却予定
                            $io->set_parameter("plan", mb_convert_kana($io->get_param("plan"), "KV", INNER_CODE));
                            if(!$vali->isString($io->get_param("plan"), true, 8, 0, "UTF-8")){
                                    $io->set_error("plan_error", "未入力、または内容に誤りが有ります");
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


                        include(TEMP_AGREE);
                }else{
                        // リファラ制限画面
                        include(TEMP_BLOCK);
                }
        }
    }
}
?>



