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
require($lib_path."class.Form.Select.php");

$result = 0;
$ActType = "";
$Key1 ="";
$Key2 ="";
$Key3 ="";

//IDとパスワードチェック
if (!isID($_POST["KEYWORD1"],40,1)){
    $result = 1;
      include'/login/login.html';

}elseif (!isPW($_POST["KEYWORD2"],10,1)){
    $result = 1;
}else{
    $ActType = $_POST["ActionType"];
    $Key1 = $_POST["KEYWORD1"];  //ID
    $Key2 = $_POST["KEYWORD2"];
    $Key3 = $_POST["KEYWORD3"];  //パスワード
    $Key20 = $_POST["KEYWORD20"];
    $Key21 = $_POST["KEYWORD21"];
    $genre = $_POST["GENRE"];
}

    if($result==1){
        include'../../login/login.html';
    }else{

    // 内部文字コード
    define("INNER_CODE", "UTF-8");
    define("HTML_CODE", "UTF-8");

    // テンプレート系ファイルの指定
    define("TEMP_AGREE",   "bookedit_input.html");
    define("TEMP_INPUT",   "bookedit_input.html");
    define("TEMP_ERROR",   "bookedit_input.html");
    define("TEMP_CONFIRM", "bookedit_confirm.html");
    define("TEMP_BLOCK",   "/login/login.html");

    //登録後のページ遷移指定
    define("HTML_SUCCESS", "bookedit_suc.html");
    define("HTML_SUCCESS_2", "bookedit_suc_2.html");
    define("HTML_FAILURE", "bookedit_fal.html");

    // url系情報の指定
    // CHECK_REFERER  非ブランクなら、フォーム内でリファラチェックを行う。初期アクセスではこの値を含むか、以降はフォーム内の遷移かをチェックする。
    // SALESFORCE     非ブランクなら、確認画面からのリンク先をこの値に変更する。ブランクなら、内部の登録処理へ進む。
    define("MY_NAME",        basename($_SERVER["SCRIPT_NAME"]));
    define("MY_PATH",        dirname($_SERVER["SCRIPT_NAME"])."/");
    define("URL_ACTION",     "http://".$_SERVER["SERVER_NAME"].MY_PATH.MY_NAME);
    define("URL_SUCCESS",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_SUCCESS);
    define("URL_FAILURE",    "http://".$_SERVER["SERVER_NAME"].MY_PATH.HTML_FAILURE);
    define("CHECK_REFERER",  ""); //
    define("LIST_SELECT01",  "1:NW,2:DB,3:開発,4:Web,5:一般業務,6:デザイン,7:その他");


    // 入出力インスタンスの生成
    $io = new IO(HTML_CODE, HTML_CODE, INNER_CODE, "step_from,x,y", KEY);
    $io->set_parameters($_POST);
    $select01 = new Select("select01", LIST_SELECT01, $io);



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

                        $isbn = $io->get_param_html("isbn");
                        if($isbn){
                        $Key24 = $io->get_param_html("isbn");
                        }else{
                        $Key24 = $io->get_param_html("asin");
                        }

                        $Key25 = $io->get_param_html("title");
                        $Key26 = $select01->get_selected_text();
                        $Key27 = $io->get_param_html("pub");
                        $Key28 = $io->get_param_html("writer");
                        $Key29 = $io->get_param_html("into");
                        $Key30 = $io->get_param_html("year");
                        $Key31 = $io->get_param_html("amazon");
                        $Key32 = $io->get_param_html("remarks");

                         //データベース更新
                        $obj = new BookModel();
                        $result = $obj->GETBookEDIT($ActType, $Key1, $Key24, $Key25, $Key26, $Key27, $Key28, $Key29, $Key30, $Key31, $Key32, $Key20);

                            if($result == 0){
                                  //coverテーブルに同じISBNが登録されているか確認する
                                  $obj = new BookModel();
                                  $result = $obj->GETCoverIsbn($ActType, $Key24, $dspCoverIsbn);
                                    $Key22 = '/admin/book_add/tmp_cover/'.$dspCoverIsbn[1];

                                  if($result==0){//登録されていればすでに登録されています。表紙を変更する場合は編集がめんいってね
                                    $obj = new BookModel();
                                    $result = $obj->GETNewBooknum($ActType, $dspNewBooknum);
                                     if($result == 0){

                                         include(HTML_SUCCESS_2);
                                     }

                                  }elseif($result==1){
                                      //登録されていなければISBN登録し、選択画面へ
                                      $obj = new BookModel();
                                      $result = $obj->GETCoverIsbnAdd($ActType, $Key24);

                                      if($result == 0){
                                          $obj = new BookModel();
                                          $result = $obj->GETNewBooknum($ActType, $dspNewBooknum);

                                        //ISBN登録完了すればsuc画面へ移動し、画像登録へ
                                        include(HTML_SUCCESS);
                                      }else{
                                        include(HTML_FAILURE);
                                      }
                                  }else{
                                    $db_error ='システムエラーです。開発者に連絡してください。';
                                    include(TEMP_INPUT);

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
                    // ISBNとASIN
                    $isbn = $io->get_param_html("isbn");
                    $asin = $io->get_param_html("asin");
                    if($isbn==null and $asin){
                        $io->set_parameter("asin", mb_convert_kana($io->get_param("asin"), "KV", INNER_CODE));
                        if(!preg_match("/^[A-Z0-9]{10}$/", $io->get_param("asin"))){
                            $io->set_error("asin_error", "ASINコード内容に誤りが有ります");
                        }
                    }elseif($isbn and $asin){
                        $io->set_error("bookcode_error", "ISBNコードまたはASINコードどちらかを入力してください");
                    }elseif($isbn==null and $asin==null){
                        $io->set_error("bookcode_error", "ISBNコードまたはASINコードどちらかを入力してください");
                    }else{
                        $io->set_parameter("isbn", mb_convert_kana($io->get_param("isbn"), "KV", INNER_CODE));
                        if(!$vali->isISBN($io->get_param("isbn"), true, 15, 0, "UTF-8")){
                            $io->set_error("isbn_error", "ISBNコード内容に誤りが有ります");
                        }

                    }


                    //title
                    $io->set_parameter("title", mb_convert_kana($io->get_param("title"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("title"), TRUE, 255, 0, "UTF-8")){
                    $io->set_error("title_error", "未入力、または内容に誤りが有ります");
                    }

                    //genre
                    if(!$select01->is_regularly(false)){
                        $io->set_error("genre", "内容に誤りが有ります");
                    }
                    //pub
                    $io->set_parameter("pub", mb_convert_kana($io->get_param("pub"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("pub"), TRUE, 255, 0,"UTF-8")){
                    $io->set_error("pub_error", "未入力、または内容に誤りが有ります");
                    }
                    //writer
                    $io->set_parameter("writer", mb_convert_kana($io->get_param("writer"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("writer"), FALSE, 100, "UTF-8")){
                    $io->set_error("writer_error", "未入力、または内容に誤りが有ります");
                    }
                    //intro
                    $io->set_parameter("intro", mb_convert_kana($io->get_param("intro"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("intro"), FALSE, 400, "UTF-8")){
                    $io->set_error("intro_error", "未入力、または内容に誤りが有ります");
                    }
                    //year
                    $io->set_parameter("year", mb_convert_kana($io->get_param("year"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("year"), FALSE, 4, "UTF-8")){
                    $io->set_error("year_error", "未入力、または内容に誤りが有ります");
                    }
                    //amazon
                    $io->set_parameter("amazon", mb_convert_kana($io->get_param("amazon"), "KV", INNER_CODE));
                    if(!$vali->isURL($io->get_param("amazon"), FALSE, 255, 0, "UTF-8")){
                    $io->set_error("amazon_error", "未入力、または内容に誤りが有ります");
                    }
                    //remarks
                    $io->set_parameter("remarks", mb_convert_kana($io->get_param("remarks"), "KV", INNER_CODE));
                    if(!$vali->isString($io->get_param("remarks"), FALSE, 400, "UTF-8"))
                    {
                    $io->set_error("remarks_error", "内容に誤りが有ります");
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
                        if(isset($Key21)){
                            $obj=new BookModel();
                            $result = $obj->GETBookDetail($ActType, $Key20, $Key21, $dspBookDet);
                            $Key20 = $dspBookDet[10];//書籍番号
                            $Key21 = $dspBookDet[8];//isbn
                            $Key22 = $dspBookDet[0];//タイトル
                            $Key23 = $dspBookDet[1];//ジャンル
                            $Key24 = $dspBookDet[2];//出版社
                            $Key25 = $dspBookDet[3];//著者
                            $Key26 = $dspBookDet[4];//紹介文
                            $Key27 = $dspBookDet[5];//出版年
                            $Key28 = $dspBookDet[6];//リンク
                            $Key29 = $dspBookDet[7];//備考

                        }

                    if(preg_match("/^\d{3}\-\d{10}$/", $Key21)){
                        $io->set_parameter("isbn", $Key21);
                    }else{
                        $io->set_parameter("asin", $Key21);
                    }
                    $io->set_parameter("title", $Key22);
                    if($Key23=='NW'){
                        $select01->value = "1";
                    }elseif ($Key23=='DB') {
                        $select01->value = "2";
                    }elseif ($Key23=='開発') {
                        $select01->value = "3";
                    }elseif ($Key23=='Web') {
                        $select01->value = "4";
                    }elseif ($Key23=='一般業務') {
                        $select01->value = "5";
                    }elseif ($Key23=='デザイン') {
                        $select01->value = "6";
                    }elseif ($Key23=='その他') {
                        $select01->value = "7";
                    }

                    $io->set_parameter("pub", $Key24);
                    $io->set_parameter("writer", $Key25);
                    $io->set_parameter("intro", $Key26);
                    $io->set_parameter("year", $Key27);
                    $io->set_parameter("amazon", $Key28);
                    $io->set_parameter("remarks", $Key29);

                    include(TEMP_AGREE);
            }else{
                    // リファラ制限画面
                    include(TEMP_BLOCK);
            }
    }
}

?>
