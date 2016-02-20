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
                    $decision=false;
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
                            $io->set_parameter("csv_remarks", $radio1->get_checked_text_main(false)."　".$io->get_param("remarks"));
                    }
                    else
                    {
                            $io->set_parameter("csv_radio1", $io->get_param("radio1"));
                            $io->set_parameter("csv_remarks", $io->get_param("remarks"));
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
                            /*$Key51=$io->get_param_sql("Name");
                            $Key52=$io->get_param_sql("ID");
                            //データベース更新
                            $obj=new UserModel();
                            //ID確認
                            $result = $obj->GETUserAdd($ActType, $Key1, $Key51, $Key52);
                            if($result == 3){
                                 $dbid_error ='入力されたものと同じIDがあります。再度入力してください。';
                                include(TEMP_INPUT);
                            }elseif($result == 0){
                                    include(HTML_SUCCESS); 
                            }else{
                                $db_error ='システムエラーです。開発者に連絡してください。';
                                include(TEMP_INPUT);
                            }
                            */
include(HTML_SUCCESS);
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
				$io->set_error("remarks", "内容に誤りが有ります");
			}


                        //画像ファイルアップロード確認
                       if(isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error'])) {
                            // バッファリングを開始
                            ob_start();

                            try {
                            // $_FILES['upfile']['error'] の値を確認
                            switch ($_FILES['upfile']['error']) {
                                case UPLOAD_ERR_OK: // OK
                                    break;
                                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                                    $io->set_error("cover_error", 'ファイルサイズが大きすぎます');
                                default:
                                    $io->set_error("cover_error", 'その他のエラーが発生しました');
                                }
                            // $_FILES['upfile']['mime']の値はブラウザ側で偽装可能なので
                            // MIMEタイプを自前でチェックする
                            if (!$info = @getimagesize($_FILES['upfile']['tmp_name'])) {
                                $io->set_error("cover_error", '有効な画像ファイルを設定してください');
                            }
                            if (!in_array($info[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
                                $io->set_error("cover_error", '未対応の画像形式です');
                            }
                            
                            // サムネイルをバッファに出力
                            $create = str_replace('/', 'createfrom', $info['mime']);
                            $output = str_replace('/', '', $info['mime']);
                            if ($info[0] >= $info[1]) {
                                $dst_w = 120;
                                $dst_h = ceil(120 * $info[1] / max($info[0], 1));
                            } else {
                                $dst_w = ceil(120 * $info[0] / max($info[1], 1));
                                $dst_h = 120;
                            }
                            if (!$src = @$create($_FILES['upfile']['tmp_name'])) {
                                $io->set_error("cover_error", '画像リソースが生成できませんでした');
                            }
                            $dst = imagecreatetruecolor($dst_w, $dst_h);
                            imagecopyresampled($dst, $src, 0, 0, 0, 0, $dst_w, $dst_h, $info[0], $info[1]);
                            $output($dst);
                            imagedestroy($src);
                            imagedestroy($dst);
                            
                            } catch (RuntimeException $e) {
                                while (ob_get_level()) {
                                    ob_end_clean(); // バッファをクリア
                                }
                                http_response_code($e instanceof PDOException ? 500 : $e->getCode());
                                $msgs[] = ['red', $e->getMessage()];

                            }
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

?>



