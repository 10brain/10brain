<?php
/******************************************************************************/
// 書籍登録
// 20160210@ito
//
//
//
/******************************************************************************/
require '../../lib/book_func.php';
require '../../lib/check.php';

// ライブラリファイルの読み込み
$lib_path = "../../lib/";

require($lib_path."class.IO.php");
require($lib_path."class.Form.Check.php");
require($lib_path."class.Validation.php");
//header('Content-type: image/jpeg');
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
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];  //パスワード

    

    
    // 内部文字コード
    define("INNER_CODE", "UTF-8");
    define("HTML_CODE", "UTF-8");

    // テンプレート系ファイルの指定
    define("TEMP_AGREE",   "badd_input.html");
    define("TEMP_INPUT",   "badd_input.html");
    define("TEMP_ERROR",   "badd_input.html");
    define("TEMP_CONFIRM", "badd_confirm.html");
    define("TEMP_BLOCK",   "../../login.html");

    //登録後のページ遷移指定
    define("HTML_SUCCESS", "./badd_suc.html");
    define("HTML_FAILURE", "./badd_fal.html");

    // url系情報の指定
    // CHECK_REFERER  非ブランクなら、フォーム内でリファラチェックを行う。初期アクセスではこの値を含むか、以降はフォーム内の遷移かをチェックする。
    // SALESFORCE     非ブランクなら、確認画面からのリンク先をこの値に変更する。ブランクなら、内部の登録処理へ進む。
    define("MY_NAME",       basename($_SERVER["SCRIPT_NAME"]));
    define("MY_PATH",       dirname($_SERVER["SCRIPT_NAME"])."/");
    define("URL_ACTION",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.MY_NAME);
    define("URL_SUCCESS",   "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_SUCCESS);
    define("URL_FAILURE",   "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_FAILURE);
    define("CHECK_REFERER",  ""); //



    // 入出力インスタンスの生成
    $io = new IO(HTML_CODE, HTML_CODE, INNER_CODE, "step_from,x,y", KEY);
    $io->set_parameters($_POST);


    if($io->get_param("step_from") == "conf"){
        // 登録処理 =============================================================
        if(CHECK_REFERER == "" or $_SERVER["HTTP_REFERER"] == URL_ACTION){
            $decision = true;
            // csvファイルの作成 -------------------------------------------------
            // 通し番号とユニークなファイル名を取得
            /*$fp = fopen(CSV_PATH.CSV_COUNT, "r+");
                if($fp){
                    if(flock($fp, LOCK_EX)){
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

                        do{
                                $csv_name = CSV_NAME;
                                $csv_name = preg_replace("/YMD/", date("Ymd"), $csv_name);
                                $csv_name = preg_replace("/HMS/", date("His"), $csv_name);
                        }
                        while(file_exists(CSV_PATH.$csv_name));

                        fclose($fp);
                }
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
                    if(isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {
                        if(is_uploaded_file($_FILES["upfile"]["tmp_name"])){
                            if(move_uploaded_file($_FILES["upfile"]["tmp_name"], "tmp_cover/" . $_FILES["upfile"]["name"])) {
                                chmod("tmp_cover/" .$_FILES["upfile"]["name"], 0644);
                                echo $_FILES["upfile"]["name"] . "をアップロードしました。";
                                $Key33 = $_FILES['upfile']['name'];
                                $Key34 = $_FILES['upfile']['type'];
                                $Key35 = "./tmp_cover/".$_FILES['upfile']['name'];
                                $Key35 = file_get_contents($Key35);

                              }else{
                                echo "ファイルをアップロードできません。";
                              }
                        }else{
                           echo "ファイルが選択されていません。";
                        }
                    }

                        $vali = new Validation();
                        
                        $Key24 = $_POST['KEYWORD60'];
                        $Key25 = $_POST['KEYWORD61'];
                        $Key26 = $_POST['KEYWORD62'];
                        $Key27 = $_POST['KEYWORD63'];
                        $Key28 = $_POST['KEYWORD64'];
                        $Key29 = $_POST['KEYWORD65'];
                        $Key30 = $_POST['KEYWORD66'];
                        $Key31 = $_POST['KEYWORD67'];
                        $Key32 = $_POST['KEYWORD68'];
                        
                        //データベース更新
                        $obj = new BookModel();
                        
                        //ID確認
                        $result = $obj->GETBookAdd($ActType, $Key1, $Key24, $Key25, $Key26, $Key27, $Key28, $Key29, $Key30, $Key31, $Key32);

                        if($result == 0){
                            //データベース更新
                            $obj = new BookModel();
                            //ID確認
                            $result = $obj->GETCoverAdd($ActType, $Key1, $Key24, $Key33, $Key34, $Key35);
                            if($result == 0){
                                include(HTML_SUCCESS);
                            }else{
                                echo '画像：'.$Key33;
                                $db_error = 'システムエラーです。開発者に連絡してください。';
                                include(TEMP_INPUT); 
                            }
                        }else{
                            $db_error = 'システムエラーです。開発者に連絡してください。';
                            include(TEMP_INPUT);
                        }
                            
                   }else{
                        //pg_query($conID, "rollback");
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

                    // ISBN
                    $io->set_parameter("isbn", mb_convert_kana($io->get_param("isbn"), "KV", INNER_CODE));
                    if(!$vali->isISBN($io->get_param("isbn"), TRUE, 14, 0, "UTF-8")){
                            $io->set_error("isbn_error", "未入力、または内容に誤りが有ります");
                    }

                    //title
                    $io->set_parameter("title", mb_convert_kana($io->get_param("title"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("title"), TRUE, 255, 0, "UTF-8")){
                    $io->set_error("title_error", "未入力、または内容に誤りが有ります");
                    }

                    //genre
                    $io->set_parameter("genre", mb_convert_kana($io->get_param("genre"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("genre"), TRUE, 10, 0, "UTF-8")){
                    $io->set_error("genre_error", "未入力、または内容に誤りが有ります");
                    }
                    //pub
                    $io->set_parameter("pub", mb_convert_kana($io->get_param("pub"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("pub"), TRUE, 30, "UTF-8")){
                    $io->set_error("pub_error", "未入力、または内容に誤りが有ります");
                    }
                    //writer
                    $io->set_parameter("writer", mb_convert_kana($io->get_param("writer"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("writer"), TRUE, 40, "UTF-8")){
                    $io->set_error("writer_error", "未入力、または内容に誤りが有ります");
                    }
                    //intro
                    $io->set_parameter("intro", mb_convert_kana($io->get_param("intro"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("intro"), TRUE, 255, "UTF-8")){
                    $io->set_error("intro_error", "未入力、または内容に誤りが有ります");
                    }
                    //year
                    $io->set_parameter("year", mb_convert_kana($io->get_param("year"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("year"), TRUE, 4, "UTF-8")){
                    $io->set_error("year_error", "未入力、または内容に誤りが有ります");
                    }
                    //amazon
                    $io->set_parameter("amazon", mb_convert_kana($io->get_param("amazon"), "KV", INNER_CODE));
                    if(!$vali->isURL($io->get_param("amazon"), TRUE, 255, 0, "UTF-8")){
                    $io->set_error("amazon_error", "未入力、または内容に誤りが有ります");
                    }
                    //remarks
                    $io->set_parameter("remarks", mb_convert_kana($io->get_param("remarks"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("remarks"), TRUE, 400, "UTF-8"))
                    {
                    $io->set_error("remarks_error", "内容に誤りが有ります");
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
                $io->set_parameters($_GET);
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

?>



